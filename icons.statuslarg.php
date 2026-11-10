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
            url: '<?php echo(url('ajax/admin.icons.status.larg')); ?>',
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
                    <h2>تنظیمات ویژه ایکون ها وضعیت کاربران در عمومی</h2>
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
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_busy_larg.png')); ?>"></span>
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
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_fangel_larg.png')); ?>"></span>
                            <input type="file" name="status_fangel" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون سرباز روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_bt_larg.png')); ?>"></span>
                            <input type="file" name="status_bt" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خوش سخن و خوش رفتار روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_skull_larg.png')); ?>"></span>
                            <input type="file" name="status_skull" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر ایکون با جنبه:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_baj_larg.png')); ?>"></span>
                            <input type="file" name="status_baj" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون با شخصیت:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_personable_larg.png')); ?>"></span>
                            <input type="file" name="status_personable">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون روز تولدمه:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_birthday_larg.png')); ?>"></span>
                            <input type="file" name="status_birthday">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون کمک میخوام:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_help_larg.png')); ?>"></span>
                            <input type="file" name="status_help">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون زیر ابم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_za_larg.png')); ?>"></span>
                            <input type="file" name="status_za">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خوشکل روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_beauty_larg.png')); ?>"></span>
                            <input type="file" name="status_beauty">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون پلیس روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_ctcs_larg.png')); ?>"></span>
                            <input type="file" name="status_ctcs">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون کانتر چی روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_tcs_larg.png')); ?>"></span>
                            <input type="file" name="status_tcs">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون کانتر باز:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_csgamer_larg.png')); ?>"></span>
                            <input type="file" name="status_csgamer">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون بی حالم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_nh_larg.png')); ?>"></span>
                            <input type="file" name="status_nh">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون در حال مخ زدن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_mokh_larg.png')); ?>"></span>
                            <input type="file" name="status_mokh">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون بچه پر رو:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_pr_larg.png')); ?>"></span>
                            <input type="file" name="status_pr">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون پولدار روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_money_larg.png')); ?>"></span>
                            <input type="file" name="status_money">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون لات روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_lat_larg.png')); ?>"></span>
                            <input type="file" name="status_lat">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دنبال پسر خوب برای اشنایی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_shm_larg.png')); ?>"></span>
                            <input type="file" name="status_shm">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دنبال دختر خوب برای اشنایی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_zm_larg.png')); ?>"></span>
                            <input type="file" name="status_zm">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون متاهل هستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_fm_larg.png')); ?>"></span>
                            <input type="file" name="status_fm">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون جذاب هستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_cool_larg.png')); ?>"></span>
                            <input type="file" name="status_cool">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خجالتی هستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_shy_larg.png')); ?>"></span>
                            <input type="file" name="status_shy">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم کار میکنم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_working_larg.png')); ?>"></span>
                            <input type="file" name="status_working">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون سرما خوردم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_sick_larg.png')); ?>"></span>
                            <input type="file" name="status_sick">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون فقط خدا:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_angel_larg.png')); ?>"></span>
                            <input type="file" name="status_angel">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم اشپزی میکنم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_cooking_larg.png')); ?>"></span>
                            <input type="file" name="status_cooking">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم غذا میخورم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_eating_larg.png')); ?>"></span>
                            <input type="file" name="status_eating">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دلشکسته:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_broken_larg.png')); ?>"></span>
                            <input type="file" name="status_broken">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم اهنگ گوش میدم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_music_larg.png')); ?>"></span>
                            <input type="file" name="status_music">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون شیطونم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_chell_larg.png')); ?>"></span>
                            <input type="file" name="status_chell">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم گریه میکنم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_cry_larg.png')); ?>"></span>
                            <input type="file" name="status_cry">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون ناراحتم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_sad_larg.png')); ?>"></span>
                            <input type="file" name="status_sad">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون همه چی آرومه من چقد خوشحالم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_happy_larg.png')); ?>"></span>
                            <input type="file" name="status_happy">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون عصبانی هستم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_angry_larg.png')); ?>"></span>
                            <input type="file" name="status_angry">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون خوابم میاد:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_sleep_larg.png')); ?>"></span>
                            <input type="file" name="status_sleep">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مرد انکبوتی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_spider_larg.png')); ?>"></span>
                            <input type="file" name="status_spider">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دزد دریایی روم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_rammal_larg.png')); ?>"></span>
                            <input type="file" name="status_rammal">
                        </div>
                    </div><div class="row">
                        <label><strong>تغییر آیکون عزراییل:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_ezraeil_larg.png')); ?>"></span>
                            <input type="file" name="status_ezraeil">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دارم بچه داری میکنم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_baby_larg.png')); ?>"></span>
                            <input type="file" name="status_baby">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون دوست داشتنی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_lovely_larg.png')); ?>"></span>
                            <input type="file" name="status_lovely">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون جدی و مغرور:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_jm_larg.png')); ?>"></span>
                            <input type="file" name="status_jm">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون بی جنبه:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_bij_larg.png')); ?>"></span>
                            <input type="file" name="status_bij">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون در حال بازی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_controller_larg.png')); ?>"></span>
                            <input type="file" name="status_controller">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون تلفن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_telephone_larg.png')); ?>"></span>
                            <input type="file" name="status_telephone">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون عاشقم:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_heart_larg.png')); ?>"></span>
                            <input type="file" name="status_heart">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون مایل به چت:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_smil_larg.png')); ?>"></span>
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