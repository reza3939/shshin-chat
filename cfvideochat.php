<?php
check_session();
if ($options['videochat'] != 'true')
    die(RedError('این قسمت توسط مدیریت غیرفعال شده است'));
$json_decode = $options['useroptions'];
$videochat = json_decode($json_decode, true);
if (!in_array(session('type'), (array) $videochat['videochat']) && $action == 'invite')
    die(RedError('این قسمت برای گروه کاربری شما غیرفعال شده است'));
$action = isset($_GET['action']) ? ($_GET['action'] == 'invite' ? 'invite' : 'join') : die('action?');
session('type') == '1' && $action == 'invite' ? die(RedError('مهمان اجازه ندارد لطفا عضو شوید')) : '';
$channelid_get = isset($_GET['channelid']) ? safe::string($_GET['channelid']) : ($action != 'invite' ? die('channelid?') : '');
$roomid_get = isset($_GET['roomid']) ? safe::string($_GET['roomid']) : ($action != 'invite' ? die('roomid?') : '');
$userid_get = isset($_GET['cfid']) ? safe::number($_GET['cfid']) : die('cfid?');
((session('id') == $_GET['cfid'] && isset($_GET['cfid'])) ? false : !allow_cf($userid_get)) ? die('شما حذف شده اید') : '';
$channelid = str_replace(array('http://', '.'), '', url());
$channelid = md5('conference' . $channelid . session('id') . session('changepw') . pwcreator::start(8));
$roomid = md5(session('room') . pwcreator::start(8));
$userid = session('id');
?>
<script type="text/javascript" src="//webrtcexperiment-webrtc.netdna-ssl.com/RTCMultiConnection.js"></script>
<script type="text/javascript" src="<?php echo(theme::url('theme/microblog/js/jquery.min.js')); ?>"></script>
<select id="options">
    <option value="va" selected>فعال کردن وبکم و میکروفون</option>
    <option value="video">فعال کردن تنها وبکم</option>
    <option value="audio">فعال کردن تنها میکروفون</option>
    <option value="n">وبکم و میکروفون ندارم</option>
</select>
<button id="setsetting">تنظیم</button>
<?php if ($action == 'invite') { ?>
    <button id="invite">دعوت کن</button>
<?php } ?>
<a target="_blank" href="/faq"><button>آموزش کار با این قسمت</button></a>
<hr>
<style>
*{direction:rtl;font-family:Byekan}
    audio,
    video {
        -moz-transition: all 1s ease;
        -ms-transition: all 1s ease;
        -o-transition: all 1s ease;
        -webkit-transition: all 1s ease;
        transition: all 1s ease;
        vertical-align: top;
    }
    p {
        padding: 1em;
    }
    li {
        border-bottom: 1px solid rgb(189, 189, 189);
        border-left: 1px solid rgb(189, 189, 189);
        padding: .5em;
    }
