// ! Your application

function deleteletters(id, elem){
    $(elem).text('صبر کنید');
   $.ajax({
        type: "POST",
        url: '<?php echo(url('ajax/admin.letters.delete')); ?>',
        data:{letter:id},
        success: function(data) {
            switch(data){
                case('ok'):$(elem).parent().parent().parent().slideToggle($$.config.fxSpeed);break;
                case('nottoyou'):alert('مقصد این نامه شما نیستید');break;
                case('worngid'):alert('ورودئ اشتباه');break;
                default:alert(data);break;
            }
        },
        done:function(){
            $(elem).text('حذف');
        }
    });
}
function shortcut_newuser(elem){
    var btnText = $(elem).text();
    var username = $('#p1_username').val();
    if(username == '' || username == ' '){alert('لطفا یک نام کاربری وارد کنید');return false;}
    var password = $('#p1_password').val();
    if(password == '' || password == ' '){alert('لطفا یک کلمه عبور وارد کنید');return false;}
    $(elem).text('صبر کنید');
    $.ajax({
        type: "POST",
        url: '<?php echo(url('ajax/admin.users.add')); ?>',
        data:{username:username, password:password},
        success: function(data) {
            switch(data){
                case('ok'):$(elem).text(btnText);$('#p1_username').val('');$('#p1_password').val('');alert('ساخته شد');break;
                case('nullusername'):alert('لطفا یک نام کاربری وارد کنید');break;
                case('usernamerunning'):alert('این نام کاربری صاحب دیگری دارد');break;
                case('lenusername'):alert('تعداد کارکتر های نام کاربری غیر استاندارد است');break;
                case('lenname'):alert('تعداد کارکتر های نام غیر استاندارد است');break;
                case('nullpassword'):alert('لطفا رمزی وارد کنید');break;
                case('nopatrnemail'):alert('لطفا ایمیل صحیحی وارد کنید');break;
                default:alert(data);break;
            }
        },
        done:function(){
            $(elem).text(btnText);
        }
    });
    return false;
}
$(function(){
	var $cutteryHash = '';
	
	if(window.location.hash != ''){
		if(window.location.hash.substr(0, 2)=='#/'){
			loadpage(window.location.hash.substr(1));
		}
	}
	
	$(window).on('hashchange', function() {
		var $hash = window.location.hash;
		if($hash.substr(0, 2)=='#/')$hash = $hash.substr(1);
		if($hash == '')return false;
		loadpage($hash);
	});
	$(document).mousedown(function(e){
		if(e.which == '1'){
			if(e.target.nodeName == 'A'){
				var $href = $(e.target).attr('href');
				if($href.substr(0, 7) == 'http://'){
					$href = $href.replace('http://', '');
					if($href.substr(0, window.location.hostname.length) == window.location.hostname){
						$href = $href.replace(window.location.hostname, '');
						window.location.hash = $href;
						return false;
					}
				}else if($href.substr(0, 1) == '/'){
					window.location.hash = $href;
					return false;
				}
			}else if(e.target.nodeName == 'BUTTON'){
				var $Aelem = $(e.target).parent();
				if($Aelem[0].nodeName == 'A'){
					var $href = $Aelem.attr('href');
					if($href.substr(0, 7) == 'http://'){
						$href = $href.replace('http://', '');
						if($href.substr(0, window.location.hostname.length) == window.location.hostname){
							$href = $href.replace(window.location.hostname, '');
							window.location.hash = $href;
							return false;
						}
					}else if($href.substr(0, 1) == '/'){
						window.location.hash = $href;
						return false;
					}
				}
				
			}
		}
	});
	function loadpage($hash){
		if($cutteryHash == $hash)return false;
		$cutteryHash = $hash;
		$('#loading-overlay').fadeIn(250, function(){
			$('#loading').fadeIn(250, function(){
				$.ajax({
					type:'get',
					url:$hash,
					data:{ajaxload:'1'},
					success: function(data){
						$('#main').html(data);
						$$.loaded();
					},
					complete: function(){
						$('#loading').fadeOut(250, function(){
							$('#loading-overlay').fadeOut(250);
						});
					}
				});
			});
		});
	}
});
