"use strict";
(function(e,c,f){
    var d=e("#main"),
    a=e("#toolbar"),
    b=e("aside");
    (function(k){
        var j=k.document;
        if(Modernizr.touch&&!location.hash&&k.addEventListener){
            window.scrollTo(0,1);
            var i=1,h=function(){
                return k.pageYOffset||j.compatMode==="CSS1Compat"&&j.documentElement.scrollTop||j.body.scrollTop||0
            },
            g=setInterval(function(){
                if(j.body){
                    clearInterval(g);
                    i=h();
                    k.scrollTo(0,i===1?0:1)
                }
            },15);
            k.addEventListener("load",function(){
                setTimeout(function(){
                    if(h()<20){
                        k.scrollTo(0,i===1?0:1)
                    }
                },0)
            })
        }
    })(window);
    if(e("html").attr("manifest")){
        window.addEventListener("load",function(h){
            try{
                var g=window.applicationCache;g.update();
                if(g.status==g.UPDATEREADY){
                    g.swapCache()
                }
                g.addEventListener("updateready",function(i){
                    if(window.applicationCache.status==window.applicationCache.UPDATEREADY){
                        console.info("Updating Application Cache :)");
                        window.applicationCache.swapCache();
                        if(e.jGrowl){
                            e.jGrowl(c.config.lang.appcache.PLEASE_RELOAD,{
                                header:c.config.lang.appcache.PLEASE_RELOAD_TITLE
                            })
                        }else{
                            if(confirm(c.config.lang.appcache.PROMT_RELOAD)){
                                window.location.reload()
                            }
                        }
                    }else{
                        
                    }
                },false)
            }
            catch(h){
                console.error(h)
            }
        },false)
    }
    c.loaded(function(){
        d=e("#main");
        a=e("#toolbar");
        b=e("aside")
    });
    c.loaded(function(){
        a.find("div.right").find("a").has("span:not(.icon)").addClass("with_red");
        if(e.browser.mozilla){
            e("html").addClass("moz")
        }else{
            if(e.browser.webkit){
                e("html").addClass("webkit")
            }
        }
        var h=!!e.browser.msie,g=parseInt(e.browser.version);
        if(h){
            e("html").addClass("ie");
            g==9&&e("html").addClass("ie9")
        }
    });
    c.loaded(function(){
        var g=e("#content");
        e("h1").each(function(){
            var h=e(this);
            h.wrapInner("<span />")
        });
        g.find(".box:has(.header a.menu)").each(function(){
            var j=e(this),i=j.find(".header").find("a.menu"),h=i.next("menu");
            i.on({
                mousedown:function(){
                    e(this).addClass("active")
                },mouseup:function(){
                    e(this).removeClass("active")
                },click:function(){
                    h.fadeToggle(c.config.fxSpeed);
                    i.toggleClass("open")
                }
            });
            h.find("a").on({
                mousedown:function(){
                    e(this).addClass("active")
                },mouseup:function(){
                    e(this).removeClass("active")
                },click:function(){
                    window.location=this.href;
                    return false
                },dragstart:function(){
                    return false
                }
            }).filter(":has(.icon)").addClass("with-icon")});
            if(g.data("sort")){
                g.sortable({
                    handle:".header",
                    items:g.find(".box").parent(),
                    distance:5,
                    tolerance:"pointer",
                    placeholder:"placeholder",
                    forcePlaceholderSize:true,
                    forceHelperSize:true
                })
            }
            e("#content .accordion").not(".toggle").each(function(){
                e(this).accordion()
            });
            e("#content .accordion.toggle").each(function(){
                e(this).multiAccordion()
            });
            e("#content .tabbedBox").tabbedBox();
            e("#content .vertical-tabs").tabbedBox({header:e(".right-sidebar"),content:e(".vertical-tabs")});
            e("#content .wizard").not(".manual").wizard();
            e(".alert").not(".sticky").find(".icon").after(e("<span>").addClass("close").text("x"));
            e(document).on("click",".alert:not(.sticky) .close",function(){
                e(this).parent().slideUp(c.config.fxSpeed)
            });
            e(window).on("resize scroll",function(){
                e(".ui-dialog").position({my:"center",at:"center",of:window})
            })
        });
        c.loaded(function(){
            var g=e("nav").clone();
            g.addClass("phone").children("ul").removeClass("collapsible accordion").end().find(".badge").remove().end().find(".icon").remove().end().find("img").remove().end().insertAfter("header");
            var h=g.children("ul").children("li").has("ul").children("a");
            h.addClass("with-sub");h.click(function(){
                var i=e(this),j=i.next();
                if(j.is("ul")){
                    if(j.is(":visible")){
                        j.slideUp(c.config.fxSpeed,function(){i.parent().toggleClass("open")})
                    }else{
                        h.next().not(j).slideUp(c.config.fxSpeed);
                        j.slideDown(c.config.fxSpeed);
                        i.parent().toggleClass("open")}return false
                    }
                });
                e("#toolbar").find(".phone").find(".navigation").click(function(){
                    g.fadeToggle(c.config.fxSpeed)
                })
            });
            c.loaded(function(){
                if(window.devicePixelRatio&&window.devicePixelRatio>1){
                    var g=e(".phone-title");
                    if(!g.is("img")){
                        g=g.find("img")
                    }
                    var h=g[0].src;
                    g.error(function(){
                        g.attr("src",h)
                    });
                    g.attr("src",h.replace(".png","@2x.png"))}
                });
                c.loaded(function(){
                    var j=b.find("nav").children("ul");
                    j.initMenu();
                    j.find("li").find("ul").find("li").has(".icon").addClass("with-icon");
                    var n=b.find(".top"),i=b.find(".bottom"),g=e("aside").find("div.progress"),h=e("footer"),l=e(window);
                    g.children().infobar();b.css("min-height",b.find(".top").height()+b.find(".bottom").height());
                    if(i.hasClass("sticky")){
                        var k=function(){
                            i.css({position:"absolute",left:0,top:"auto"})};
                            var m=function(){
                                var o=l.scrollTop()+l.height();
                                k();if(o+4<h.offset().top){
                                    i.css({position:"fixed",left:i.offset().left})
                                }
                                var p=n.offset().top+n.outerHeight();
                                if(i.offset().top-1<=p){
                                    i.css({top:p-d.offset().top,left:0,position:"absolute"})
                                }
                            };
                            m();
                            l.bind("scroll resize",m)}});
                            c.loaded(function(){
                                var h=function(){
                                    if(e.validator){
                                        var l=e(this),j=l.parents("form"),k=j.data("validator");
                                        if(k){k.element(this)}}};
                                        e.extend(e.ui.dialog.prototype.options,{minWidth:350,resizable:false,show:{effect:"fade",duration:800},hide:{effect:"fade",duration:800}});
                                        e("#content").find(".ui-progressbar").each(function(){var j=e(this);
                                        j.progressbar(j.data())});e.extend(e.datepicker,{_checkOffset:function(j,l,k){return l}});
                                        e.extend(e.datepicker._defaults,{showButtonPanel:true,showOtherMonths:true,closeText:"Close"});
                                        var g={onSelect:h,onClose:h};e.extend(e.datepicker._defaults,g);e.extend(e.timepicker._defaults,g);
                                        e("input[type=date]").each(function(){
                                            var j=e(this);
                                            if(e.browser.webkit){j[0].type="text"}j.datepicker()
                                        });
                                        e("input[type=datetime]").each(function(){
                                            e(this).datetimepicker().blur(h)});
                                            e("input[type=time]").each(function(){
                                                e(this).timepicker({ampm:e(this).data("data-timeformat")==12}).blur(h)
                                            });
                                            var i={onselect:_.debounce(function(j,k){(k.input||k.$input).data("mirror").val(j)},300),setup:function(k){var j=e("<input>",{id:k.data("id"),"class":"mirror",name:k.data("name"),required:k.attr("required")||"false"}).hide().insertAfter(k);k.data("mirror",j)}};e("div[data-type=date]").each(function(){var j=e(this);i.setup(j);j.datepicker({onSelect:i.onselect})});e("div[data-type=datetime]").each(function(){var j=e(this);i.setup(j);j.datetimepicker({onSelect:i.onselect})});e("div[data-type=time]").each(function(){var j=e(this);i.setup(j);j.timepicker({onSelect:i.onselect,ampm:e(this).data("data-timeformat")==12})});e("input[data-type=range]").mslider();(function(){var k=e("input.eq[data-type=range]").next();var j=k.length+1;k.each(function(){e(this).css("z-index",j--)})})();e("[data-type=autocomplete]").each(function(){var j=e(this);j.attr("autocomplete","off");j.autocomplete({source:j.data("data")||j.data("source"),disabled:!!j.attr("disabled"),minLength:j.data("minlength")||1,position:{my:"top",at:"bottom",offset:"0 10",collision:"none"},select:h})});e(window).resize(_.debounce(function(){e("[data-type=autocomplete]").each(function(){var k=e(this),j=k.data("autocomplete").menu.element;j.width(k.outerWidth()).position({my:"top",at:"bottom",offset:"0 10",collision:"none",of:k})})},300))});c.loaded(function(){e.fullCalendar.setDefaults({header:{left:"prev,next",center:"title",right:"month,agendaWeek,agendaDay"}})});c.loaded(function(){e(".chart").not(".manual").chart()});c.loaded(function(){e(".full-stats").fullstats();e(".full-stats.equalHeight").equalHeight()});c.loaded(function(){e(".box").each(function(){var g=e(this);if(g.children(".content").children("table").length){g.addClass("with-table")}});e("table.dynamic").table()});c.loaded(function(){(function(g){g.transitions.fadeIn=function(){var k=g.wrap,m=g.current,j=m.nextEffect,l=j==="elastic",i=g._getPosition(l),h={opacity:1};i.opacity=0;k.css(i).show().animate(h,{duration:j==="none"?0:m.nextSpeed,easing:m.nextEasing,complete:g._afterZoomIn})};g.transitions.fadeOut=function(){var j=g.wrap,l=g.current,i=l.prevEffect,h={opacity:0},k=function(){e(this).trigger("onReset").remove()};j.removeClass("fancybox-opened");h.opacity=0;j.animate(h,{duration:i==="none"?0:l.prevSpeed,easing:l.prevEasing,complete:k})}}(jQuery.fancybox));e(".gallery").each(function(){var g=e(this);g.find("a:has(img)").attr("rel",_.uniqueId("gallery"));g.find(".image:has(menu)").each(function(){var j=e(this),i=j.find("a.menu"),h=i.next("menu");h.show().position({my:"left top",at:"left bottom",of:i,offset:"-3 3"}).hide();
                                            i.on({mousedown:function(){e(this).addClass("active")},mouseup:function(){e(this).removeClass("active")},click:function(){h.fadeToggle(c.config.fxSpeed);i.toggleClass("open")}});h.find("a").on({mousedown:function(){e(this).addClass("active")},mouseup:function(){e(this).removeClass("active")},click:function(){window.location=this.href;return false},dragstart:function(){return false}}).filter(":has(.icon)").addClass("with-icon")})});e(".gallery a:has(img)").fancybox({padding:0,nextMethod:"fadeIn",nextSpeed:250,prevMethod:"fadeOut",prevSpeed:250})});
                                            c.loaded(function(){
                                                e("input:checkbox").checkbox({cls:"checkbox",empty:"<?php echo(theme::url('img/elements/checkbox/empty.png')); ?>"});
                                                e("input:radio").checkbox({cls:"radiobutton",empty:"<?php echo(theme::url('img/elements/checkbox/empty.png')); ?>"});
                                                var g=e("select").not(".dualselects");
                                                g.each(function(){
                                                    var k=e(this);
                                                    k.chosen({disable_search_threshold:k.hasClass("search") ?0: 10,allow_single_deselect:true,width:k.data("width")||"95%"})});
                                                    e(".chzn-done").on("change",function(){
                                                        var k=e(this).parents("form").validate();
                                                        k&&k.element(e(this))
                                                    }).each(function(){
                                                        var l=e(this),k=l.parents("form");
                                                        k.on("reset",function(){
                                                            l[0].selectedIndex=-1;
                                                            l.trigger("liszt:updated")
                                                        });
                                                        k.data("chzn-reset",true)
                                                    });
                                                    if(!Modernizr.touch){e("select.dualselects").dualselect()}
													//e("input[type=file]").fileInput();
                                                   
                                                    e("input[data-type=spinner]").each(function(){
                                                        var l=e(this),k=l.data();
                                                        if(k.format){
                                                            k.numberformat=k.format;
                                                            k.format=f
                                                        }l.spinner(k)});
                                                        e("input[type=color]").not(".flat").each(function(){
                                                            var n=e(this).hide(),l=e('<div class="cpicker"><div class="color"></div></div>').insertAfter(n),m=l.children();
                                                            n.val()?m.css("background",n.val()):n.val("#ff0000");
                                                            var k=n.val();
                                                            l.ColorPicker({onChange:function(o,q,p){n.val("#"+q);m.css("background","#"+q)}});
                                                            l.ColorPickerSetColor(k);
                                                            n.parents("form").on("reset",function(){
                                                                n.val(k);
                                                                l.ColorPickerSetColor(k);
                                                                m.css("background",k)
                                                            })
                                                        });
                                                        e("input[type=color].flat").each(function(){var m=e(this).hide(),l=e("<div>").insertAfter(m);!m.val()&&m.val("#ff0000");var k=m.val();l.ColorPicker({flat:true,onChange:function(n,p,o){m.val("#"+p)}});l.ColorPickerSetColor(k);m.parents("form").on("reset",function(){m.val(k);l.ColorPickerSetColor(k)})});e("textarea.editor").each(function(){var l=e(this),k=l.hasClass("full");l.cleditor({width:k?"auto":"100%",height:"250px",useCSS:true});k&&l.parents(".cleditorMain").addClass("full")});var j=function(){e("#content,#login,.ui-dialog:not(:has(#settings))").find("form").each(function(){var m=e(this);var n=m.find(".row"),k=n.children("label"),l=n.children("div");k.css("width","");l.css("height","");
                                                    l.css("margin-right","");k.equalWidth();l.css("margin-right",k.width()+parseInt(k.css("margin-left")));k.each(function(){var r=e(this),o=r.next();var p=r.outerHeight(),q=o.height();if(p>q){o.height(p)}});if(!m.parents(".box").length&&!m.is(".box")){m.addClass("no-box")}m.find(":password.meter").each(function(){e(this).data("reposition")&&e(this).data("reposition")()})})};j();c.utils.forms={resize:j};e(window).on("fontsloaded",function(){j()});var i=e(window).width();e(window).on("resize",_.debounce(function(){j()},200));var h=function(l,k){l.css("padding-left",k.outerWidth(true))};e("form").each(function(){var l=e(this),k=l.find("label.inline");k.each(function(){var m=e(this),n=e("#"+m.attr("for"));h(n,m);e(window).on("fontsloaded",function(){h(n,m)});m.position({my:"left center",at:"left center",of:n,using:function(o){m.css("top",o.top)}})})})});
                                                    c.loaded(function(){elFinder.prototype._options.resizable=false;e(".explorer").each(function(){var g=e(this);g.elfinder({url:g.data("backend")||"extras/explorer/"})})});c.loaded(function(){c.ready(function(){e("#animprog").progressbar({fx:{animate:true,duration:5,start:new Date(new Date().getTime()+5*1000)}})});if(e(".calendar.demo").length){var h=new Date();var i=h.getDate();var g=h.getMonth();var j=h.getFullYear();e(".calendar.demo").fullCalendar({editable:true,events:[{title:"All Day Event",start:new Date(j,g,1)},{title:"Long Event",start:new Date(j,g,i-5),end:new Date(j,g,i-2)},{id:999,title:"Repeating Event",start:new Date(j,g,i-3,16,0),allDay:false},{id:999,title:"Repeating Event",start:new Date(j,g,i+4,16,0),allDay:false},{title:"Meeting",start:new Date(j,g,i,10,30),allDay:false},{title:"Lunch",start:new Date(j,g,i,12,0),end:new Date(j,g,i,14,0),allDay:false},{title:"Birthday Party",start:new Date(j,g,i+1,19,0),end:new Date(j,g,i+1,22,30),allDay:false},{title:"Click for Google",start:new Date(j,g,28),end:new Date(j,g,29),url:"http://google.com/"}]})}});
                                                    c.ready(function(){
                                                        e("a.button.disabled").click(function(){
                                                            return false;
                                                        });
                                                    });
                                                    c.ready(function(){e("textarea").not(".nogrow").not(".editor").autosize();
                                                    e("input:password.meter").passwordMeter();e(".maskDate").mask("99/99/9999")
                                                    ;e(".maskPhone").mask("(999) 999-9999");
                                                    e(".maskPhoneExt").mask("(999) 999-9999? x99999");
                                                    e(".maskIntPhone").mask("+33 999 999 999");
                                                    e(".maskTin").mask("99-9999999");
                                                    e(".maskSsn").mask("999-99-9999");
                                                    e(".maskProd").mask("a*-999-a999");
                                                    e(".maskPo").mask("PO: aaa-999-***");
                                                    e(".maskPct").mask("99%");
                                                    e(".maskCustom").each(function(){e(this).mask(e(this).data("mask")||"")});
                                                    e.validator.addMethod("strongpw",function(h,g){return e.pwdStrength(h)>80},"Your password is insecure");
                                                    e.validator.addMethod("checked",function(h,g){return !!e(g)[0].checked},"You have to select this option");
                                                    e.validator.setDefaults({ignore:":hidden:not(select.chzn-done):not(input.mirror):not(:checkbox):not(:radio):not(.dualselects),.ignore",success:function(g){e(g).prev().filter(".error-icon").removeClass("error-icon").addClass("valid-icon");
                                                    e(g).prev(".customfile").removeClass("error")},errorPlacement:function(g,i){
                                                        if(i.hasClass("customfile-input-hidden")){
                                                            
                                                        }else{
                                                            if(i.hasClass("customfile-input-hidden")){
                                                                g.insertAfter(i.parent().addClass("error"));
                                                            }else{
                                                                if(i.is(":password.meter")||i.is("textarea")||i.is(".ui-spinner-input")||i.is("input.mirror")){
                                                                    g.insertAfter(i);
                                                                }else{
                                                                    if(i.is(":checkbox")||i.is(":radio")){
                                                                        if(i.is(":checkbox")){
                                                                            g.insertAfter(i.next().next());
                                                                        }else{
                                                                            g.insertAfter(e("[name="+i[0].name+"]").last().next().next())
                                                                        }
                                                                    }else{
                                                                        if(i.is("select.chzn-done")||i.is(".dualselects")){
                                                                            g.insertAfter(i.next())
                                                                        }else{
                                                                            g.insertAfter(i);
                                                                            var h=e('<div class="error-icon icon" />').insertAfter(i).position(
                                                                                {my:"left",at:"l",of:i,offset:"-5 0",overflow:"none",using:function(l){
                                                                                    var k=e(this).offsetParent().outerWidth();
                                                                                    var j=k-l.right-e(this).outerWidth();
                                                                                    e(this).css({right:"",left:j,top:l.top})
                                                                                    }   
                                                                                }
                                                                            );
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    },showErrors:function(i,h){
                                                        var g=this;
                                                        this.defaultShowErrors();
                                                        h.forEach(function(l){
                                                            var k=e(l.element),j=g.errorsFor(l.element);
                                                            if(k.data("errorType")=="inline"||k.is("select")||k.is("textarea")||k.hasClass("customfile-input-hidden")||k.is("input.mirror")||k.is(":checkbox")||k.is(":radio")||k.is(".dualselect")){var m;if(k.is("select")){m=k.next()}else{if(k.is(":checkbox")||k.is(":radio")){if(k.is(":checkbox")){m=k.next()}else{m=e("[name="+k[0].name+"]").last().next().next()}j.css("display","block")}else{if(k.is("input.mirror")){m=k.prev()}else{m=k}}}j.addClass("inline").position({my:"left top",at:"left bottom",of:m,offset:"0 5",collision:"none"});if(!(k.is(":checkbox")&&k.is(":radio"))){j.css("left","")}}else{j.position({my:"right top",at:"right bottom",of:k,offset:"1 8",using:function(p){var o=e(this).offsetParent().outerWidth();var n=o-p.left-e(this).outerWidth();e(this).css({left:"",right:n,top:p.top})}})}j.prev().filter(".valid-icon").removeClass("valid-icon").addClass("error-icon");if(k.hasClass("noerror")){j.hide();k.next(".icon").hide()}});this.successList.forEach(function(j){g.errorsFor(j).hide()})}});e("form.validate").each(function(){e(this).validate({submitHandler:function(g){e(this).data("submit")?e(this).data("submit")():g.submit()}})});e("form.validate").on("reset",function(){var g=e(this);g.validate().resetForm();g.find("label.error").remove().end().find(".error-icon").remove().end().find(".valid-icon").remove().end().find(".valid").removeClass("valid").end().find(".customfile.error").removeClass("error")});if(!("form" in document.createElement("input"))){e("input:submit").each(function(){var g=e(this);if(g.attr("form")){g.click(function(){e("#"+g.attr("form")).submit()})}});e("input:reset").each(function(){var g=e(this);if(g.attr("form")){g.click(function(){e("#"+g.attr("form"))[0].reset()})}})}});c.ready(function(){var h=!!e.browser.msie,g=parseInt(e.browser.version);if(h&&g<8){e("input[type=search]").addClass("search");e('input[type="search"] + ul.searchResults').addClass("in_toolbar")}if(h&&g==9){e("button, input:submit, input:reset, input:button").addClass("gradient")}if(h&&g<9){a.find("div.right").find("a").has("span.icon").addClass("has_icon")}if(h&&g==9){b.find(".badge").addClass("gradient")}e("input, textarea").placeholder()});
															
															c.ready(function(){
																var h=d.find("section.toolbar").find("div.user"),
																i=d.find("ul.shortcuts").find("li").has("div"),
																j=a.children().find("ul").find("li").has("div.popup"),
																k=d.find(".box").find(".header").find("menu"),
																g=d.find(".gallery").find("menu");
																e("html").click(function(m){
																	var l=e(m.target);
																	if(l.hasClass("ui-widget-overlay")||l.hasClass("ui-dialog ui-widget")||l.parents(".ui-dialog").length){return}
																	if(m.target!==h[0]&&!h.doesHave(m.target)&&h.hasClass("clicked")){h.find("ul").slideUp(c.config.fxSpeed,function(){h.removeClass("clicked")})}
																	k.each(function(){
																		var n=e(this);
																		if(n.is(":visible")&&m.target!=n.prev()[0]&&!n.doesHave(m.target)){
																			n.prev().removeClass("open");
																			n.fadeOut(c.config.fxSpeed)
																		}
																	});g.each(function(){
																		var n=e(this);
																		if(n.is(":visible")&&m.target!=n.prev()[0]&&!n.doesHave(m.target)){
																			n.prev().removeClass("open");
																			n.fadeOut(c.config.fxSpeed)
																		}
																	})
																})
															});
															c.ready(function(){if(!e.fn.tipsy){return}e.fn.tipsy.defaults.opacity=1;e(".tooltip").each(function(){var h=e(this),g=h.data("gravity")||e.fn.tipsy.autoNS,i=h.data("anim")||true;h.tipsy({gravity:g,fade:i})})});c.ready(function(){d.find("section.toolbar").find("div.user").click(function(){var g=e(this);if(g.hasClass("clicked")){g.find("ul").slideUp(c.config.fxSpeed,function(){g.removeClass("clicked")})}else{g.find("ul").slideDown(c.config.fxSpeed);g.addClass("clicked")}}).find("ul").click(c.utils.noBubbling)});c.ready(function(){var g=d.find("ul.shortcuts").find("li").has("div").each(function(){var h=e(this),i=h.children("div");h.click(function(j){g.not(h).children("div").fadeOut(c.config.fxSpeed,function(){g.not(h).removeClass("active")});i.fadeToggle(c.config.fxSpeed);h.toggleClass("active")});i.click(c.utils.noBubbling)})});c.ready(function(){var g=a.children().find("ul").find("li").has("div.popup").each(function(){var i=e(this),j=i.children("div");i.click(function(k){if(i.hasClass("disabled")){return false}g.not(i).children("div").fadeOut(c.config.fxSpeed,function(){g.not(i).removeClass("active")});j.fadeToggle(c.config.fxSpeed);i.toggleClass("active");return false});j.click(c.utils.noBubbling)});var h=e(".mail").has(".text");h.on("click","li",function(){h.find(".text:visible").slideUp(c.config.fxSpeed/2);e(this).find(".text:hidden").slideToggle(c.config.fxSpeed/2)}).on("hover","li",function(){e(this).toggleClass("normal")}).find(".text").hover(function(){e(this).parent("li").toggleClass("normal")}).click(c.utils.noBubbling);g.each(function(){var i=e(this);i.find(".popup").show().position({my:"top",at:"bottom",of:i,offset:"0 15"}).hide()})});c.ready(function(){d.find(".toolbar").find('input[type="search"]').search({minLength:2})});c.ready(function(){if(c.config.scollToTop){var g=e("<a>",{href:"#top",id:"gotoTop"}).appendTo("body"),h=e(window);h.scroll(_.debounce(function(){if(!jQuery.support.hrefNormalized){g.css({position:"absolute",top:h.scrollTop()+h.height()-settings.ieOffset})}if(h.scrollTop()>=1){g.fadeIn()}else{g.fadeOut()}},300)).scroll();g.click(function(){e("html, body").animate({scrollTop:0});return false})}});c.ready(function(){e.jGrowl.defaults.life=8000;e.jGrowl.defaults.pool=5});c.utils.tryF(function(){SyntaxHighlighter.autoload=function(i){function h(j){j=j||window.event;if(!j.target){j.target=j.srcElement;j.preventDefault=function(){this.returnValue=false}}SyntaxHighlighter.autoloader.apply(this,i);SyntaxHighlighter.all()}if(window.attachEvent){window.attachEvent("onload",h)}else{window.addEventListener("load",h,false)}};function g(l,m){var h=[];for(var j=0;j<m.length;++j){var k=m[j].slice();k[k.length-1]=l+k[k.length-1];h.push(k)}return h}SyntaxHighlighter.autoload(g("js/mylibs/syntaxhighlighter/",[["applescript","shBrushAppleScript.js"],["actionscript3","as3","shBrushAS3.js"],["bash","shell","shBrushBash.js"],["coldfusion","cf","shBrushColdFusion.js"],["cpp","c","shBrushCpp.js"],["c#","c-sharp","csharp","shBrushCSharp.js"],["css","shBrushCss.js"],["delphi","pascal","shBrushDelphi.js"],["diff","patch","pas","shBrushDiff.js"],["erl","erlang","shBrushErlang.js"],["groovy","shBrushGroovy.js"],["java","shBrushJava.js"],["jfx","javafx","shBrushJavaFX.js"],["js","jscript","javascript","shBrushJScript.js"],["perl","pl","shBrushPerl.js"],["php","shBrushPhp.js"],["text","plain","shBrushPlain.js"],["py","python","shBrushPython.js"],["ruby","rails","ror","rb","shBrushRuby.js"],["sass","scss","shBrushSass.js"],["scala","shBrushScala.js"],["sql","shBrushSql.js"],["vb","vbnet","shBrushVb.js"],["xml","xhtml","xslt","html","shBrushXml.js"]]))})();c.ready(function(){var i=e("#login"),g=i.find(".login-messages");g.height(g.height());g.children().css("position","absolute");var h=i.find("form");h.validationOptions({invalidHandler:function(){g.find(".welcome").fadeOut();g.find(".failure").fadeIn()}})});c.ready(function(){var g=[];g.push(a.find("li"));g.push(e("nav").find("li"));g.push(e("section.toolbar").find("li").find("a"));g.push(e("header").find("img"));g.push(e("div.avatar").find("img"));g.push(e("ul.shortcuts").find("li"));g.push(e("a.button"));g.push(e(".profile").find(".avatar").children());g.push(e(".messages").find(".buttons").children());g.push(e(".full-stats").find(".stat"));g.push(e(".ui-slider"));g.push(e(".checkbox"));g.push(e(".radiobutton"));g.push(e("#gotoTop"));g.push(e(".uploader"));g.push(e(".dataTables_paginate"));g.push(e(".avatar"));g.push(e("header a"));
                                            
                                            g.push(e(".gallery"));g.push(e(".tabletools").find("a"));
                                            e.each(g,function(){e(this).on("dragstart",function(h){h.preventDefault()})})});
                                            c.ready(function(){e("#loading").fadeOut(c.config.fxSpeed);
                                            e("#loading-overlay").delay(100+c.config.fxSpeed).fadeOut(c.config.fxSpeed*2);
                                            setTimeout(function(){
                                                if(e("#lock-screen").length&&e("#btn-lock").length&&!c.utils.isPhone){
                                                    c.lock()
                                                }
                                            },c.config.fxSpeed)
                                            });
                                c.ready(function(){
                                    if(!c.config.preloadImages){
                                        return
                                    }
                                    c.utils.preload([
                                    "<?php echo(theme::url('img/layout/navigation/arrow-active.png')); ?>",
                                    "<?php echo(theme::url('img/layout/navigation/arrow-hover.png')); ?>",
                                    
                                    "<?php echo(theme::url('img/layout/navigation/arrow.png')); ?>",
                                    "<?php echo(theme::url('img/layout/navigation/bg-current.png')); ?>",
                                    "<?php echo(theme::url('img/layout/navigation/bg-active.png')); ?>",
                                    "<?php echo(theme::url('img/layout/navigation/bg-hover.png')); ?>",
                                    "<?php echo(theme::url('img/layout/navigation/bg-normal.png')); ?>"
                                ]);
                                c.utils.preload([
                                "<?php echo(theme::url('img/layout/sidebar/bg-right.png')); ?>",
                                "<?php echo(theme::url('img/layout/sidebar/bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/sidebar/divider.png')); ?>",
                                "<?php echo(theme::url('img/layout/sidebar/shadow-right.png')); ?>",
                                "<?php echo(theme::url('img/layout/sidebar/shadow.png')); ?>",
                                "<?php echo(theme::url('img/layout/sidebar-right/header-bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/sidebar-right/nav-bg-hover.png')); ?>",
                                "<?php echo(theme::url('img/layout/sidebar-right/nav-bg.png')); ?>"
                                ]);
                                c.utils.preload([
                                "<?php echo(theme::url('img/layout/toolbar/bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/bg-active.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/bg-disabled.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/bg-hover.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/bg-red-active.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/bg-red-disabled.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/bg-red-hover.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/bg-red.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/toolbar/buttons/divider.png')); ?>"
                                ]);
                                c.utils.preload([
                                "<?php echo(theme::url('img/layout/bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/actions-bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/header-bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/menu-active-bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/menu-arrow.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/menu-bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/menu-item-bg-hover.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/menu-item-bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/box/tab-hover.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/bg-shortcuts.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/divider.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/popup-arrow.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/popup-header.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/user/arrow-normal.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/user/avatar-bg.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/user/avatar.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/user/bg-hover.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/user/bg-menu-hover.png')); ?>",
                                "<?php echo(theme::url('img/layout/content/toolbar/user/counter.png')); ?>"
                                ]);
                                c.utils.preload([
                                "<?php echo(theme::url('img/elements/breadcrumb/bg-active.png')); ?>",
                                "<?php echo(theme::url('img/elements/breadcrumb/bg-hover.png')); ?>",
                                "<?php echo(theme::url('img/elements/breadcrumb/divider-active.png')); ?>",
                                "<?php echo(theme::url('img/elements/breadcrumb/divider-hover.png')); ?>"
                                ]);
                                c.utils.preload([
                                "<?php echo(theme::url('img/elements/headerbuttons/bg-active.png')); ?>",
                                "<?php echo(theme::url('img/elements/headerbuttons/bg-hover.png')); ?>"
                                ])})})(jQuery,$$);