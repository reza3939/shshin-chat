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
            url: '<?php echo(url('ajax/admin.icons.mororgar')); ?>',
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
                        <label><strong>تغییر عکس ایکون کامپیوتر:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_pc.mini.png')); ?>"></span>
                            <input type="file" name="pc" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون تبلت:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_tablet.mini.png')); ?>"></span>
                            <input type="file" name="tablet" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون موبایل:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_phone.mini.png')); ?>"></span>
                            <input type="file" name="mobile" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مرورگر فایل فاکس:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/browser/firefox.png')); ?>"></span>
                            <input type="file" name="firefox" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مرورگر اینترنت اکسپلورر:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/browser/ie.png')); ?>"></span>
                            <input type="file" name="ie" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مرورگر سافاری:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/browser/safari.png')); ?>"></span>
                            <input type="file" name="safari" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر ایکون مرورگر گوگل کروم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/browser/chrome.png')); ?>"></span>
                            <input type="file" name="chrome" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون  مرورگر اپرا:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/browser/opera.png')); ?>"></span>
                            <input type="file" name="opera">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون  مرورگر ناشناس:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/browser/unknown.png')); ?>"></span>
                            <input type="file" name="unknown">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون   مرورگر نت اسکیپ:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/browser/netscape.png')); ?>"></span>
                            <input type="file" name="netscape">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون   مرورگر کامینو:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/browser/camino.png')); ?>"></span>
                            <input type="file" name="camino">
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