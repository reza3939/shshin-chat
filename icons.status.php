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
            url: '<?php echo(url('ajax/admin.icons.status')); ?>',
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
                    <h2>تنظیمات ویژه ایکون وضعیت در لیست انلاین</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>تغییر ایکون انلاین:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_online.png')); ?>"></span>
                            <input type="file" name="status_online" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مشغول:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_busy.png')); ?>"></span>
                            <input type="file" name="status_busy" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون نیستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_away.png')); ?>"></span>
                            <input type="file" name="status_away" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون فرشته روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_fangel.png')); ?>"></span>
                            <input type="file" name="status_fangel" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون سرباز روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_bt.png')); ?>"></span>
                            <input type="file" name="status_bt" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خوش سخن و خوش رفتار روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_skull.png')); ?>"></span>
                            <input type="file" name="status_skull" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر ایکون با جنبه:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_baj.png')); ?>"></span>
                            <input type="file" name="status_baj" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون با شخصیت:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_personable.png')); ?>"></span>
                            <input type="file" name="status_personable">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون روز تولدمه:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_birthday.png')); ?>"></span>
                            <input type="file" name="status_birthday">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون کمک میخوام:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_help.png')); ?>"></span>
                            <input type="file" name="status_help">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون زیر ابم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_za.png')); ?>"></span>
                            <input type="file" name="status_za">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خوشکل روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_beauty.png')); ?>"></span>
                            <input type="file" name="status_beauty">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون پلیس روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_ctcs.png')); ?>"></span>
                            <input type="file" name="status_ctcs">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون کانتر چی روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_tcs.png')); ?>"></span>
                            <input type="file" name="status_tcs">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون کانتر باز:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_csgamer.png')); ?>"></span>
                            <input type="file" name="status_csgamer">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون بی حالم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_nh.png')); ?>"></span>
                            <input type="file" name="status_nh">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون در حال مخ زدن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_mokh.png')); ?>"></span>
                            <input type="file" name="status_mokh">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون بچه پر رو:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_pr.png')); ?>"></span>
                            <input type="file" name="status_pr">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون پولدار روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_money.png')); ?>"></span>
                            <input type="file" name="status_money">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون لات روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_lat.png')); ?>"></span>
                            <input type="file" name="status_lat">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دنبال پسر خوب برای اشنایی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_shm.png')); ?>"></span>
                            <input type="file" name="status_shm">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دنبال دختر خوب برای اشنایی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_zm.png')); ?>"></span>
                            <input type="file" name="status_zm">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون متاهل هستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_fm.png')); ?>"></span>
                            <input type="file" name="status_fm">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون جذاب هستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_cool.png')); ?>"></span>
                            <input type="file" name="status_cool">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خجالتی هستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_shy.png')); ?>"></span>
                            <input type="file" name="status_shy">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم کار میکنم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_working.png')); ?>"></span>
                            <input type="file" name="status_working">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون سرما خوردم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_sick.png')); ?>"></span>
                            <input type="file" name="status_sick">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون فقط خدا:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_angel.png')); ?>"></span>
                            <input type="file" name="status_angel">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم اشپزی میکنم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_cooking.png')); ?>"></span>
                            <input type="file" name="status_cooking">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم غذا میخورم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_eating.png')); ?>"></span>
                            <input type="file" name="status_eating">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دلشکسته:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_broken.png')); ?>"></span>
                            <input type="file" name="status_broken">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم اهنگ گوش میدم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_music.png')); ?>"></span>
                            <input type="file" name="status_music">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون شیطونم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_chell.png')); ?>"></span>
                            <input type="file" name="status_chell">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم گریه میکنم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_cry.png')); ?>"></span>
                            <input type="file" name="status_cry">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون ناراحتم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_sad.png')); ?>"></span>
                            <input type="file" name="status_sad">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون همه چی آرومه من چقد خوشحالم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_happy.png')); ?>"></span>
                            <input type="file" name="status_happy">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون عصبانی هستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_angry.png')); ?>"></span>
                            <input type="file" name="status_angry">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خوابم میاد:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_sleep.png')); ?>"></span>
                            <input type="file" name="status_sleep">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مرد انکبوتی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_spider.png')); ?>"></span>
                            <input type="file" name="status_spider">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دزد دریایی روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_rammal.png')); ?>"></span>
                            <input type="file" name="status_rammal">
                        </div>
                    </div><div class="row">
                        <label><strong>تغییر آیکون عزراییل:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_ezraeil.png')); ?>"></span>
                            <input type="file" name="status_ezraeil">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم بچه داری میکنم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_baby.png')); ?>"></span>
                            <input type="file" name="status_baby">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دوست داشتنی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_lovely.png')); ?>"></span>
                            <input type="file" name="status_lovely">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون جدی و مغرور:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_jm.png')); ?>"></span>
                            <input type="file" name="status_jm">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون بی جنبه:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_bij.png')); ?>"></span>
                            <input type="file" name="status_bij">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون در حال بازی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_controller.png')); ?>"></span>
                            <input type="file" name="status_controller">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون تلفن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_telephone.png')); ?>"></span>
                            <input type="file" name="status_telephone">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون عاشقم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_heart.png')); ?>"></span>
                            <input type="file" name="status_heart">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مایل به چت:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_smil.png')); ?>"></span>
                            <input type="file" name="status_smil">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مخفی شدن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_invisible.png')); ?>"></span>
                            <input type="file" name="status_invisible">
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