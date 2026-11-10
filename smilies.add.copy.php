<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function add(elem) {
        elem.innerHTML = 'این عملیات ممکن است طول بکشد';
        elem.disabled = true;
        var $form = $('#formcopysmily');
        var data = {
            'site': $('input[name=site]', $form).val()
        };
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.smilies.add.copy')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('invalidurl'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این آدرس تایید نمیشود'});
                        break;
                    case('cannotopen'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور توان دسترسی به این چت روم را ندارد'});
                        break;
                    case('noimage'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور توان پیدا کردن شکلک ها را ندارد'});
                        break;
                    case('permit'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'مدیر چت روم به سایرین اجازه کپی شکلک خود را نداده است'});
                        break;
                    default:
                        alert(data);
                        break;
                }
                elem.innerHTML = 'کپی کن';
                elem.disabled = false;
            }, error: function () {
                elem.innerHTML = 'کپی کن';
                elem.disabled = false;

            },
            timeout: 600000
        });
    }
</script>
<?php
if(isset($_POST['openlock'])){
if(md5($_POST['code_password'])==$options['security_password']){
$_SESSION['yaser']=$options['security_password'];
}
}
?>
<?php
if(($_SESSION['yaser'] ?? '')==$options['security_password']){
?>
<section id="content" class="container_12 clearfix" data-sort=true>
    <h1 class="grid_12 margin-top no-margin-top-phone">شکلک جدید</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formcopysmily">
                <div class="header">
                    <h2>کپی دست جمعی شکلک ها</h2>
                </div>
                <div class="content tabbed">
                    <p style="color: red;text-decoration: blink;text-align: center;">لطفا از این ابزار با رضایت چت روم مقصد استفاده نمایید</p>
                    <div class="row">
                        <label><strong>آدرس چت روم:</strong></label>
                        <div><input type="text" name="site" value="" class="required"/></div>
                    </div>
                </div>
            </form>                                             
            <center> <button class="button blue flat block" onclick="add(this);">کپی کن</button></center>
        </div>
    </div>
</section>
<?php
}else{
?>
<center>
<br>
<form action="" method="POST">
<div style="background-image:url('/theme/adminpanel/img/files.png');height: 300px;width: 300px;margin-top:80px;margin-right:180px;color:#fff;border-radius: 5px;"><br><br>
<br><br><br><br><br><br><br><br>
<input name="code_password" value="" type="text">
<button name="openlock" class="grey cancel">باز کن</button>
</div>
<p><b>رمز امنیتی را وارد کنید</b></p>
<p><b>این رمز از پنل اضطراری قابل تغییر است</b></p>
</form>
</center>
<?php } ?>
<?php include 'footer.php'; ?>