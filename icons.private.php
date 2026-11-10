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
            url: '<?php echo(url('ajax/admin.icons.private')); ?>',
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
                        <label><strong>تغییر ایکون ارسال پیام:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/Checked_small.png')); ?>"></span>
                            <input type="file" name="Checked_small" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون ارسال شکلک:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/Smiley_small.png')); ?>"></span>
                            <input type="file" name="Smiley_small" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون تلنگر:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/buzz.png')); ?>"></span>
                            <input type="file" name="buzz" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مسدود سازی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/blocker_small.png')); ?>"></span>
                            <input type="file" name="blocker_small" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون پاک کن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/eraser.png')); ?>"></span>
                            <input type="file" name="eraser" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون بررسی وضیت:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/status_check.png')); ?>"></span>
                            <input type="file" name="status_check" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر ایکون گزارش:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/gozaresh.png')); ?>"></span>
                            <input type="file" name="gozaresh" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون ارسال تصویر:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/upload_images_private.png')); ?>"></span>
                            <input type="file" name="upload_images_private">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خفه کردن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/silent.privat.png')); ?>"></span>
                            <input type="file" name="privat">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دعوت به کنفرانس:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.cfinviter.png')); ?>"></span>
                            <input type="file" name="cfinviter">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون درخواست دوستی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.friend_add.png')); ?>"></span>
                            <input type="file" name="friend_add">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون چت تصویری:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/videochat_small.png')); ?>"></span>
                            <input type="file" name="videochat_small">
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