(function () {
    'use strict';

    var REFRESH_MS = 60000;
    var DEFAULT_DUR = { image: 5000, text: 7000 };
    var api = function (name) {
        return location.origin + '/ajax/story.' + name;
    };

    var ring = [];
    var me = 0;
    var canAdd = true;
    var maxActive = 6;
    var bar = null;
    var viewer = null;
    var current = { group: -1, index: 0 };
    var timer = null;
    var paused = false;
    var elapsed = 0;
    var total = 0;
    var raf = null;
    var lastStamp = 0;
    var recorder = null;

    function post(url, data, done) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) {
                return;
            }
            var parsed = null;
            try {
                parsed = JSON.parse(xhr.responseText);
            } catch (e) {
                parsed = null;
            }
            if (xhr.status !== 200 || !parsed) {
                done({ ok: 0, error: 'پاسخ سرور خوانا نبود' });
                return;
            }
            done(parsed);
        };
        xhr.onerror = function () {
            done({ ok: 0, error: 'ارتباط با سرور قطع شد' });
        };
        xhr.send(data);
    }

    function tag(name, cls, text) {
        var node = document.createElement(name);
        if (cls) {
            node.className = cls;
        }
        if (text !== undefined && text !== null) {
            node.textContent = String(text);
        }
        return node;
    }

    function clear(node) {
        while (node.firstChild) {
            node.removeChild(node.firstChild);
        }
    }

    function remainingLabel(seconds) {
        var hours = Math.floor(seconds / 3600);
        var minutes = Math.floor((seconds % 3600) / 60);
        if (hours > 0) {
            return hours + ' ساعت و ' + minutes + ' دقیقه دیگر می رود';
        }
        return minutes + ' دقیقه دیگر می رود';
    }

    function buildBar() {
        var host = document.getElementById('onlinelist');
        if (!host) {
            return false;
        }
        var old = document.getElementById('story_bar');
        if (old && old.parentNode === host) {
            bar = old;
            return true;
        }
        bar = old || tag('div', 'story_bar');
        bar.id = 'story_bar';
        host.insertBefore(bar, host.firstChild);
        return true;
    }

    function paintBar() {
        if (!bar) {
            return;
        }
        if (!buildBar()) {
            return;
        }
        buildSideButton();
        clear(bar);
        bar.appendChild(tag('div', 'story_bar_title', 'استوری ها'));

        var track = tag('div', 'story_track');
        if (canAdd) {
            var add = tag('div', 'story_circle story_add', '+');
            add.title = 'استوری جدید';
            add.addEventListener('click', openComposer);
            track.appendChild(add);
        }

        for (var i = 0; i < ring.length; i++) {
            var group = ring[i];
            var unseen = 0;
            for (var s = 0; s < group.stories.length; s++) {
                if (!group.stories[s].seen) {
                    unseen++;
                }
            }
            var circle = tag('div', 'story_circle' + (unseen > 0 ? ' story_unseen' : ''));
            var face = tag('div', 'story_face', (group.name || '?').substring(0, 1));
            if (group.face) {
                face.style.position = 'relative';
                var photo = document.createElement('img');
                photo.className = 'story_face_photo';
                photo.alt = '';
                photo.src = location.origin + group.face;
                photo.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;border-radius:50%;display:block';
                photo.addEventListener('error', function () {
                    if (this.parentNode) {
                        this.parentNode.removeChild(this);
                    }
                });
                face.appendChild(photo);
            }
            circle.appendChild(face);
            circle.appendChild(tag('div', 'story_name', group.name + (group.stories.length > 1 ? ' (' + group.stories.length + ')' : '')));
            if (group.user === me) {
                circle.appendChild(tag('div', 'story_own', 'شما'));
            }
            (function (position) {
                circle.addEventListener('click', function () {
                    openViewer(position, 0);
                });
            }(i));
            track.appendChild(circle);
        }

        if (ring.length === 0) {
            track.appendChild(tag('div', 'story_empty', 'هنوز استوری ای نیست. با دکمه مثبت اولین را بسازید'));
        }
        bar.appendChild(track);
    }

    function buildSideButton() {
        if (document.getElementById('story_side_btn')) {
            return;
        }
        var host = document.getElementById('voice_box');
        if (!host) {
            var field = document.getElementById('message');
            host = field ? field.parentNode : null;
        }
        if (!host) {
            return;
        }
        var button = tag('button', 'story_side_btn', '\uD83D\uDCF7');
        button.type = 'button';
        button.id = 'story_side_btn';
        button.title = 'استوری جدید';
        button.addEventListener('click', openComposer);
        host.appendChild(button);
    }

    function load(done) {
        post(api('list'), new FormData(), function (data) {
            if (data && data.ok) {
                ring = data.ring || [];
                me = data.me || 0;
                maxActive = data.max || 6;
                paintBar();
            }
            if (typeof done === 'function') {
                done(data);
            }
        });
    }

    function openComposer() {
        var sheet = tag('div', 'story_sheet_mask');
        var box = tag('div', 'story_sheet');
        box.appendChild(tag('div', 'story_sheet_title', 'استوری جدید'));

        var pick = document.createElement('input');
        pick.type = 'file';
        pick.accept = 'image/*,video/*';
        pick.style.display = 'none';
        pick.addEventListener('change', function () {
            if (pick.files && pick.files[0]) {
                sendFile(pick.files[0], function () {
                    closeSheet();
                });
            }
        });
        box.appendChild(pick);

        var buttonImage = tag('button', 'story_sheet_button', 'عکس یا فیلم از گالری');
        buttonImage.type = 'button';
        buttonImage.addEventListener('click', function () {
            pick.click();
        });
        box.appendChild(buttonImage);

        var voiceRow = tag('div', 'story_voice_row');
        var buttonVoice = tag('button', 'story_sheet_button', 'ضبط صدا');
        buttonVoice.type = 'button';
        var voiceClock = tag('span', 'story_voice_clock', '00:00');
        buttonVoice.addEventListener('click', function () {
            toggleVoice(buttonVoice, voiceClock);
        });
        voiceRow.appendChild(buttonVoice);
        voiceRow.appendChild(voiceClock);
        box.appendChild(voiceRow);

        var text = document.createElement('textarea');
        text.className = 'story_text_input';
        text.maxLength = 240;
        text.placeholder = 'یا فقط بنویسید ...';
        box.appendChild(text);

        var colors = tag('div', 'story_colors');
        var palette = ['1f6fb2', 'b21f5e', '2c7a3f', '7a4f2c', '5a3aa8', '0f0f0f'];
        var chosen = { value: palette[0] };
        for (var i = 0; i < palette.length; i++) {
            (function (hex) {
                var dot = tag('span', 'story_dot');
                dot.style.background = '#' + hex;
                dot.addEventListener('click', function () {
                    chosen.value = hex;
                    var old = colors.querySelector('.story_dot_on');
                    if (old) {
                        old.className = 'story_dot';
                    }
                    dot.className = 'story_dot story_dot_on';
                });
                if (i === 0) {
                    dot.className = 'story_dot story_dot_on';
                }
                colors.appendChild(dot);
            }(palette[i]));
        }
        box.appendChild(colors);

        var sendText = tag('button', 'story_sheet_button story_send_text', 'ارسال نوشته');
        sendText.type = 'button';
        sendText.addEventListener('click', function () {
            var body = text.value.replace(/^\s+|\s+$/g, '');
            if (!body) {
                notice('ابتدا چیزی بنویسید');
                return;
            }
            var data = new FormData();
            data.append('text', body);
            data.append('bg', chosen.value);
            post(api('add'), data, function (result) {
                if (result && result.ok) {
                    notice('استوری نوشته ثبت شد');
                    closeSheet();
                    load();
                } else {
                    notice((result && result.error) ? result.error : 'ثبت نشد');
                }
            });
        });
        box.appendChild(sendText);

        var close = tag('button', 'story_sheet_close', 'بستن');
        close.type = 'button';
        close.addEventListener('click', closeSheet);
        box.appendChild(close);

        sheet.appendChild(box);
        sheet.addEventListener('click', function (event) {
            if (event.target === sheet) {
                closeSheet();
            }
        });
        document.body.appendChild(sheet);
        window.__storySheet = sheet;
    }

    function closeSheet() {
        stopVoice(true);
        if (window.__storySheet && window.__storySheet.parentNode) {
            window.__storySheet.parentNode.removeChild(window.__storySheet);
        }
        window.__storySheet = null;
    }

    function toggleVoice(button, clock) {
        if (recorder && recorder.streaming) {
            recorder.stop();
            return;
        }
        startVoice(button, clock);
    }

    function startVoice(button, clock) {
        if (!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia && window.MediaRecorder)) {
            notice('مرورگر شما ضبط صدا ندارد');
            return;
        }
        navigator.mediaDevices.getUserMedia({ audio: true }).then(function (stream) {
            var chunks = [];
            var rec = new MediaRecorder(stream);
            var started = Date.now();
            var finished = false;
            var cancelled = false;
            var tick = 0;
            var halt = function () {
                if (finished) {
                    return;
                }
                finished = true;
                window.clearInterval(tick);
                try {
                    rec.stop();
                } catch (e) { /* already closed */ }
                try {
                    stream.getTracks().forEach(function (track) {
                        track.stop();
                    });
                } catch (e) { /* already closed */ }
            };
            recorder = {
                streaming: true,
                stop: halt,
                cancel: function () {
                    cancelled = true;
                    halt();
                }
            };
            tick = window.setInterval(function () {
                var seconds = Math.floor((Date.now() - started) / 1000);
                clock.textContent = '00:' + (seconds < 10 ? '0' : '') + seconds;
                if (seconds >= 60) {
                    halt();
                }
            }, 500);
            rec.ondataavailable = function (event) {
                if (event.data && event.data.size > 0) {
                    chunks.push(event.data);
                }
            };
            rec.onstop = function () {
                recorder = null;
                button.textContent = 'ضبط صدا';
                clock.textContent = '00:00';
                if (cancelled) {
                    return;
                }
                var type = rec.mimeType || 'audio/webm';
                var blob = new Blob(chunks, { type: type });
                if (blob.size === 0) {
                    notice('چیزی ضبط نشد');
                    return;
                }
                var ext = type.indexOf('ogg') !== -1 ? 'ogg' : (type.indexOf('mp4') !== -1 ? 'm4a' : 'webm');
                sendFile(new File([blob], 'voice.' + ext, { type: type }), function () {
                    closeSheet();
                });
            };
            button.textContent = 'تمام کن و بفرست';
            rec.start();
        }, function () {
            notice('اجازه استفاده از میکروفون داده نشد');
        });
    }

    function stopVoice(silent) {
        var active = recorder;
        if (silent) {
            recorder = null;
        }
        if (!active) {
            return;
        }
        if (silent && active.cancel) {
            active.cancel();
        } else {
            active.stop();
        }
    }

    function sendFile(file, done) {
        var kind = file.type.indexOf('video') === 0 ? 'video' : (file.type.indexOf('audio') === 0 ? 'audio' : 'image');
        var data = new FormData();
        data.append('story', file, file.name);

        var finish = function (duration) {
            if (duration > 0 && duration <= 60) {
                data.append('dur', Math.round(duration));
            }
            post(api('add'), data, function (result) {
                if (result && result.ok) {
                    notice('استوری فرستاده شد');
                    load();
                    if (typeof done === 'function') {
                        done();
                    }
                } else {
                    notice((result && result.error) ? result.error : 'ارسال نشد');
                }
            });
        };

        if (kind === 'video' || kind === 'audio') {
            var probe = document.createElement(kind === 'video' ? 'video' : 'audio');
            var url = window.URL.createObjectURL(file);
            probe.preload = 'metadata';
            probe.onloadedmetadata = function () {
                window.URL.revokeObjectURL(url);
                finish(probe.duration || 0);
            };
            probe.onerror = function () {
                window.URL.revokeObjectURL(url);
                finish(0);
            };
            probe.src = url;
        } else {
            finish(0);
        }
    }

    function notice(message) {
        var box = document.getElementById('story_notice');
        if (!box) {
            box = tag('div', 'story_notice');
            box.id = 'story_notice';
            document.body.appendChild(box);
        }
        box.textContent = message;
        box.style.display = 'block';
        window.setTimeout(function () {
            box.style.display = 'none';
        }, 3500);
    }

    function openViewer(groupIndex, storyIndex) {
        if (groupIndex < 0 || !ring[groupIndex]) {
            return;
        }
        if (!viewer) {
            viewer = tag('div', 'story_viewer');
            viewer.id = 'story_viewer';
            viewer.appendChild(tag('div', 'story_progress'));
            var head = tag('div', 'story_head');
            head.appendChild(tag('div', 'story_author'));
            head.appendChild(tag('div', 'story_tools'));
            viewer.appendChild(head);
            viewer.appendChild(tag('div', 'story_stage'));
            var feet = tag('div', 'story_feet');
            var prev = tag('button', 'story_nav story_prev', '›');
            var next = tag('button', 'story_nav story_next', '‹');
            prev.type = 'button';
            next.type = 'button';
            prev.addEventListener('click', function () { step(-1); });
            next.addEventListener('click', function () { step(1); });
            feet.appendChild(prev);
            feet.appendChild(next);
            viewer.appendChild(feet);
            viewer.addEventListener('mousedown', holdStart);
            viewer.addEventListener('mouseup', holdEnd);
            viewer.addEventListener('touchstart', holdStart, { passive: true });
            viewer.addEventListener('touchend', holdEnd);
            document.body.appendChild(viewer);
        }
        viewer.style.display = 'block';
        current.group = groupIndex;
        show(storyIndex);
    }

    function holdStart() {
        paused = true;
    }

    function holdEnd() {
        paused = false;
    }

    function closeViewer() {
        if (raf) {
            window.cancelAnimationFrame(raf);
            raf = null;
        }
        clearMedia();
        if (viewer && viewer.parentNode) {
            viewer.parentNode.removeChild(viewer);
        }
        viewer = null;
        load();
    }

    function clearMedia() {
        var stage = viewer ? viewer.querySelector('.story_stage') : null;
        if (stage) {
            var media = stage.querySelector('video,audio');
            if (media) {
                try {
                    media.pause();
                } catch (e) { /* nothing to pause */ }
            }
        }
    }

    function story() {
        var group = ring[current.group];
        if (!group || !group.stories[current.index]) {
            return null;
        }
        return group.stories[current.index];
    }

    function step(direction) {
        var group = ring[current.group];
        if (!group) {
            return;
        }
        var next = current.index + direction;
        if (next >= group.stories.length) {
            if (current.group + 1 < ring.length) {
                openGroup(current.group + 1);
            } else {
                closeViewer();
            }
            return;
        }
        if (next < 0) {
            if (current.group - 1 >= 0) {
                openGroup(current.group - 1, 999);
            }
            return;
        }
        show(next);
    }

    function openGroup(groupIndex, index) {
        var group = ring[groupIndex];
        if (!group) {
            closeViewer();
            return;
        }
        var position = index === 999 ? group.stories.length - 1 : 0;
        current.group = groupIndex;
        show(position);
    }

    function show(index) {
        if (!viewer) {
            return;
        }
        current.index = index;
        var item = story();
        if (!item) {
            closeViewer();
            return;
        }
        if (!item.seen) {
            item.seen = true;
            var data = new FormData();
            data.append('story', item.id);
            post(api('seen'), data, function () { });
        }

        var group = ring[current.group];
        var progress = viewer.querySelector('.story_progress');
        clear(progress);
        for (var i = 0; i < group.stories.length; i++) {
            var cell = tag('div', 'story_pcell');
            var fill = tag('div', 'story_pfill');
            cell.appendChild(fill);
            progress.appendChild(cell);
        }

        var head = viewer.querySelector('.story_head');
        var author = head.querySelector('.story_author');
        author.textContent = '';
        if (group.face) {
            var facePhoto = document.createElement('img');
            facePhoto.alt = '';
            facePhoto.src = location.origin + group.face;
            facePhoto.style.cssText = 'width:30px;height:30px;border-radius:50%;object-fit:cover;vertical-align:middle;margin-left:8px;border:1px solid rgba(255,255,255,.5)';
            facePhoto.addEventListener('error', function () {
                if (facePhoto.parentNode) {
                    facePhoto.parentNode.removeChild(facePhoto);
                }
            });
            author.appendChild(facePhoto);
        }
        author.appendChild(tag('span', 'story_who', group.name));
        author.appendChild(tag('span', 'story_left', remainingLabel(item.left)));

        var tools = head.querySelector('.story_tools');
        clear(tools);
        if (item.owner) {
            tools.appendChild(tag('span', 'story_views', 'بازدید: ' + (item.views || 0)));
            var remove = tag('button', 'story_kill', 'پاک کن');
            remove.type = 'button';
            remove.addEventListener('click', function () {
                var payload = new FormData();
                payload.append('story', item.id);
                post(api('delete'), payload, function (result) {
                    if (!viewer) {
                        return;
                    }
                    if (result && result.ok) {
                        var groupIndex = -1;
                        var storyIndex = -1;
                        for (var g = 0; g < ring.length; g++) {
                            for (var k = 0; k < ring[g].stories.length; k++) {
                                if (ring[g].stories[k].id === item.id) {
                                    groupIndex = g;
                                    storyIndex = k;
                                }
                            }
                        }
                        if (groupIndex < 0) {
                            closeViewer();
                            paintBar();
                            return;
                        }
                        ring[groupIndex].stories.splice(storyIndex, 1);
                        if (ring[groupIndex].stories.length === 0) {
                            ring.splice(groupIndex, 1);
                            if (ring.length === 0) {
                                closeViewer();
                                paintBar();
                                return;
                            }
                            openGroup(Math.min(groupIndex, ring.length - 1), 0);
                        } else {
                            current.group = groupIndex;
                            show(Math.min(storyIndex, ring[groupIndex].stories.length - 1));
                        }
                        paintBar();
                    } else {
                        notice((result && result.error) ? result.error : 'پاک نشد');
                    }
                });
            });
            tools.appendChild(remove);
        }
        var closer = tag('button', 'story_close', '×');
        closer.type = 'button';
        closer.addEventListener('click', closeViewer);
        tools.appendChild(closer);

        var stage = viewer.querySelector('.story_stage');
        clearMedia();
        clear(stage);

        total = item.kind === 'image' ? DEFAULT_DUR.image : (item.kind === 'text' ? DEFAULT_DUR.text : Math.max(3000, (item.dur || 8) * 1000));
        elapsed = 0;
        paused = false;

        if (item.kind === 'text') {
            var paper = tag('div', 'story_paper', item.text);
            paper.style.background = '#' + (item.bg || '1f6fb2');
            stage.appendChild(paper);
        } else if (item.kind === 'image') {
            var image = document.createElement('img');
            image.className = 'story_media';
            image.src = location.origin + item.url;
            stage.appendChild(image);
        } else {
            var media = document.createElement(item.kind === 'video' ? 'video' : 'audio');
            media.className = 'story_media';
            media.src = location.origin + item.url;
            media.autoplay = true;
            if (item.kind === 'video') {
                media.setAttribute('playsinline', 'playsinline');
            }
            media.addEventListener('ended', function () {
                step(1);
            });
            media.addEventListener('error', function () {
                notice('پخش فایل ممکن نشد');
            });
            stage.appendChild(media);
            if (item.dur > 0) {
                total = item.dur * 1000;
            }
            if (item.kind === 'audio') {
                var plate = tag('div', 'story_audio_plate');
                plate.appendChild(tag('div', 'story_audio_icon', '♪'));
                var note = tag('div', 'story_audio_note', group.name);
                plate.appendChild(note);
                stage.appendChild(plate);
                media.style.display = 'none';
            }
            var playAttempt = media.play();
            if (playAttempt && playAttempt.catch) {
                playAttempt.catch(function () { /* autoplay blocked */ });
            }
        }

        if (raf) {
            window.cancelAnimationFrame(raf);
        }
        lastStamp = 0;
        raf = window.requestAnimationFrame(tickFrame);
    }

    function tickFrame(stamp) {
        if (!viewer || viewer.style.display === 'none') {
            return;
        }
        if (!lastStamp) {
            lastStamp = stamp;
        }
        var delta = stamp - lastStamp;
        lastStamp = stamp;
        var item = story();
        if (!item) {
            return;
        }
        if (!paused && item.kind !== 'video' && item.kind !== 'audio') {
            elapsed += delta;
        } else if (!paused && (item.kind === 'video' || item.kind === 'audio')) {
            var media = viewer.querySelector('video,audio');
            if (media && media.duration && isFinite(media.duration)) {
                total = media.duration * 1000;
                if (item.dur > 0) {
                    total = Math.min(total, item.dur * 1000);
                }
                elapsed = media.currentTime * 1000;
            } else {
                elapsed += delta;
            }
        }
        var ratio = total > 0 ? Math.min(1, elapsed / total) : 1;
        var cells = viewer.querySelectorAll('.story_pfill');
        for (var i = 0; i < cells.length; i++) {
            var value = i < current.index ? 1 : (i === current.index ? ratio : 0);
            cells[i].style.width = (value * 100) + '%';
        }
        if (ratio >= 1) {
            step(1);
            return;
        }
        raf = window.requestAnimationFrame(tickFrame);
    }

    function keyHandler(event) {
        if (!viewer || viewer.style.display === 'none') {
            return;
        }
        if (event.key === 'Escape') {
            closeViewer();
        } else if (event.key === 'ArrowLeft') {
            step(1);
        } else if (event.key === 'ArrowRight') {
            step(-1);
        }
    }

    function watchBar() {
        var host = document.getElementById('onlinelist');
        if (!host || !window.MutationObserver) {
            return;
        }
        new MutationObserver(function () {
            if (!document.getElementById('story_bar')) {
                bar = null;
                if (buildBar()) {
                    paintBar();
                }
            }
        }).observe(host, { childList: true });
    }

    function boot() {
        if (!buildBar()) {
            window.setTimeout(boot, 1500);
            return;
        }
        watchBar();
        document.addEventListener('keydown', keyHandler);
        load();
        window.setInterval(function () {
            if (!viewer || viewer.style.display === 'none') {
                load();
            }
        }, REFRESH_MS);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
