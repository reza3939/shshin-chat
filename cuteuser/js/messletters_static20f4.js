$(document).ready(function() {	
	//settings array handler
	var settings = [];
	$('#options .optionToggle').click(function (){var id = $(this).attr('id');if($.inArray(id, settings) !== -1){settings = jQuery.grep(settings, function (value){return value != id;});$(this).removeClass('active');}else{settings.push(id);$(this).addClass('active');}starter($('#textin').val());});

	//starter
	function starter(textin){
		//settings
		if (settings.length > 0){
			//create array from input
			var input_text_array = textin.split('');
			/*reverse*/
			if($.inArray('checkReverse', settings) !== -1){input_text_array = input_text_array.reverse();}
			//charreplacement
			var tmp = [];
			for(var i in input_text_array){
				var char = input_text_array[i];
				if($.inArray('checkBreeze', settings) !== -1){if(i & 1){char = char.toUpperCase();}else{char = char.toLowerCase();}}
				if($.inArray('checkUpperline', settings) !== -1){char = '̅'+char;}
				if($.inArray('checkUnderline', settings) !== -1){char = '̲'+char;}
				if($.inArray('checkStrike', settings) !== -1){char = '̶'+char;}
				if($.inArray('checkWave', settings) !== -1){if(input_text_array[i] != ' '){char = '͠'+char;}}
				if($.inArray('checkSmoke', settings) !== -1){if (input_text_array[i] != ' '){char = '͕͗'+char+'͕͗';}}
				if($.inArray('checkBox', settings) !== -1){if (input_text_array[i] != ' '){char = '[̲̅'+char+'̲̅]';}}
				tmp.push(char);
			}
			var input_text_array = tmp;
			//and put back together as a string like nuttin happened
			textin = input_text_array.join('');
		}
		//and run main engine
		engineStart(textin);
	}
	$('#textin').bind('input',function(){$(this).unbind('keyup');starter($('#textin').val());}).bind('keyup',function(){starter($('#textin').val());});

	//reset fields
	$('.empty').click(function(event){event.preventDefault();$('#textin').val('').trigger('autosize.resize');settings = [];$('#options li').removeClass('active');engineStart('');$('#textin').focus();});
	
	//textin standard value
	$("#textin").focus(function(){var e=$(this).attr("data-value");if($(this).val()==e){$(this).val('').trigger('autosize.resize')}$(this).css({cursor:"text"})}).blur(function(){var e=$(this).attr("data-value");if($(this).val()==''){$(this).val(e).trigger('autosize.resize');$(this).css({cursor:'pointer'})}})

	//output li pre select
	$('#output pre').click(function(){selectText($(this).attr('id'));});

	//voting
	$(".vote span").click(function(){var e=$(this).attr("data-vote");var t=e.split("-");var n=t[0];var e=t[1];var r=$(this);$.post("/scripts/popular.php",{type:"messletters",id:n,vote:e},function(t){$(".msg").remove();$('<p class="msg">'+t+"Thanks!</p>").hide().appendTo(r.parent()).fadeIn(300);$(".msg").delay(1200).fadeOut(1200,function(){$(this).remove()});if(e==1){r.toggleClass("like liked");if(r.siblings("span").hasClass("disliked")){r.siblings("span").toggleClass("dislike disliked")}}if(e==0){r.toggleClass("dislike disliked");if(r.siblings("span").hasClass("liked")){r.siblings("span").toggleClass("like liked")}}})})
});