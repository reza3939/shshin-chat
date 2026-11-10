$(document).ready(function() {

	//show share only on desktop
	if($("#hMenuButton").is(":hidden")){(function(e,t,n){var r,i=e.getElementsByTagName(t)[0];if(e.getElementById(n))return;r=e.createElement(t);r.id=n;r.src="//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";i.parentNode.insertBefore(r,i)})(document,"script","facebook-jssdk");!function(e,t,n){var r,i=e.getElementsByTagName(t)[0],s=/^http:/.test(e.location)?"http":"https";if(!e.getElementById(n)){r=e.createElement(t);r.id=n;r.src=s+"://platform.twitter.com/widgets.js";i.parentNode.insertBefore(r,i)}}(document,"script","twitter-wjs");}else{$("#hShare").hide();};

	//set default menus state
	var menuState=0;var langState=0;

	//menus flyout
	$("#hMenuButton").click(function(){$("#languages").hide();langState=0;if($("#sidebarLeft").is(":hidden")){$("html, body").animate({scrollTop:0},"fast");$("#adTop").slideUp("slow");menuState=1}else{$("#adTop").slideDown("slow");menuState=0}$("#sidebarLeft").slideToggle("slow")})
	$("#hLangButton").click(function(){if($("#languages").is(":hidden")){$("html, body").animate({scrollTop:0},"fast");if($("#hMenuButton").is(":visible")){$("#adTop").slideUp("slow");$("#sidebarLeft").hide();menuState=0}langState=1}else{$("#adTop").slideDown("slow");langState=0}$("#languages").slideToggle("slow")})

	//hide menus on click outside menu elements
	$("body").click(function(e){if(e.target.id=="languages"||$(e.target).parents("#languages").length>0||e.target.id=="hLangButton"||$(e.target).parents("#hLangButton").length>0){return true}else{$("#languages").hide();langState=0}if(e.target.id=="sidebarLeft"||$(e.target).parents("#sidebarLeft").length>0||e.target.id=="hMenuButton"||$(e.target).parents("#hMenuButton").length>0){return true}else{if($("#hMenuButton").is(":visible")){$("#sidebarLeft").hide();menuState=0}}if(langState==0&&menuState==0){$("#adTop").show()}})

	//remember menu flyout setting on resize
	$(window).resize(function(){if($("#hMenuButton").is(":hidden")){$("#adTop").show();$("#sidebarLeft").css("display","table-cell")}else{if(menuState==1){$("#languages").hide();$("#adTop").hide();$("#sidebarLeft").css("display","block")}else{$("#sidebarLeft").css("display","none");if(langState==1){$("#adTop").hide();$("#languages").show()}}}})

	/*scrollmenu top link*/
	$('a[href=#top]').click(function(){$('html, body').animate({scrollTop:0}, 'slow');return false;});
    $(window).scroll(function(){if ($(this).scrollTop() > 200){$(".topbutton").fadeIn("fast");}else{$(".topbutton").fadeOut("fast");}});

	//activate autosize
	$('textarea#textin').autosize();
	
	//textin standard value and autosize
	$("#textin").focus(function(){var e=$(this).attr("data-value");if($(this).val()==e){$(this).val("");if($(this).is("textarea")){$(this).trigger("autosize.resize")}}$(this).css({cursor:"text"})}).blur(function(){var e=$(this).attr("data-value");if($(this).val()==""){$(this).val(e);if($(this).is("textarea")){$(this).trigger("autosize.resize")}$(this).css({cursor:"pointer"})}})

	//selector standard
	$(".selector .init").click(function(){
		if($(this).closest(".selector").find(".flyout").is(":visible")){
			$(".selector").find(".flyout").hide();
		}else{
			$(".selector").find(".flyout").hide();
			$(this).closest(".selector").find(".flyout").show();
		}
		return false;
	});
	$(document).click(function(event) { 
	    if(!$(event.target).closest(".selector").length) {
	        if($(".selector .flyout").is(":visible")) {
	            $(".selector .flyout").hide();
	        }
	    }        
	});
	$("ul.selector").on("click", "li:not(.init)", function() {
		$(".selector .flyout").hide();
		$('html, body').animate({scrollTop:0}, 'slow');
		if(!$(this).hasClass("selected")){
			$(this).closest(".selector").find(".selected").removeClass('selected');
		    $(this).addClass('selected');
		    $(this).closest(".selector").children('.init').html($(this).html());
			var selected = $(this).closest(".selector").children('.init').find("a").attr("data-cat");
			selectorChoice(selected);
		}
	    return false;
	});
	$(".selectorContainer").on("click", ".prev,.next", function() {
		$(".selector .flyout").hide();
		var $selected = $(this).siblings(".selector").find(".selected");
		if($(this).hasClass("prev")){
		    if( $selected.prev().length > 0 ) {
				$selected.removeClass("selected").prev().addClass("selected");
		    }else{var stop = true;}
		}
		else{
		    if( $selected.next().length > 0 ) {
				$selected.removeClass("selected").next().addClass("selected");
		    }else{var stop = true;}
		}
		if(typeof stop === "undefined"){
			var selected = $(this).siblings(".selector").find(".selected");
		    $(this).siblings(".selector").children('.init').html($(selected).html());
			var selected = $(this).siblings(".selector").children('.init').find("a").attr("data-cat");
			selectorChoice(selected);
		}
	    return false;
	});
	

});