</style>
<table style="width: 100%;" id="rooms-list"></table>
<div id="videos-container"></div>
<script>

    jQuery(function () {
        var MODERATOR_CHANNEL_ID = '<?= $action == 'invite' ? $channelid : $channelid_get; ?>'; // channel-id
        var MODERATOR_SESSION_ID = '<?= $action == 'invite' ? $roomid : $roomid_get; ?>';    // room-id
        var MODERATOR_ID = '<?= $action == 'invite' ? $userid : $userid_get; ?>';    // user-id
        jQuery("#setsetting").click(function () {
            var settings = document.getElementById('options').value;
            switch (settings) {
                case 'video':
                    var MODERATOR_SESSION = {
                        audio: false,
                        video: true
                    }
                    break;
                case 'audio':
                    var MODERATOR_SESSION = {
                        audio: true,
                        video: false
                    }
                    break;
                case 'va':
                    var MODERATOR_SESSION = {
                        audio: true,
                        video: true
                    }
                    break;
                case 'n':
                    var MODERATOR_SESSION = {
                        audio: false,
                        video: false
                    }
                    break;
                default:
                    alert('خطا');
                    break;
            }

            var MODERATOR_EXTRA = {
                name: "<?= session('name'); ?>"
            };
            var videosContainer = document.getElementById('videos-container') || document.body;
            var roomsList = document.getElementById('rooms-list');
            /*
             var iceServers = [];
             
             iceServers.push({
             url: 'stun:stun.l.google.com:19302'
             });
             */
<?php if ($action == 'invite') { ?>
                var moderator = new RTCMultiConnection(MODERATOR_CHANNEL_ID);
                moderator.onstream = function (e) {
                    e.mediaElement.width = 600;
                    videosContainer.insertBefore(e.mediaElement, videosContainer.firstChild);
                    rotateVideo(e.mediaElement);
                    scaleVideos();
                };
                moderator.onstreamended = function (e) {
                    e.mediaElement.style.opacity = 0;
                    rotateVideo(e.mediaElement);
                    setTimeout(function () {
                        if (e.mediaElement.parentNode) {
                            e.mediaElement.parentNode.removeChild(e.mediaElement);
                        }
                        scaleVideos();
                    }, 1000);
                };
                //moderator.iceServers = iceServers;
                moderator.iceServers = [{
                        url: 'stun:23.21.150.121'
                    }, {
                        url: 'stun:stun.l.google.com:19302'
                    }, {
                        url: 'stun:stun01.sipphone.com'
                    }, {
                        url: 'stun:stun.ekiga.net'
                    }, {
                        url: 'stun:stun.fwdnet.net'
                    }, {
                        url: 'stun:stun.ideasip.com'
                    }, {
                        url: 'stun:stun.iptel.org'
                    }, {
                        url: 'stun:stun.rixtelecom.se'
                    }, {
                        url: 'stun:stun.schlund.de'
                    }, {
                        url: 'stun:stun.l.google.com:19302'
                    }, {
                        url: 'stun:stun1.l.google.com:19302'
                    }, {
                        url: 'stun:stun2.l.google.com:19302'
                    }, {
                        url: 'stun:stun3.l.google.com:19302'
                    }, {
                        url: 'stun:stun4.l.google.com:19302'
                    }, {
                        url: 'stun:stunserver.org'
                    }, {
                        url: 'stun:stun.softjoys.com'
                    }, {
                        url: 'stun:stun.voiparound.com'
                    }, {
                        url: 'stun:stun.voipbuster.com'
                    }, {
                        url: 'stun:stun.voipstunt.com'
                    }, {
                        url: 'stun:stun.voxgratia.org'
                    }, {
                        url: 'stun:stun.xten.com'
                    }];
                moderator.direction = 'many-to-many';
                moderator.session = MODERATOR_SESSION;
                moderator.userid = MODERATOR_ID;
                moderator.extra = MODERATOR_EXTRA;
                moderator.open({
                    dontTransmit: true,
                    sessionid: MODERATOR_SESSION_ID
                });
                document.getElementById("setsetting").disabled = true;
<?php } else { ?>
                var participants = new RTCMultiConnection(MODERATOR_CHANNEL_ID);
                participants.onstream = function (e) {
                    e.mediaElement.width = 600;
                    videosContainer.insertBefore(e.mediaElement, videosContainer.firstChild);
                    rotateVideo(e.mediaElement);
                    scaleVideos();
                };
                participants.onstreamended = function (e) {
                    e.mediaElement.style.opacity = 0;
                    rotateVideo(e.mediaElement);
                    setTimeout(function () {
                        if (e.mediaElement.parentNode) {
                            e.mediaElement.parentNode.removeChild(e.mediaElement);
                        }
                        scaleVideos();
                    }, 1000);
                };
                //participants.iceServers = iceServers;
                participants.join({
                    sessionid: MODERATOR_SESSION_ID,
                    userid: MODERATOR_ID,
                    extra: MODERATOR_EXTRA,
                    session: MODERATOR_SESSION
                });
                document.getElementById("setsetting").disabled = true;
<?php } ?>
        });
<?php if ($action == 'invite') { ?>
            jQuery('#invite').click(function () {
                if (document.getElementById("setsetting").disabled) {
                    $.ajax({
                        type: "POST",
                        url: "<?= url('ajax/chat.cfvideochat'); ?>",
                        data: {action: 'join', channelid: MODERATOR_CHANNEL_ID, roomid: MODERATOR_SESSION_ID, id: '<?= $userid; ?>', cfid: '<?= $userid_get; ?>'},
                        success: function (r) {
                            alert(r);
                        }
                    });
                } else {
                    alert('ابتدا رو دکمه تنظیم کلیک کنید');
                }
            });
<?php } ?>
    });

    function scaleVideos() {
        var videos = document.querySelectorAll('video'),
                length = videos.length,
                video;

        var minus = 130;
        var windowHeight = 700;
        var windowWidth = 600;
        var windowAspectRatio = windowWidth / windowHeight;
        var videoAspectRatio = 4 / 3;
        var blockAspectRatio;
        var tempVideoWidth = 0;
        var maxVideoWidth = 0;

        for (var i = length; i > 0; i--) {
            blockAspectRatio = i * videoAspectRatio / Math.ceil(length / i);
            if (blockAspectRatio <= windowAspectRatio) {
                tempVideoWidth = videoAspectRatio * windowHeight / Math.ceil(length / i);
            } else {
                tempVideoWidth = windowWidth / i;
            }
            if (tempVideoWidth > maxVideoWidth)
                maxVideoWidth = tempVideoWidth;
        }
        for (var i = 0; i < length; i++) {
            video = videos[i];
            if (video)
                video.width = maxVideoWidth - minus;
        }
    }
    function rotateVideo(mediaElement) {
        mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
        setTimeout(function () {
            mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
        }, 1000);
    }
    window.onresize = scaleVideos;
</script>