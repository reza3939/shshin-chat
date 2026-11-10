<?php
include('header.php');
include('sidebar.php');
if (!isset($GLOBALS['thememanager'])) {
    $GLOBALS['thememanager'] = json_decode($options['thememanager'], true);
}
$thememanager = $GLOBALS['thememanager'];
?>
<style>
    .cpicker{
        display: inline-block;
    }
</style>
<script type="text/javascript">
    function progressHandlingFunction(e) {
        if (e.lengthComputable) {
            //$('progress').attr({value:e.loaded,max:e.total});
        }
    }
    function edit() {
        var formData = new FormData($('#form-1')[0]);
        $.ajax({
            url: '<?php echo(url('ajax/admin.theme')); ?>',
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
                        $.jGrowl('ذخیره شد', {header: 'موفقیت آمیز'});
                        break;
                    case('type'):
                        $.jGrowl('نوع فایل توسط سرور تائید نشد', {header: 'خطا'});
                        break;
                    case('security'):
                        $.jGrowl('سرور در فایل شما مورد امنیتی پیدا کرد و فایل شما از سرور حذف گردید.', {header: 'خطا'});
                        break;
                    case('repeatname'):
                        $.jGrowl('این نام ویژه قبلا ثبت شده', {header: 'خطا'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">ویرایش قالب</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box " id="form-1" method="post" onsubmit="return false;">
                <input type="hidden" name="part" value="chat" />
                <input type="hidden" name="subset" value="form-icons" />
                <div class="header">
                    <h2>ویرایش آیکون های کادر ارسال</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>آیکون ارسال:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-send'])); ?>"></span>
                            <input type="file" name="icon-send" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون شکلک ها:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-smilies'])); ?>"></span>
                            <input type="file" name="icon-smilies" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون رنگ فونت:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-fonts'])); ?>"></span>
                            <input type="file" name="icon-fonts" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون تنظیمات:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-settings'])); ?>"></span>
                            <input type="file" name="icon-settings" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون امکانات ویژه:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-vip'])); ?>"></span>
                            <input type="file" name="icon-vip" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون امتیازات:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-ranks'])); ?>"></span>
                            <input type="file" name="icon-ranks" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون بازی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-game'])); ?>"></span>
                            <input type="file" name="icon-game" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون پاک کن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-eraser'])); ?>"></span>
                            <input type="file" name="icon-eraser" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون پنل مدیریت:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-panel'])); ?>"></span>
                            <input type="file" name="icon-panel" />
                        </div>
                    </div>
  <div class="row">
                        <label><strong>آیکون پیام افلاین:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-offlinemsg'])); ?>"></span>
                            <input type="file" name="icon-offlinemsg" />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>آیکون خروج:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img style="width: 50x;width: 50px;" src="<?php echo(url($thememanager['chat']['form-icons']['icon-logout'])); ?>"></span>
                            <input type="file" name="icon-logout" />
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