//php's strtr for javascript (replace arrays)
function strtr(e,t,n){var r="",i=0,s=0,o=0,u=0,a=false,f="",l="",c="";var h=[];var p=[];var d="";var v=false;if(typeof t==="object"){for(r in t){if(t.hasOwnProperty(r)){h.push(r);p.push(t[r])}}t=h;n=p}o=e.length;u=t.length;f=typeof t==="string";l=typeof n==="string";for(i=0;i<o;i++){v=false;if(f){c=e.charAt(i);for(s=0;s<u;s++){if(c==t.charAt(s)){v=true;break}}}else{for(s=0;s<u;s++){if(e.substr(i,t[s].length)==t[s]){v=true;i=i+t[s].length-1;break}}}if(v){d+=l?n.charAt(s):n[s]}else{d+=e.charAt(i)}}return d}

//select text within non-input elements
//function selectText(e){var t=document,n=t.getElementById(e),r,i;if(t.body.createTextRange){r=t.body.createTextRange();r.moveToElementText(n);r.select()}else if(window.getSelection){i=window.getSelection();r=t.createRange();r.selectNodeContents(n);i.removeAllRanges();i.addRange(r)}}

//old version
function depricated_selectText(e) {
    var t = document,
        n = t.getElementById(e),
        r, i;
    if (t.body.createTextRange) {
        r = t.body.createTextRange();
        r.moveToElementText(n);
        r.select()
    } else if (window.getSelection) {
        i = window.getSelection();
        r = t.createRange();
        r.selectNodeContents(n);
        i.removeAllRanges();
        i.addRange(r)
    }
}

//new version
function selectText( containerid ) {

        var node = document.getElementById( containerid );

        if ( document.selection ) {
            var range = document.body.createTextRange();
            range.moveToElementText( node  );
            range.select();
        } else if ( window.getSelection ) {
            var range = document.createRange();
            range.selectNodeContents( node );
            window.getSelection().removeAllRanges();
            window.getSelection().addRange( range );
        }

		//alert("text selected (This message is here for testing purposes and will be gone in a few minutes time)");

    }




//strip accents
function stripAccents(str){
	var charMap = {
		ä:'a',á:'a',à:'a',â:'a',ã:'a',Ä:'A',Á:'A',À:'A',Â:'A',Ã:'A',
		ë:'e',é:'e',è:'e',ê:'e',Ë:'E',É:'E',È:'E',Ê:'E',
		ï:'i',í:'i',ì:'i',î:'i',Ï:'I',Í:'I',Ì:'I',Î:'I',
		ö:'o',ó:'o',ò:'o',ô:'o',õ:'o',Ö:'O',Ó:'O',Ò:'O',Ô:'O',Õ:'O',
		ü:'u',ú:'u',ù:'u',û:'u',Ü:'U',Ú:'U',Ù:'U',Û:'U',
		ß:'ss'
	};
	return strtr(str,charMap);
}
