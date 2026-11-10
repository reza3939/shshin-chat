<?php
include('header.php');
include('sidebar.php');
$useroptions = json_decode($options['useroptions'], true);
$rename_guest = json_decode($options['rename_guest'], true);

?>
<script type="text/javascript">
    function edit() {
        var serialize = $('#formeditsettings').serialize();
        var $options = $('.dualselect .right select option');
        var $ips = '';
        for (i = 0; i != $options.length; i++) {
            if ($ips != '')
                $ips += ',';
            $ips += $($options[i]).attr('name');
        }
        serialize += '&countries=' + $ips;
        console.log(serialize);
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.restriction.login')); ?>",
            data: serialize,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('title'):
                        $.msgGrowl({type: 'success', title: 'لطفا نامی برای اتاق انتخاب کنید', text: 'خطا'});
                        break;
                    default:
                        alert(data);
                        break;
                }
            }
        });
    }
    function info_anti_spammer() {
        $("#info_anti_spammer").dialog('open');
    }
    $(document).ready(function () {
        $("#info_anti_spammer").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });
	    function info_anti_spammerr() {
        $("#info_anti_spammerr").dialog('open');
    }
    $(document).ready(function () {
        $("#info_anti_spammerr").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });
</script>
<div style="display: none;" id="info_anti_spammer" title="راهنمای تنظیمات این سیستم">
     <p style="font-size:16px;" >این قسمت را اگر غیرفعال کنید ورود به چت روم شما بدون هیچ محدودیتی برای مزاحمان خواهد بود<br>توصیه می شود فقط مواقعی که مطمعنید هیچ حمله رباتی به چت روم شما صورت نخواهد گرفت این قسمت را غیرفعال کنید <br>زیرا این مورد محدودیت زیادی ایجاد میکند و در صورت فعال بودن کپچا نیاز به فعال بودن این قسمت نیست</p>
</div>
<div style="display: none;" id="info_anti_spammerr" title="راهنمای تنظیمات این سیستم">
    <p style="font-size:16px;" >توصیه می شود همیشه فعال باشد . این مورد بطور پیش فرض فعال نمی شود <br>فقط موقعی که فردی ربات تشخیص داده شود با یک تصویر امنیتی باید اعلام کند که ربات نیست و کد صحیح را وارد کند</p>
</div>
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
    <h1 class="grid_12 margin-top no-margin-top-phone">تنظیمات</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formeditsettings">
                <input type="hidden" name="token" value="<?php echo(session('changepw')); ?>" />
                <div class="header">
                    <h2>تنظیمات ورود</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>امکان ورود:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="allowlogin[]"<?php if ($type['admin'] != '1') { ?> value="<?php echo($type['id']); ?>" <?php
                                    if ($type['canlogin'] == 1)
                                        echo('checked');
                                }else {
                                    ?> disabled="disabled" checked<?php } ?> /> <?php echo($type['title']); ?>
                                       <?php
                                   }
                                   ?>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ورود مخفی: </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="hiddenlogin[]"  value="<?php echo($type['id']); ?>" <?php if ($type['loginhidden'] == 1) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                      <label><strong>فعال بودن تصویر امنیتی قالب بیرون : </strong><large><a href="javascript:info_anti_spammerr();">[توضیحات مهم]</a></large></label>
                        <div>
                            <input type="checkbox" name="captcha_login" value="1" <?php if ($options['captcha_login'] == 'true') echo('checked'); ?>/>
                        </div>
                    </div> 
                    <div class="row">
                        <label><strong>جلوگیری از ورود ربات : </strong><large><a href="javascript:info_anti_spammer();">[توضیحات]</a></large></label>
                        <div>
                            <input type="checkbox" name="anti_spammer" value="1" <?php if ($options['anti_spammer'] == 'true') echo('checked'); ?>/>
                        </div>
                    </div> 
                    <div class="row">
                        <label><strong>جلوگیری از ورود کاربران با اسامی شکلک دار: </strong><small>مانند : ◕‿◕ ☹ϟ ღ ツ ™ ¿ ¡ ❝ ❞ ✿ ღ • * </small></label>
                        <div>
                            <input type="checkbox" name="loginwithsheklak" value="1" <?php if ($options['loginwithsheklak'] == 'true') echo('checked'); ?>/>
                        </div>
                    </div> 
                   <div class="row">
                        <label><strong>تغییر نام خودکار کاربر مهمان</strong></label>
                        <div>
                            <input type="checkbox" value="1" id="rename_guest_active" name="rename_guest_active" <?php if($rename_guest['active'] == 'yes')echo('checked');?> />بلی
                            <div>
                                <input type="text" name="rename_guest_prefix" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo $rename_guest['prefix']; ?>" /> نام پیشوند
                            </div>
                        </div>
                    </div>

					<div class="row">
                        <label><strong>ورود در صورت آنلاین بودن مدیران یا ناظران:</strong><small></small></label>
                        <div>
                            <input type="checkbox" name="lwm" value="1" <?php if($options['lwm'] == 'true')echo('checked'); ?>/>
                        </div>
                    </div>
<div class="row">
                        <label><strong>تحریم آیپی کشورها:</strong><small><font color="red">سمت چپ لیست<br> تحریم شده ها</font></small></label>
                        <div>
                            <div id="customList">
                                <select multiple class="dualselects" data-size="small" id="countries">
                                    <?php
                                    $countrieslist = explode(",", $deallow_country);
                                    foreach (countries::$countries as $countries => $name) {
                                        ?>
                                        <option <?php if (in_array($countries, $countrieslist)) echo('selected'); ?> name="<?php echo($countries); ?>"><?php echo($name); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <center><medium style="color:red">پس از ویرایش ممکن است به طور طبیعی حدودا یک دقیقه اعمال تغییرات طول بکشد</medium><br><button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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