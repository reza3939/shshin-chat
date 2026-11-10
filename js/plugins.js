"use strict";
(!window.console||!console.log)&&function(){
    for(
    var h=function(){},
    f="assert clear count debug dir dirxml error exception group groupCollapsed groupEnd info log markTimeline profile profileEnd markTimeline table time timeEnd timeStamp trace warn".split(" "),e=f.length,g=window.console={};e--;){g[f[e]]=h}}();(function(a,b){a.fn.doesHave=function(c){return !!this.has(c).length}})(jQuery);
    (function(a,b){
        a.fn.insert=function(c){
            var d=this[0];
            if(typeof c=="string"){
                d.innerHTML+=c;return a(d.children)
            }else{
                if(c.jquery){
                    d.innerHTML+=c.html();
                    return a(d.children)
                }else{
                    return this.append(c)
                }
            }
        }
    })(jQuery);
    (function(a,b){
        a.fn.equalHeight=function(){
            var c=a(this);
            c.height(Math.max.apply(Math,c.map(function(){
                return a(this).height()}).get()
            ));
            return c
        };
        a.fn.equalWidth=function(){
            var c=a(this);
            c.width(Math.max.apply(Math,c.map(function(){
                return a(this).width()
            }).get()));
            return c
        }
    })(jQuery);
    (function(b,a,c){
        b.fn.alert=function(e,d){
            return b(this).each(function(){
                var g=b(this),h=b.extend({},b.fn.alert.defaults,d,g.data());
                var f="alert "+h.type;
                if(h.noMargin){f+=" no-margin"}
                if(h.position){f+=" "+h.position}
                var j=b('<div style="display:none" class="'+f+' generated">'+e+"</div>");
                j.prepend(b("<span>").addClass("icon"));
                if(!h.sticky){
                    j.find(".icon").after(b("<span>").addClass("close").text("x"))
                }
                var i=g.prepend(j);
                j.fadeIn()
            })
        };
        b.fn.alert.defaults={type:"information",position:"",noMargin:false,sticky:false}
    })(jQuery,this);
    (function(b,a,c){
        b.fn.validationOptions=function(d){
            return b(this).each(function(){
                var e=b(this),f=e.validate();
                if(d.submitHandler){
                    var g=f.settings.submitHandler,h=d.submitHandler;f.settings.submitHandler=function(){
                        !!h.apply(this,arguments)&&g.apply(this,arguments)
                    };
                    delete d.submitHandler
                }
                if(d.invalidHandler){
                    e.on("invalid-form.validate",d.invalidHandler)
                }
                b.extend(f.settings,d)
            })
        }
    })(jQuery,this);
    (function(b,a,c){
        b.fn.initMenu=function(d){
            var e=b(this);
            var f=b.extend({},{accordeon:true},d,e.data());
            return e.each(function(){
                var i=b(this);
                if(i.hasClass("accordion")){f.accordion=true}
                i.find("li:has(ul)").children("a").addClass("with_sub").end().children("ul").addClass("sub");
                var h=i.find(".sub");
                if(f.accordion){
                    h.show();
                    var g=0,j=b();
                    h.each(function(){
                        var k=b(this),l=k.height();
                        if(l>g){g=l;j=k}
                    });
                    h.hide();
                    j.show();
                    i.height(i.height());
                    j.hide()
                }else{
                    h.show();
                    i.height(i.height());h.hide()
                }
                h.filter(function(){
                    return b(this).prev().is(".open")
                }).show();
                i.find("li a").click($$.utils.noBubbling);
                i.find("li a").click(function(n){
                    var m=b(this),k=m.next(),l=$$.config.fxSpeed*2/3;
                    if(f.accordion){
                        if(k.is(".sub:visible")){
                            k.prev().removeClass("open");
                            h.filter(":visible").slideUp(l);
                            return false
                        }else{
                            if(k.is(".sub:hidden")){
                                h.filter(":visible").slideUp(l);
                                i.find(".open").removeClass("open");
                                k.slideDown(l);k.prev().addClass("open")
                            }
                        }
                    }else{
                        if(!k.length){
                            a.location.href=m.attr("href")
                        }else{
                            k.slideToggle(l);
                            k.prev().toggleClass("open")
                        }
                        return false
                    }
                })
            })
        }
    })(jQuery,this);
    (function(d,c,a){
        var b="table";
        d.fn[b]=function(e){
            var f=d(this);
            return d(this).each(function(){
                var h=d(this),l=d.extend(true,{},d.fn[b].defaults,e,h.data());
                if(_.isString(h.data("tableTools"))){
                    h.data("tableTools",d.parseJSON(h.data("tableTools")))
                }
                h.dataTable(d.extend(true,{sDom:(l.filterBar!="none"?'<"filters"fl>':"")+'t<"footer"ip>',sPaginationType:"full_numbers",iDisplayLength:l.maxItemsPerPage,oLanguage:{sLengthMenu:"<span class=text>"+l.lang.SHOW_ENTRIES+"</span> _MENU_",sSearch:"<span class=text>"+l.lang.SEARCH+"</span> _INPUT_"},aLengthMenu:[[5,10,25,50,-1],[5,10,25,50,"All"]]},l.dataTable)).parent().find(".dataTables_length select").data("width","auto");
                var k=h.parent(),j=k.find(".filters");["with-prev-next","full"].forEach(function(n){
                    h.hasClass(n)&&k.addClass(n)
                });
                h.removeClass("full");
                k.prev(".tabletools").insertBefore(h);
                if(l.tableTools.display||k.find(".tabletools").length){
                    if(l.tableTools.display){
                        var g=new TableTools(h.dataTable(),d.extend(true,{sSwfPath:l.tableTools.swfUrl,aButtons:l.tableTools.buttons},l.tableTools.extras))}var m=k.find(".tabletools");
                        if(!m.length){
                            m=d("<div class=tabletools><div class=left></div><div class=right></div></div>").insertBefore(h)
                        }
                        if(l.tableTools.display){
                            m.find("."+l.tableTools.pos).append(g.dom.container)
                        }
                    }
                    if(l.filterBar!="none"){
                        if(l.filterBar!="always"){
                            var i=d("<div class=toggleFilter></div>").insertBefore(k).click(function(){
                                j.slideToggle($$.config.fxSpeed*2/3);
                                i.toggleClass("active")
                            });
                            if(l.showFilterBar){
                                i.addClass("active")
                            }
                        }
                        if(l.filterBar=="always"||l.showFilterBar){
                            k.find(".filters").show()
                        }
                    }
                })
            };
            d.fn[b].defaults={filterBar:"toggle",showFilterBar:false,maxItemsPerPage:5,dataTable:{},tableTools:{display:false,buttons:["copy","csv","xls","pdf"],pos:"right",swfUrl:"extras/datatables/copy_csv_xls_pdf.swf",extras:{}},lang:{SHOW_ENTRIES:"Show entries:",SEARCH:"Search:"}}
        })(jQuery,this,document);
        (function(c,b,a){c.fn.tabbedBox=function(d){
            d=c.extend({},{fxSpeed:$$.config.fxSpeed/1.2,header:".header",content:".content"},d);
            var e=c(this).each(function(){
                var k=function(l,n){
                    if(l.is(":visible")){return}
                    var m=c(".actions[rel="+l[0].id+"]");if(!n){
                        j.children(":visible").hide();
                        l.show();
                        g.hide();
                        m.show();
                        return
                    }
                    g.hide();
                    m.show();
                    j.children(":visible").fadeOut(d.fxSpeed,function(){
                        l.fadeIn(d.fxSpeed,function(){
                            l.find(".ui-accordion").accordion("resize")
                        })
                    })
                };
                var i=c(this),j=_.isString(d.content)?i.find(d.content):c(d.content),g=i.find(".actions[rel]"),f=_.isString(d.header)?i.find(d.header).find("ul"):c(d.header),h=f.find("li.current").find("a").attr("href");
                if(!f.is("ul")){f=f.find("ul")}if(!h){
                    h=f.find("li").first().find("a").attr("href")
                }
                j.children().hide();
                f.on("click","a",function(o){
                    var p=c(this).parent(),m=p.find("a").attr("href"),n=location.hash;
                    var l=f.find("li.current").find("a").attr("href");
                    if(n.split(",").indexOf(l)!=-1){
                        location.hash=n.replace(l,m)
                    }else{
                        location.hash+=((n.length&&",")||"")+m
                    }
                    return false
                });
                c(b).on("hashchange",{anim:true},function(o,m){
                    var m=m==undefined&&true||m;var n=location.hash,l;n.trim().split(",").forEach(function(p){
                        var q=j.find(p);
                        if(q.length){l=q;n=p}
                    });
                    if(l==undefined){
                        l=j.find(f.find("li.current").find("a").attr("href"))
                    }
                    if(l==undefined||!l.length){
                        l=j.find(f.find("a").first().attr("href"))
                    }
                    if(l.length){k(l,m);
                        f.find(".current").removeClass("current");
                        f.find("li:has(a[href=#"+l.attr("id")+"])").addClass("current")
                    }
                })
            });
            c(b).trigger("hashchange",[false]);return e}
        })(jQuery,this,document);
        (function(d,c,a){
			var b="wizard",e=[];
			d.fn[b]=function(f){
				f=d.extend({},
				{onSubmit:function(){return false}},f);
				return d(this).each(function(){
					var l=d(this);
					var k=l.is("form");
					if(!_.contains(e,l[0])){e.push(l[0])}else{return false;}
					var i={box:l,content:l.find(".content"),list:l.find(".steps"),a_list:l.find(".steps").find("a"),prev:l.find(".actions").find(".left").find("a"),next:l.find(".actions").find(".right").find("a").not(".finish"),finish:l.find(".actions").find(".right").find("a.finish")};
					var h=function(q){
						var m=i.a_list.filter(".current"),r=d(m.attr("href"));
						var n=i.a_list.eq(q),o=d(n.attr("href"));
						if(q>j||q<0){return false}
						if(k&&l.hasClass("validate")){
							var s=true,p=l.validate();
							r.find(":input:enabled").each(function(){
								var t=p.element(d(this));
								if(t===undefined){t=true}
								s&=t;
							});
							if(!s){m.addClass("error");return false}
						}
						if(q==j){if(k){$submitok = true;}}
						m.removeClass("current").addClass("success");
						r.hide();
						n.removeClass("error").removeClass("success").addClass("current");
						o.show();if(q==0){i.prev.addClass("disabled")}else{i.prev.removeClass("disabled")}
						if(q==j-1){i.next.hide();i.finish.show().css("display","inline-block")}else{if(!i.next.is(":visible")){i.next.show()}}
						if(k&&$$.utils.forms){$$.utils.forms.resize()}
						g=q;
					},g=0,j=0;j=i.list.children().length;i.a_list.click(function(m){m.preventDefault();h(d(this).parent().index())});i.prev.addClass("disabled");i.prev.click(function(m){m.preventDefault();h(g-1)});i.next.click(function(m){m.preventDefault();h(g+1)});i.finish.click(function(m){m.preventDefault();h(j)})})}})(jQuery,this,document);
					(function(d,c,a){var b="passwordMeter";d.fn[b]=function(e){return d(this).each(function(){var m=d(this),n=_.difference(_.values(d.ui.keyCode),[d.ui.keyCode.DELETE,d.ui.keyCode.COMMA,d.ui.keyCode.PERIOD,d.ui.keyCode.SPACE]),l=d("<div class=passwordmeter></div>").insertAfter(m),i=d('<div class="passwordmeter-wrapper"></div>').insertAfter(l);i.append(l).append(m);var f=true,o=function(){l.position({my:"right",at:"right",of:m,offset:"-10 0"})},j=function(){m.val("");g()};m.data("reposition",o);m.data("reset",j);l.css("opacity",0);var h=new Image();h.src=l.css("background-image").replace(/"/g,"").replace(/url\(|\)$/ig,"");h.onload=function(){k=h.width-l.width()};var k=h.width-l.width();
        var g=function(){
            var p=d.pwdStrength(m.val());
            l.css("background-position","-"+k*(p/100)+"px 0");
            m.data("pwStrength",p)
        };
        m.keypress(function(p){
            var q=d(this);g()
        }).keyup(function(p){
            if(p.which==d.ui.keyCode.DELETE||p.which==8){g()}}).focus(function(){
                if(f){f=false;o()}l.animate({opacity:1})
            })
        })
        }})(jQuery,this,document);
        (function(c,h,e,f,b){
		var d="search",g=".mango_"+d;var a=[];
		c.fn[d]=c.extend(function(m,l){
			var k=this,j=arguments;
			c(this).each(function(){
				var q,n=c(this);
				if(q=a.filter(function(t){return t.el[0]==n[0]})[0]){q=q.inst}else{a.push({el:n,inst:q=i()})}
				if(typeof m==="object"){l=m;m=b}
				m=m||"init";
				m!="init"&&!q.initialized&&c.error("$.fn."+d+" was not initialzed. Please call $.fn."+d+"(options) first.");
				if(c.isFunction(q.get(m))){var p;if(j[0]==l){p=c.makeArray(j)}else{if(j.length>1){p=Array.prototype.slice.call(j,1)}else{p=[l]}}var o=q.get(m).apply(n,p);if(!h.isUndefined(o)){k=o}}else{if(q.get(m)){var s=arguments[0],r=arguments[1];if(!r){k=q.get(s)}else{q.set(s,r)}}else{c.error("Method or property "+m+" does not exist on jQuery.fn."+d)}}});return k},{defaults:{interval:700,minLength:3,source:"search.php",maxResults:5,resultsClass:"searchResults",fxSpeed:$$.config.fxSpeed,imgWidth:50,lang:{NO_RESULTS:"Nothing found.",SHOW_MORE:"Show more results (%num%)&hellip;"}}});function i(){var l={},k=["init","abort","destroy"];c.extend(l,{init:function(n){var o=l.$element=c(this);l.options=c.extend(true,{},l.defaults,n,o.data());l.timer=-1;l.hover=-1;l.events={keyup:function(r){if(r.keyCode==c.ui.keyCode.UP||r.keyCode==c.ui.keyCode.DOWN){if(l.$results.is(":visible")){var q=l.$results.find("li").length;l.$results.find("li").eq(l.hover).removeClass("hover");switch(r.keyCode){case c.ui.keyCode.UP:l.hover=(l.hover-1)%q;if(l.hover<0){l.hover=q-1}break;case c.ui.keyCode.DOWN:l.hover=(l.hover+1)%q;break}l.$results.find("li").eq(l.hover).addClass("hover")}return false}else{if(r.keyCode==c.ui.keyCode.ENTER){var p=l.$results.find("li.hover");if(p.length){e.location.href=p.find("a").attr("href")}return false}else{if(r.keyCode==c.ui.keyCode.ESCAPE){l.abort();l.$element.blur()}}}l.abort();clearTimeout(l.timer);if(o.val().length>l.options.minLength){l.timer=setTimeout(l.search.bind(this),l.options.interval)}else{if(o.val().trim().length==0&&l.$results.is(":visible")){l.$results.fadeOut(l.options.fxSpeed)}}}};for(var m in l.events){o.on(m+g,l.events[m])}c(this).on("blur",function(){l.abort();o.val("");l.$results.fadeOut(l.options.fxSpeed);l.hover=-1});if(!o.next().is("ul."+l.options.resultsClass)){c("<ul>",{"class":l.options.resultsClass}).insertAfter(o)}l.$results=o.next();l.$results.on("mousemove"+g,function(r){var p=c(r.target),q=p.is("li")?p:c(r.target).parents("li");l.hover=q.index();l.$results.find("li").removeClass("hover");q.addClass("hover")});l.initialized=true},search:function(){var n=c(this),m=n.val();n.addClass("loading");l.xhr=c.post(l.options.source,{term:m,max:l.options.maxResults},function(o){var p=[];if(o.length){o.forEach(function(r){var q='<li><a href="'+r.href+'">';if(r.img){q+='<img src="'+r.img+'" width='+l.options.imgWidth+">"}q+="<strong>"+r.title+"</strong>";if(r.descr){q+="<small>"+r.descr+"</small>"}q+="</a></li>";p.push(q)});if(p.length>l.options.maxResults){p=p.slice(0,l.options.maxResults-1);p.push('<li><a href="#" class="showMore">'+l.options.lang.SHOW_MORE.replace("%num%",o.length-l.options.maxResults)+"</a></li>")}}else{p.push('<li><a href="#" class="noResults">'+l.options.lang.NO_RESULTS+"</a></li>")}l.$results.html(p.join("")).fadeIn()},"json");c.when(l.xhr).always(function(){n.removeClass("loading")})},abort:function(){l.xhr&&l.xhr.abort()},destroy:function(){l.$results.remove();l.$input.off(g);a=h.filter(a,function(m){return m.el[0]!=l.$element[0]})},initialized:false},c.fn[d]);var j={};c.extend(j,{get:function(m){if(h.contains(k,m)){return l[m]}},set:function(n,m){if(h.contains(k,n)){l[n]=m}}});return j}})(jQuery,_,this,document);(function(b,a,c){b.fn.infobar=function(d){return b(this).each(function(){var h=b(this),f=b.extend({},b.fn.infobar.defaults,d,h.data(),{colorize:false});var g=function(){return new Number(f.value).numberFormat(f.format)+" / "+new Number(f.max).numberFormat(f.format)},h=b(this).append(b("<strong>",{html:f.title})).append(b("<small>")).append(b('<div class="clearfix">'));var e=h.append(b("<div>",{"class":"small"}).progressbar(f)).children("div.ui-progressbar");e.bind("progressbarchange",function(k){if(f.color){j.addClass(f.color);return}f=h.data(e.data("progressbar").options).data();h.find("small").html(g());var j=e.children();var i=parseInt(f.value/f.max*100);j.removeClass("blue green orange red");if(i<f.maxNormal){j.addClass("blue")}else{if(i<f.maxWarn){j.addClass("orange")}else{j.addClass("red")}}}).trigger("progressbarchange")})};b.fn.infobar.defaults={title:"",value:0,max:0,format:"",color:false,maxNormal:60,maxWarn:90}})(jQuery,this);(function(b,a,c){b.fn.mslider=function(d){return b(this).each(function(){var h=function(k,l){return new Number(k).numberFormat(l+"")},j=b(this).hide(),g=b.extend({},{value:50,min:0,max:100,step:1,range:false,values:c,orientation:"horizontal",disabled:false,onslide:null,tooltip:true,format:"0",pattern:"%n"},d,(function(){var k={};if(j.val()){k.value=j.val()}if(j.attr("disabled")){k.disabled=true}return k})(),j.data());if(_.isString(g.value)&&g.value!=""&&g.value.match(/^\d+:\d+$/)){var e=g.value.match(/^(\d+):(\d+)$/);g.range=[e[1],e[2]]}g.values=(g.range==false||g.range=="max"||g.range=="min")?c:(_.isArray(g.range)?g.range:b.parseJSON(g.range));g.range=g.range==false?"min":(g.range=="max"||g.range=="min"?g.range:true);var f=function(l,k){k?j.val(k[0]+":"+k[1]):j.val(l)};f(g.value,g.values);var i=b("<div>").insertAfter(j).slider({value:g.value,max:g.max,min:g.min,step:g.step,orientation:g.orientation,disabled:g.disabled,slide:function(m,l){f(l.value,l.values);g.onslide&&g.onslide.call(m,l);var k=b(l.handle).find(".slider-tooltip");k.text(g.pattern.replace("%n",h(l.value,g.format)))},start:function(l,k){b(k.handle).find(".slider-tooltip").show().text(g.pattern.replace("%n",h(k.value,g.format)))},stop:function(l,k){b(k.handle).find(".slider-tooltip").hide()},range:g.range,values:g.values});i.find(".ui-slider-handle").each(function(){if(!g.tooltip){return}b('<div class="slider-tooltip">').hide().appendTo(b(this))})})}})(jQuery,this);(function(c,b,a,d){b.settings=function(){b.settings.el.dialog({modal:true,draggable:false,width:b.settings.el.data("width")||b.config.settings.width,open:function(){var h=c(this).parent(),f=h.find(".ui-dialog-titlebar").addClass("settings-header"),g=c(this);h.find(".ui-dialog-titlebar-close").remove();h.find(".ui-dialog-title").remove();h.css("overflow","visible");h.find(".tabs").appendTo(f);h.tabbedBox({header:".settings-header"});h.find("input").each(function(){var q=c(this);q.attr("name",q.attr("id"))});if(g.find(".actions").length){g.addClass("with-actions")}var l=g.find(".save").show(),n=g.find(".saving").hide();l.click(function(){l.hide();n.show();var q=[];g.find("form").each(function(){q.push(c(this).serializeArray())});b.settings.save(function(){g.dialog("close")},q)});var k=g.find(".cancel");k.click(function(){g.dialog("close");g.find(".content").find("form")[0].reset()});var m=g.find(".change_password_button"),p=h.find(".change_password");m.click(function(){p.slideDown();h.find(".tabs").addClass("disabled");g.addClass("disabled")});var e=p.find("input[type=reset]"),i=p.find("input[type=submit]"),j=p.find("input[type=password]");var o=function(){p.fadeOut();h.find(".tabs").removeClass("disabled");g.removeClass("disabled")};e.click(function(){j.val("");j.data("reset")&&j.data("reset")();o();return false});p.find("form").validationOptions({submitHandler:function(){b.settings.changePw(function(){e.click();m.val(m.data("langChanged"))},j.val());return false}})}})};c.extend(b.settings,{el:c("#settings"),save:function(e,f){setTimeout(function(){e()},500)},changePw:function(e,f){e()}});b.loaded(function(){b.settings.el=c("#settings")})})(jQuery,$$,this);(function(b,c,i,e,f,a){var d="lock",g=".mango_"+d;var h;$$[d]=b.extend(function(p,k){var m;if(!h){h=m=j()}else{m=h}if(typeof p==="object"){k=p;p=a}p=p||"init";if(b.isFunction(m.get(p))){var l;if(arguments[0]==k){l=b.makeArray(arguments)}else{if(arguments.length>1){l=Array.prototype.slice.call(arguments,1)}else{l=[k]}}return m.get(p).apply(null,l)}else{if(m.get(p)){var o=arguments[0],n=arguments[1];return(!n&&m.get(o))||(m.set(o,n)&&a)}else{return b.error("Method or property "+p+" does not exist on jQuery.fn."+d)}}},{defaults:{passwordIsValid:function(k){return k.length>2}}});function j(){var l=["init","start","stop"];
        
        b.extend(j,{open:function(){
            $.ajax({
                type: "POST",
                url: '<?php echo(url('ajax/unset/admin')); ?>',
                success: function(data) {
                    if(data == 'ok'){
                        b("#lock-screen").dialog({
                            modal:true,draggable:false,
                            open:function(){
                                b(this).parent().find(".ui-dialog-titlebar-close").remove()
                            }
                        });
                    }else{
                        alert(data);
                    }
                }
            });
            
            },init:function(n){
                j=this;
                j.options=b.extend({},j.defaults,n);
                var o,m;j.pageVisibility={};
                if(typeof f.hidden!=="undefined"){j.pageVisibility.hidden="hidden";j.pageVisibility.visibilityChange="visibilitychange"}else{if(typeof f.mozHidden!=="undefined"){j.pageVisibility.hidden="mozHidden";j.pageVisibility.visibilityChange="mozvisibilitychange"}else{if(typeof f.msHidden!=="undefined"){j.pageVisibility.hidden="msHidden";j.pageVisibility.visibilityChange="msvisibilitychange"}else{if(typeof f.webkitHidden!=="undefined"){j.pageVisibility.hidden="webkitHidden";j.pageVisibility.visibilityChange="webkitvisibilitychange"}else{j.pageVisibility=a}}}}
                    j.el={$lock:b("#lock-screen"),$slider_wrapper:b("#slide_to_unlock"),$display:b("#btn-lock").find("span")};
                    b.extend(j.el,{$form:j.el.$lock.find("form"),$slider:j.el.$slider_wrapper.find("img")});
                    b.extend(j.el,{$pwd:j.el.$form.find("input[type=password]"),$submit:j.el.$form.find("input[type=submit]"),$sliderText:j.el.$slider.next()});
        j.show={
            slider:function(){
                j.el.$pwd.val("").removeClass("error").next(".icon").remove();
                j.el.$submit.attr("disabled","true");
                j.el.$slider.css("right",0);
                j.el.$sliderText.css("opacity",1);
                j.el.$form.stop().hide("fade",500);
                j.el.$slider_wrapper.stop().scale(1).show().animate({opacity:1,bottom:5},300)
            }
            .bind(j),password:function(){
                j.el.$slider_wrapper.animate({bottom:-50,opacity:0.2,scale:1.2},500,function(){j.el.$slider_wrapper.hide()});
                j.el.$form.show("fade",1000,function(){j.el.$form.css("opacity",1)});
                j.el.$pwd.focus();
                j.sliderTimer()
            }.bind(j)
        };
        j.sliderTimer=function(){
            j.sliderTimer.id=setTimeout(function(){
                j.show.slider();
                clearTimeout(j.sliderTimer.id)
            },c.config.lock.idle*1000)
        };
        j.sliderTimer.id=-1;
        j.el.$pwd.keydown(function(){
            clearTimeout(j.sliderTimer.id);
            j.sliderTimer()
        });
        j.el.$slider.draggable({
            axis:"x",containment:"parent",drag:function(p,q){
            j.el.$sliderText.css("opacity",1-(q.position.left/120))
        },stop:function(p,q){
            if(q.position.left+j.el.$slider.outerWidth()<j.el.$slider_wrapper.innerWidth()-5){
                b(this).animate({left:0});
                j.el.$sliderText.animate({opacity:1})
            }else{
                j.show.password()
            }
        }
        });
        if(j.el.$slider[0].addEventListener){
            j.el.$slider[0].addEventListener("touchmove",function(q){
                q.preventDefault();
                var p=q.target;
                var r=q.touches[0];
                curX=r.pageX-j.offsetLeft-73;
                if(curX<=0){return}if(curX>160){
                    $slider_wrapper.fadeOut();$form.fadeIn()
                }
                p.style.webkitTransform="translateX("+curX+"px)"},false);
                j.el.$slider[0].addEventListener("touchend",function(p){j.style.webkitTransition="-webkit-transform 0.3s ease-in";
                j.addEventListener("webkitTransitionEnd",function(q){j.style.webkitTransition="none"},false);
                j.style.webkitTransform="translateX(0px)"},false)}j.el.$form.find("input[type=reset]").click(function(){j.show.slider();return false});
                j.el.$form.submit(function(){
                    if(j.options.passwordIsValid(j.el.$pwd.val())){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo(url('ajax/login/admins')); ?>',
                            data:{username:'<?php $username = Users::get('username'); echo($username); ?>', password:j.el.$pwd.val(), unblock:'true'},
                            success: function(data) {
                                switch(data){
                                    case('ok'):
                                    j.el.$lock.dialog("close");
                                    j.el.$pwd.removeClass("error").next(".icon").remove();
                                    setTimeout(j.show.slider,500);
                                    j.start();
                                    
                                    
                                    
                                    break;
                                    case('pass'):b('<div class="icon error-icon">').insertAfter(j.el.$pwd).position({
                                        my:"right",at:"left",of:j.el.$pwd,offset:"-5 0",overflow:"none",using:function(r){var q=b(this).offsetParent().outerWidth();
                                        var p=q-r.right-b(this).outerWidth();b(this).css({rigt:"",left:p,top:r.top})}
                                    });
                                    j.el.$pwd.addClass("error");break;
                                    case('user'):alert('این نام وجود ندارد');break;
                                    case('benn'):alert('شما اجازه ورود به چتروم را ندارید');break;
                                    case('capacity'):alert('ظرفیت چت روم پر است');break;
                                    default:alert(data);break;
                                }
                            }
                        });
                        
                    }else{
                        b('<div class="icon error-icon">').insertAfter(j.el.$pwd).position({
                            my:"right",at:"left",of:j.el.$pwd,offset:"-5 0",overflow:"none",using:function(r){var q=b(this).offsetParent().outerWidth();
                            var p=q-r.right-b(this).outerWidth();b(this).css({rigt:"",left:p,top:r.top})}
                        });
                        j.el.$pwd.addClass("error");
                        return false
                    }
                return false
            });
            j.el.$pwd.keyup(function(){
                if(j.el.$pwd.val()!=""){
                    j.el.$submit.removeAttr("disabled")
                }else{
                    j.el.$submit.attr("disabled","disabled")
                }
                return true
            });
            b(f).idleTimer(1000);
            b(f).on("idle.idleTimer",function(){
                if(!j.el.$lock.is(":visible")){j.start()}
            });
            b(f).on("active.idleTimer",function(){
                if(!j.el.$lock.is(":visible")){j.stop()}
            });
            c.config.lock.lockWhenInactive&&f.addEventListener(j.pageVisibility.visibilityChange,function(){
                if(f[j.pageVisibility.hidden]){j.stop();j.el.$display.text("--:--");j.open()}
            },false);
            b("#btn-lock").click(function(){
                j.stop();j.el.$display.text("--:--");j.open();return false
            });
            j.start();
            j.initialized=true
        },start:function(){
            m=this;if(!m.el){
                m.init()
            }
            var n=c.config.lock.timeout;
            var m=m;m.el.$display.data("t",n);
            m.el.$display.text(m.utils.formatSeconds(n));
            clearInterval(m.timerId);
            m.timerId=setInterval(function(){
                var o=m.el.$display.data("t");
                o--;if(o==0){
                    m.open();
                    m.stop();
                    m.el.$display.text("--:--")
                }else{
                    m.el.$display.text(m.utils.formatSeconds(o));
                    m.el.$display.data("t",o)}},1000
                )},stop:function(){
                    j=this;
                    clearInterval(j.timerId);
                    j.el.$display.text(j.utils.formatSeconds(c.config.lock.timeout))
                },utils:{formatSeconds:function(n){
                    var m=0;
                    while(n>=60){m++;n-=60}
                    return new Number(m).numberFormat("00")+":"+new Number(n).numberFormat("00")
                }
                },timerId:-1},$$[d]);
			function k(){}
			b.extend(k,{
				publics:i.chain(j).keys().filter(i.bind(i.contains,i,l)),
				get:function(m){
					if(i.contains(l,m)){
						if(i.isFunction(j[m])){
							return j[m].bind(j)
						}else{
							return j[m]
						}
					}
				},set:function(n,m){
					if(i.contains(l,n)){j[n]=m}
				}
			});
		return k
	}
})(jQuery,$$,_,this,document);
(function(c,a,d){var b=c.ui.progressbar.prototype._init;c.ui.progressbar.prototype.options.color="blue";c.ui.progressbar.prototype.options.colorize=true;c.ui.progressbar.prototype.options.animate=false;c.ui.progressbar.prototype.options.maxNormal=60;c.ui.progressbar.prototype.options.maxWarn=90;c.ui.progressbar.prototype._init=function(){var f=this;var g=this.options,h=this.element;var e=["blue","orange","red","grey","auto"];if(g.color&&g.colorize){if(e.indexOf(g.color)==-1){g.color=c.ui.progressbar.prototype.options.color}}if(g.color=="auto"){this.element.bind("progressbarchange",function(j){var i=parseInt(f.options.value/f.options.max*100);h.removeClass("blue green orange red");if(i<f.options.maxNormal){h.addClass("blue")}else{if(i<f.options.maxWarn){h.addClass("orange")}else{h.addClass("red")}}}).trigger("progressbarchange")}if(g.colorize&&g.color!="auto"){h.addClass(g.color)}if(g.animate){h.addClass("animated")}b.apply(this,arguments)}})(jQuery,this);(function(c,a,d){var b=c.ui.progressbar.prototype._init;c.ui.progressbar.prototype.options.fx={animate:false,start:"now",duration:d,finish:d,refresh:16};c.ui.progressbar.prototype._init=function(){var f=this.options.fx,o=this.element;if(!f.animate){return b.apply(this,arguments)}var l=function(p){c.error("Progressbar: "+p);return b.apply(this,arguments)};if(f.start=="now"||!(f.start instanceof Date)){f.start=new Date()}else{if(f.start instanceof Date){if(f.start<new Date()){return l("Cannot start in the past")}}}if(!isNaN(Number(f.duration))){f.finish=new Date(f.start.getTime()+Number(f.duration)*1000)}else{if(f.finish instanceof Date){}else{return l("No valid duration or finish time given!")}}if(f.finish<=f.start){return l("End time before start time? O.o")}this.options.max=100;this.options.value=0;var i=f.finish-f.start,g=new Date(),h=this.element.find(".ui-progressbar-value"),n=false,m=0,e=0,k=-1;var j=function(){if(!n&&e>0){n=true;h.show()}m=new Date()-f.start;e=m/i*100;e=e>=0?e:0;h.css("width",e+"%");if(e>=100){clearInterval(k);this.value(100)}}.bind(this);if(g<f.start){setTimeout(function(){k=setInterval(j.bind(this),f.refresh)},f.start-g-10)}else{k=setInterval(j.bind(this),f.refresh)}b.apply(this,arguments)}})(jQuery,this);(function(c,a,d){var b=c.ui.progressbar.prototype._init;c.ui.progressbar.prototype.options.showtitle="none";c.ui.progressbar.prototype.options.showvalue=false;c.ui.progressbar.prototype._init=function(){var g=this.options,e=this.element;var f=c("<div>",{"class":"progress-title"});if(g.showtitle=="title"){f.text(e.data("title")).insertBefore(e)}else{if(g.showtitle=="percentage"){f.text(parseInt(this.options.value/this.options.max*100)+"%").insertBefore(e)}}if(g.showvalue){g.format=g.format||"";var h=function(){return new Number(g.value).numberFormat(g.format)+" / "+new Number(g.max).numberFormat(g.format)};c("<div>",{"class":"progress-value",text:h()}).insertAfter(e)}b.apply(this,arguments)}})(jQuery,this);(function(c,h,e,f,b){var d="chart",g=".mango_"+d;var a=[];c.fn[d]=c.extend(function(m,l){var k=this,j=arguments;c(this).each(function(){var q,n=c(this);if(q=a.filter(function(t){return t.el[0]==n[0]})[0]){q=q.inst}else{a.push({el:n,inst:q=i()})}if(typeof m==="object"){l=m;m=b}m=m||"init";m!="init"&&!q.initialized&&c.error("$.fn."+d+" was not initialzed. Please call $.fn."+d+"(options) first.");if(c.isFunction(q.get(m))){var p;if(j[0]==l){p=c.makeArray(j)}else{if(j.length>1){p=Array.prototype.slice.call(j,1)}else{p=[l]}}var o=q.get(m).apply(n,p);if(!h.isUndefined(o)){k=o}}else{if(q.get(m)){var s=arguments[0],r=arguments[1];if(!r){k=q.get(s)}else{q.set(s,r)}}else{c.error("Method or property "+m+" does not exist on jQuery.fn."+d)}}});return k},{defaults:{data:[],height:null,type:"lines",points:true,stacked:false,legend:true,fill:null,donut:false,horizontal:false,colors:["#88bbc8","#ee7951","#bc71f","#e5c700"],tooltip:function(k,l,j,m){return(k?(k+" at "):"")+(this.options.flot.xaxis.ticks||(this.options.horizontal&&this.options.flot.yaxis.ticks)?(l!=""?l:j.toFixed(2))+" = ":"")+m.toFixed(2)},events:{click:function(l,j,k){},hover:function(l,j,k){}},series:"rows",showTable:false,flot:{}}});function i(){var l={},k=["init","draw"];c.extend(l,{init:function(q){var r=l.$input=c(this);l.options=c.extend(true,{},l.defaults,q,r.data());var t=[];if(!c.isArray(l.options.colors)){l.options.colors=c.parseJSON(l.options.colors,true)}var s=c("<div>",{"class":"chart",height:l.options.height||r.parent().height()}).insertBefore(r);r.appendTo(s);if(r.is("table")){var o=r;var n=l.parseTable(r);l.options.data=n.data;l.xlabels=n.xlabels;r=l.$input=c("<div>",{"class":"graph"});r.insertAfter(o)}l.options.legend&&(l.$legend_box=c("<div>",{"class":"legend"}).insertBefore(r));var m=parseInt(r.parent().css("padding-top"))+parseInt(r.parent().css("padding-bottom"));if(l.options.height){r.height(l.options.height)}else{r.height(r.parent().height()-m-(l.options.legend?l.$legend_box.height():0)-(l.options.showTable?o.height():0))}o&&!l.options.showTable&&o.remove();l.lastHoverItem=null;l.events={plotclick:function(v,w,u){if(u){switch(l.options.type){case"bars":l.options.events.click.call(r[0],u.seriesIndex,u.datapoint[1],u);break;case"pie":l.options.events.click.call(r[0],u.seriesIndex,u.datapoint[1][0][1],u);break;default:l.options.events.click.call(r[0],u.seriesIndex,u.datapoint[1],u)}}},plothover:function(w,B,E){if(E){switch(l.options.type){case"bars":l.options.events.hover.call(r[0],E.seriesIndex,E.datapoint[1],E);break;case"pie":l.options.events.hover.call(r[0],E.seriesIndex,E.datapoint[1][0][1],E);break;default:l.options.events.hover.call(r[0],E.seriesIndex,E.datapoint[1],E)}if(l.options.tooltip!==false){if(l.lastHoverItem==E.datapoint.toString()){return}l.lastHoverItem=E.datapoint.toString();c(".chart-tooltip").remove();var D=E.datapoint[0];if(E.series.bars.order&&!l.options.horizontal){for(var x=0;x<E.series.data.length;x++){if(E.series.data[x][3]==E.datapoint[0]){D=E.series.data[x][0]}}}else{if(l.options.horizontal){for(var x=0;x<E.series.data.length;x++){if(E.series.data[x][3]==E.datapoint[1]){D=E.series.data[x][1]}}}}var A=parseInt(E.datapoint[1]);if(l.options.horizontal){A=parseInt(E.datapoint[0])}var z="";if(l.options.type=="bars"){z=E.series.xaxis.ticks&&E.series.xaxis.ticks[E.dataIndex].label;if(l.options.horizontal){z=E.series.xaxis.ticks&&E.series.yaxis.ticks[E.dataIndex].label}}else{if(l.options.type=="pie"){z=E.series.xaxis.options.ticks&&E.series.xaxis.options.ticks[0][1]}else{z=E.series.xaxis.ticks&&E.series.xaxis.ticks[E.datapoint[0]].label}}if(!z){z=""}var C="";if(c.isFunction(l.options.tooltip)){C=l.options.tooltip.call(l,E.series.label,z,D,A)}else{C=l.options.tooltip.replace("%label%",E.series.label).replace("%xlabel%",z).replace("%xval%",D).replace("%yval%",A)}var y=c("<div>",{"class":"chart-tooltip",text:C});var v=E.pageX;var u=E.pageY;if(l.options.type=="pie"){c(f).mousemove(function(F){y.css({top:F.pageY+5,left:F.pageX+5})})}else{if(l.options.type=="bars"){y.css({top:u-23,left:v-10})}else{y.css({top:u+5,left:v+5})}}y.appendTo("body").fadeIn(100)}}else{c(".chart-tooltip").remove();l.lastHoverItem=null}}};for(var p in l.events){r.on(p+g,l.events[p])}l.setupChart();l.draw();l.initialized=true},parseTable:function(s){var o={data:[],xlabels:[]};if(l.options.series=="columns"){var m=s.find("tbody th"),r=s.find("thead th"),n=s.find("tbody tr");if(r.length){r=r.slice(1)}var q=[];n.each(function(t,u){c(u).find("td").each(function(v,x){var w=x.innerHTML;q[v]=q[v]||[];if(!isNaN(w)){q[v].push([t,parseInt(w)||0])}})});n.eq(0).find("td").each(function(t,u){o.xlabels.push([t,m.eq(t).text()])});for(var p=0;p<r.length;p++){o.data.push({label:r.eq(p).text(),data:q[p]})}}else{var m=s.find("thead th"),r=s.find("tbody th"),n=s.find("tbody tr");if(r.length){m=m.slice(1)}n.each(function(t,v){var u=[];c(v).find("td").each(function(w,y){var x=y.innerHTML;if(!isNaN(x)){u.push([w,parseInt(x)||0])}});o.data.push({label:r.eq(t).text(),data:(l.options.type!="pie")?u:u[0][1]})});n.eq(0).find("td").each(function(t,u){o.xlabels.push([t,m.eq(t).text()])})}return o},setupChart:function(){if(l.options.type=="bars"){var q=l.options;if(!l.options.stacked){var o,n=1;for(o in q.data){var p=q.data[o];c.extend(true,p,{bars:{order:n++}})}}if(q.horizontal){var o,n;for(o in q.data){var p=q.data[o];for(n=0;n<p.data.length;n++){var m=p.data[n][0];p.data[n][0]=p.data[n][1];p.data[n][1]=m}}}c.extend(true,q.flot,{series:{points:{show:false},bars:{align:"center",order:(q.stacked)?null:true,show:true,border:false,fill:true,fillColor:null,horizontal:q.horizontal,barWidth:(q.stacked)?0.6:0.6/q.data.length,lineWidth:0},lines:{show:false},pie:{show:false}}})}else{if(l.options.type=="pie"){var q=l.options;c.extend(true,q.flot,{series:{points:{show:true},bars:{show:false},lines:{show:false},pie:{show:true,label:true,tilt:1,innerRadius:q.donut?q.donut:0,radius:1}}})}else{var q=l.options;c.extend(true,q.flot,{series:{points:{show:q.points},bars:{show:false},lines:{show:true,lineWidth:2,fill:(q.fill==false)?false:true,fillColor:(q.fill==false)?null:{colors:[{opacity:0},{opacity:0.15}]}},pie:{show:false}}})}}l.options.flot=c.extend(true,{},{series:{stack:(l.options.stacked)?true:null},shadowSize:0,grid:{hoverable:l.options.tooltip!==false,clickable:true,color:"#ededed",markingsColor:"#939393",borderWidth:null},legend:{show:q.legend,position:"ne",container:l.options.legend?l.$legend_box:null},colors:l.options.colors,xaxis:{color:"#939393",labelWidth:30},yaxis:{color:"#939393"}},l.options.flot);if(l.xlabels&&!l.options.horizontal){l.options.flot.xaxis.ticks=l.xlabels}else{if(l.options.horizontal){l.options.flot.yaxis.ticks=l.xlabels}}},draw:function(){c.plot(l.$input,l.options.data,l.options.flot)},initialized:false},c.fn[d]);function j(){}c.extend(j,{publics:h.chain(l).keys().filter(h.bind(h.contains,h,k)),get:function(m){if(h.contains(k,m)){return l[m]}},set:function(n,m){if(h.contains(k,n)){l[n]=m}}});return j}})(jQuery,_,this,document);(function(c,h,e,f,b){var d="fullstats",g=".mango_"+d;var a=[];c.fn[d]=c.extend(function(j,s){var o=this,p=arguments;var n,r=c(this);if(n=a.filter(function(t){return t.el[0]==r[0]})[0]){n=n.inst}else{a.push({el:r,inst:n=i()})}if(typeof j==="object"){s=j;j=b}j=j||"init";j!="init"&&!n.initialized&&c.error("$.fn."+d+" was not initialzed. Please call $.fn."+d+"(options) first.");if(c.isFunction(n.get(j))){var k;if(p[0]==s){k=c.makeArray(p)}else{if(p.length>1){k=Array.prototype.slice.call(p,1)}else{k=[s]}}var q=n.get(j).apply(r,k);if(!h.isUndefined(q)){o=q}}else{if(n.get(j)){var l=arguments[0],m=arguments[1];if(!m){o=n.get(l)}else{n.set(l,m)}}else{c.error("Method or property "+j+" does not exist on jQuery.fn."+d)}}return o},{defaults:{selector:".stat",simple:{value:0,format:"0",title:""},minichart:{values:[],total:0,format:"0",title:"",change:null,color:""},load:{value:0,min:0,max:100,format:"%"},level:{value:50,max:100,format:"",description:""},pillar:{data:[],format:""},circular:{value:0,max:100,format:"%",valueformat:"",width:5,color:"",list:null,displaymax:true},uptime:{servers:[],left:"lastDowntime",right:"response",lang:{online:"Online",offline:"Offline",lastDowntime:"Last downtime",response:"Response time"}},list:{list:[],color:""},hlist:{list:[],flexiwidth:false}}});function i(){var k={},l=["format","formatPosNeg"];c.extend(k,{format:function(n,m){if(m=="%"){return n+"%"}else{if(m=="+-"||m=="-+"){return k.formatPosNeg(n)}else{if(m=="+-%"||m=="-+%"){return k.formatPosNeg(n)+"%"}}}return new Number(n).numberFormat(m)},formatPosNeg:function(m){return(m!=0?k.format(m,"+0;-0"):m)},init:function(m){var n=k.$element=c(this);k.options=c.extend(true,{},k.defaults,m,n.data());n=h.map(n,function(p){var o=c(p);return o.is(k.options.selector)?o:o.find(k.options.selector)});h.each(n,function(o){h.each(o[0].classList,function(p){if(h.isFunction(k[p])){k[p](c(o))}})});k.initialized=true},simple:function(m){var o=c.extend({},k.options.simple,m.data());if(o.format===0){o.format=m.attr("data-format")}var p=k.format(o.value,o.format);var q=o.title;if(/^\+/.test(p)){m.addClass("positive")}else{if(/^\-/.test(p)){m.addClass("negative")}}var n="<div class=title>"+q+"</div>";n+="<div class=value>"+p+"</div>";m.insert(n);if(m.is("a")){m.addClass("link")}},minichart:function(m){var p=c.extend({},k.options.minichart,m.data());if(p.format===0){p.format=m.attr("data-format")}if(!c.isArray(p.values)){p.data=c.parseJSON(p.values)}if(/^\+/.test(p.total)){m.addClass("positive")}else{if(/^\-/.test(p.total)){m.addClass("negative")}}var o="<div class=left><div class=title>"+p.title+"</div>";o+="<div class=total>"+k.format(p.total,p.format)+"</div></div>";o+="<div class=right><div class=minichart></div>";o+=h.isNumber(p.change)?"<div class=change>"+k.format(p.change,"+-%")+"</div>":"";m.insert(o);if(p.change==0&&!p.color){p.color="grey"}else{if(p.change>0&&!p.color){p.color="green"}else{if(p.change<0&&!p.color){p.color="red"}}}var n="";(function(){var q=c('<div class="circular-fg '+(p.color||"")+'">').appendTo("body");n=q.css("color");q.remove()})();m.find(".minichart").sparkline(p.values,{type:"bar",barColor:n,negBarColor:n,disableTooltips:true});m.find(".change").addClass(p.color);m.find(".total").addClass(p.color);m.children().equalHeight()},load:function(n){var q=c.extend({},k.options.load,n.data());if(q.format===0){q.format=n.attr("data-format")}if(q.value>q.max){q.value=q.max}var r=k.format(q.value,q.format),m=k.format(q.max,q.format),p=k.format(q.min,q.format);var o="<div class=value>"+r+"</div>";o+="<div class=bg></div>";o+="<div class=gauge></div>";o+="<div class=min>"+p+"</div>";o+="<div class=max>"+m+"</div>";n.insert(o);n.find(".gauge").rotate(180*(q.value/q.max))},level:function(m){var p=c.extend({},k.options.level,m.data());var n='<div class="gauge-container"><div class="gauge'+(p.value==p.max?" full":"")+'" style="height:'+(p.value/p.max*100)+'%"></div></div>';m.insert(n);var q="<div class=max>"+k.format(p.max,p.format)+"</div>";q+="<div class=info><div class=value>"+k.format(p.value,p.format)+"</div><div class=description>"+p.description+"</div></div>";m.insert(q);var o=m.find(".gauge-container").height();m.find(".info").css("top",Math.min(o+10,35+o-m.find(".gauge").height()))},pillar:function(q){var m=c.extend({},k.options.pillar,q.data());if(!c.isArray(m.data)){m.data=c.parseJSON(m.data)}var v=m.data.map(function(w){return w.val}).reduce(function(x,w){return x+w});var r=q.insert('<div class="pillar-container"></div>');var o=r.height();var p="";c.each(m.data,function(){if(this.val<=0){return}var w=o*(this.val/v);if(c.browser.webkit){w=Math.round(w)}p+='<div class="inner '+(this.color||"green")+'" style="height:'+w+'px"><div class=level></div><div class=value>'+k.format(this.val,m.format)+"</div><div class=title>"+this.title+"</div></div>"});r.insert(p);var t=r.find(".value");var u=Math.max.apply(Math,t.map(function(){var w=c(this);return w.position().left+w.width()}).get())+parseInt(t.css("padding-right"));var n=r.find(".title").css("left",u+"px");var s=Math.max.apply(Math,n.map(function(){return c(this).width()}).get());r.css("margin-right",u+s-r.find(".inner").width()+"px")},circular:function(q){var m=c.extend({},k.options.circular,q.data());if(m.format===0){m.format=q.attr("data-format")}if(m.valueformat===0){m.valueformat=q.attr("data-valueformat")}if(m.list){if(!c.isArray(m.list)){m.list=c.parseJSON(m.list)}m.value=m.list.map(function(C){return h.isNumber(C.percent)?C.percent:C.val}).reduce(function(D,C){return D+C})}var o="<div class=value>";if(m.list&&m.format=="%"&&m.value>0){o+="+"}o+=k.format(m.value,m.format);if(m.format!="%"&&m.displaymax){o+="<small>/"+k.format(m.max,m.format)+"</small>"}o+="</div>";if(m.value==0&&!m.color){m.color="grey"}else{if(m.list&&m.value>0&&!m.color){m.color="green"}else{if(m.list&&m.value<0&&!m.color){m.color="red"}}}m.color&&q.addClass(m.color);var t="";var y="";(function(){var C=c('<div class="circular-fg '+(m.color||"")+'">').appendTo("body");var D=c('<div class="circular-bg '+(m.color||"")+'">').appendTo("body");t=C.css("color");y=D.css("color");C.remove();D.remove()})();var x=q.insert("<canvas></canvas>"),p=x[0],B=x[0].getContext("2d"),n=x.width(),z=x.height(),v=z/2;p.height=z;p.width=n;var s=n/2,r=z/2;var A=function(C){return C*(Math.PI/180)},w=function(D,C){B.beginPath();B.moveTo(s,r);B.lineTo(s,0);B.arc(s,r,C,A(-90),A(-90+D),false);B.closePath();B.fill()};B.clearRect(0,0,n,z);B.fillStyle=y;w(360,v);if(m.value!=0){B.fillStyle=t;w(360*(Math.abs(m.value)/m.max),v)}B.fillStyle="#fff";w(360,v-m.width);q.append(o);if(m.list){var u="<ul>";c.each(m.list,function(){var C="";if(!h.isNumber(this.val)&&h.isNumber(this.percent)){this.val=this.percent;this.percent=b;m.valueformat="%"}if(this.val>0){C="pos"}else{if(this.val<0){C="neg"}else{C="neutr"}}u+="<li"+(C?" class="+C:"")+">";u+="<span class=title>"+this.title+"</span>";u+="<span class=value>"+(this.val>0?"+":"")+k.format(this.val,this.format||m.valueformat)+"</span>";if(this.percent){u+="<span class=percent>"+k.formatPosNeg(this.percent)+"%</span>"}u+="</li>"});u+="</ul>";q.append(u)}},uptime:function(m){var o=c.extend({},k.options.uptime,m.data());if(o.servers&&!c.isArray(o.servers)){o.servers=c.parseJSON(o.servers)}var p="<div class=overview>";c.each(o.servers,function(){p+="<div class=server>";p+='<div class="status '+(this.online?"online":"offline")+'">'+(this.online?o.lang.online:o.lang.offline)+"</div>";p+="<div class=name>"+this.name+"</div>";p+="</div>"});p+="</div>";m.insert(p);var n="<div class=left>";n+="<div class=title>"+o.lang[o.left]+"</div>";c.each(o.servers,function(){n+="<div class=entry>"+(this[o.left]||"&nbsp;")+"</div>"});n+="</div>";var q="<div class=right>";q+="<div class=title>"+o.lang[o.right]+"</div>";c.each(o.servers,function(){(q+="<div class=entry>"+(this[o.right]||"&nbsp;")+"</div>")});q+="</div>";m.insert("<div class=info>"+n+q+"</div>")},list:function(n){var p=c.extend({},k.options.list,n.data());if(!c.isArray(p.list)){p.list=c.parseJSON(p.list)}var m={up:"green",down:"red"};var o="<ul>";c.each(p.list,function(){var q="";if(this.type){q+=this.type;q+=" "+(this.color||m[this.type])}if(this.link){q+=" link"}var r='<li class="'+q+'">';this.link&&(r+='<a href="'+this.link+'">');r+="<div class=value>"+k.format(this.val,this.format||"")+"</div>";r+="<div class=title>"+this.title+"</div>";this.link&&(r+="</a>");r+="</li>";o+=r});o+="</ul>";n.insert(o);n.find(".value").equalWidth()},hlist:function(m){var o=c.extend({},k.options.hlist,m.data());if(!c.isArray(o.list)){o.list=c.parseJSON(o.list)}var n="<ul>";c.each(o.list,function(){var q="";if(this.color){q+=' class="'+this.color+'"'}var r="<li"+(q||"")+">";r+="<div class=value>"+k.format(this.val,this.format||"")+"</div>";r+="<div class=title>"+this.title+"</div>";r+="</li>";n+=r});n+="</ul>";m.insert(n);var p=m.find("li");if(o.flexiwidth){m.parent().addClass("flexiwidth");p.css("width",1/p.length*100+"%")}else{p.equalWidth()}},initialized:false},c.fn[d]);function j(){}c.extend(j,{privates:h.chain(k).keys().reject(h.bind(h.contains,h,l)),get:function(m){if(!h.contains(l,m)){return k[m]}},set:function(n,m){if(!h.contains(l,n)){k[n]=m}}});return j}})(jQuery,_,this,document);(function(c,h,e,f,b){var d="dualselect",g=".mango_"+d;var a=[];c.fn[d]=c.extend(function(m,l){var k=this,j=arguments;c(this).each(function(){var q,n=c(this);if(q=a.filter(function(t){return t.el[0]==n[0]})[0]){q=q.inst}else{a.push({el:n,inst:q=i()})}if(typeof m==="object"){l=m;m=b}m=m||"init";m!="init"&&!q.initialized&&c.error("$.fn."+d+" was not initialzed. Please call $.fn."+d+"(options) first.");if(c.isFunction(q.get(m))){var p;if(j[0]==l){p=c.makeArray(j)}else{if(j.length>1){p=Array.prototype.slice.call(j,1)}else{p=[l]}}var o=q.get(m).apply(n,p);if(!h.isUndefined(o)){k=o}}else{if(q.get(m)){var s=arguments[0],r=arguments[1];if(!r){k=q.get(s)}else{q.set(s,r)}}else{c.error("Method or property "+m+" does not exist on jQuery.fn."+d)}}});return k},{defaults:{buttonClass:"flat",size:"medium",sortBy:"name",lang:{filterPlaceholder:"جستجو کنید..."}}});function i(){var l={},k=["init","initialized","destroy"];c.extend(l,{init:function(n){var o=l.$element=c(this);l.options=c.extend(true,{},l.defaults,n,o.data());l.events={change:l.reflect};for(var m in l.events){o.on(m+g,l.events[m])}l.buildHtml();l.prepareHtml();l.initialized=true},buildHtml:function(){var p=c("<div class=dualselect>").insertAfter(l.$element);p.addClass(l.options.size);var q='<div class="left"><input type="text" class="ignore" placeholder="'+l.options.lang.filterPlaceholder+'" /><select multiple class="ignore"></select><div class="counter"></div></div>';q+='<div class="buttons"><a class="button add">&nbsp;&gt;&nbsp;</a><a class="button addall">&nbsp;&gt;&gt;&nbsp;</a><a class="button delall">&nbsp;&lt;&lt;&nbsp;</a><a class="button del">&nbsp;&lt;&nbsp;</a></div>';q+='<div class="right"><input type="text" class="ignore" placeholder="'+l.options.lang.filterPlaceholder+'" /><select multiple class="ignore"></select><div class="counter"></div></div>';p.insert(q);l.$wrapper=p;var o=p.find(".left");l.$leftFilter=o.find("input");l.$left=o.find("select");var m=p.find(".right");l.$rightFilter=m.find("input");l.$right=m.find("select");var n=p.find(".buttons");l.buttons={"$add":n.find(".add"),"$addall":n.find(".addall"),"$del":n.find(".del"),"$delall":n.find(".delall")};h.each(l.buttons,function(r){r.addClass(l.options.buttonClass)})},prepareHtml:function(){l.$originalState=l.$element.hide().clone();l.reflect();l.$element.parents("form").on("reset",function(){l.reset()});h.each(l.buttons,function(n,o){n.click(function(){l[o.replace("$","")].call(this);l.sort();l.reflectBack()})});l.$left.dblclick(l.add);l.$right.dblclick(l.del);var m={$left:l.$leftFilter,$right:l.$rightFilter};h.each(m,function(o,n){o.on("keyup"+g,function(){l.filter(this.value.toLowerCase(),l[n])})});l.sort()},reflect:function(){var m=l.$element.children(":selected").clone().map(function(){this.selected=false;return this}),n=l.$element.children(":not(:selected)").clone().map(function(){this.selected=false;return this});l.$left.empty().append(n);l.$right.empty().append(m)},reflectBack:function(){var m=h.map(l.$right.children(),function(n){return n.value});l.$element.children().each(function(){this.selected=h.contains(m,this.value)})},filter:function(n,m){m.children().show();m.children().filter(function(){return !(this.text.toLowerCase().search(n)>=0)}).hide()},add:function(){var m=l.$left.children(":selected").appendTo(l.$right)},addall:function(){l.$left.children().appendTo(l.$right);l.sort()},del:function(){var m=l.$right.children(":selected").appendTo(l.$left);l.sort()},delall:function(){l.$right.children().appendTo(l.$left);l.sort()},sort:function(){[l.$left,l.$right].forEach(function(m){var n=m.children().sort(function(p,o){var r=l.options.sortBy=="text"?p.text:c(p).attr("name"),q=l.options.sortBy=="text"?o.text:c(o).attr("name");return r>q?1:(r<q?-1:0)});m.empty().append(n)})},reset:function(){l.$element.children().replaceWith(l.$originalState.children());l.reflect();l.$right.children().map(function(){this.selected=false;return this})},destroy:function(){l.$wrapper.remove();l.$element.off(g).show();a=h.filter(a,function(m){return m.el[0]!=l.$element[0]})},initialized:false},c.fn[d]);function j(){}c.extend(j,{publics:h.chain(l).keys().filter(h.bind(h.contains,h,k)),get:function(m){if(h.contains(k,m)){return l[m]}},set:function(n,m){if(h.contains(k,n)){l[n]=m}}});return j}})(jQuery,_,this,document);