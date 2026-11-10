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