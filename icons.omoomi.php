<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function progressHandlingFunction(e) {
        if (e.lengthComputable) {
        }
    }
    function edit() {
        var formData = new FormData($('#form-1')[0]);
        $.ajax({
            url: '<?php echo(url('ajax/admin.icons.omoomi')); ?>',
            type: 'POST',
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                }
                return myXhr;
            },
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('nofile'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'فایلی انتخاب نشده است'});
                        break;
                    case('security'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور در فایل شما مورد امنیتی پیدا کرد و فایل شما از سرور حذف گردید.'});
                        break;
                    case('repeatname'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این نام ویژه قبلا ثبت شده'});
                        break;
                    default:
                        alert(data);
                        break;
                }
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
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
    <h1 class="grid_12 margin-top no-margin-top-phone">ویرایش ایکون ها</h1>
    <p style="text-align: center;color:red;font-weight: bold;">چنانچه پس از تغییر آیکون ها تغییرات را مشاهده نکردید هیستوری مرورگر خود را پاک کنید</p>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box " id="form-1" method="post" onsubmit="return false;">
                <div class="header">
                    <h2>تنظیمات ویژه ایکون ها</h2>
                </div>
                <div class="content tabbed">
     <div class="row">
                        <label><strong>آیکن تیک هنگام ارسال پیام :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/tick.png')); ?>"></span>
                            <input type="file" name="tick" >
                        </div>
                    </div>
 <div class="row">
                        <label><strong>آیکن تیک هنگام عدم ارسال پیام :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/untick.png')); ?>"></span>
                            <input type="file" name="untick" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر جنسیت زن در عمومی :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_f.png')); ?>"></span>
                            <input type="file" name="ozan" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر ایکون گزارش پیام در عمومی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/report.png')); ?>"></span>
                            <input type="file" name="report" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر جنسیت مرد در عمومی :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_m.png')); ?>"></span>
                            <input type="file" name="omard">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر جنسیت نامشخص در عمومی :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_n.png')); ?>"></span>
                            <input type="file" name="ona" >
                        </div>
                    </div>
					<div class="row">
                        <label><strong>تغییر ایکون فوروارد پیام در عمومی :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/replypm.png')); ?>"></span>
                            <input type="file" name="replypm" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر عکس باکس داخلی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/bodd.jpg')); ?>"></span>
                            <input type="file" name="box3" >
                        </div>
                    </div>
                    <div class="row"> 
                        <p style="text-align: center;"><button class="button blue flat block" onclick="edit();">ویرایش</button></p>
                    </div>
                </div>
            </form>
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