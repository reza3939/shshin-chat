<?php
include('header.php');
include('sidebar.php');
$useroptions = json_decode($options['useroptions'], true);
?>
<script type="text/javascript">

    function edit() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.restriction.social')); ?>",
            data: $('#formeditsettings').serialize(),
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
    function info_allowonlinelist() {
        $("#info_allowonlinelist").dialog('open');
    }
    $(document).ready(function () {
        $("#info_allowonlinelist").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });

    });
    var formblock;
    var forminputs;

    function prepare() {
        formblock = document.getElementById('formeditsettings');
        forminputs = formblock.getElementsByTagName('input');
    }

    function select_all(name, value) {
        for (i = 0; i < forminputs.length; i++) {
            // regex here to check name attribute
            var regex = new RegExp(name, "i");
            if (regex.test(forminputs[i].getAttribute('name'))) {
                if (value == '1') {
                    forminputs[i].checked = true;
                } else {
                    forminputs[i].checked = false;
                }
            }
        }
    }

    if (window.addEventListener) {
        window.addEventListener("load", prepare, false);
    } else if (window.attachEvent) {
        window.attachEvent("onload", prepare)
    } else if (document.getElementById) {
        window.onload = prepare;
    }

</script>
<div style="display: none;" id="info_allowonlinelist" title="راهنمای تنظیمات این سیستم">
    <p>
        برای استفاده از این امکان میبایست لیست کناری چت روم را حتما روی نمایش پروفایل های بروز شده قرار دهید.	</p>
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
                    <h2>تنظیمات شبکه اجتماعی</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>عضویت فوری واسان :</strong> </label>
                        <div>بلی<input type="checkbox" name="staticreg" value="1" <?php if ($options['staticreg'] == 'true') echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong> فعال کردن شماره تلفن در ثبت نام:</strong> </label>
                        <div>بلی<input type="checkbox" name="sreg_phone" value="1" <?php if ($options['sreg_phone'] == 'true') echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong> فعال کردن ایمیل در ثبت نام:</strong> </label>
                        <div>بلی<input type="checkbox" name="sreg_email" value="1" <?php if ($options['sreg_email'] == 'true') echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>فعال کردن قسمت بخش اجتماعی : </strong> </label>
                        <div>بلی<input type="checkbox" name="socialitems" value="1" <?php if ($options['socialitems'] == 'true') echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>قسمت کناری چت روم :</strong></label>
                        <div>
                            <select name="sideitems" class="search required">
                                <?php
                                $sideitems = array(
                                    'postslist' => ' ( نمایش نظر و کامنت وپیام افلاین دریافتی )پروفایل  به روز شده دوستان',
                                    'onlinelist' => 'پیشفرض'
                                );
                                foreach ($sideitems as $key => $value) {
                                    ?>
                                    <option value="<?php echo($key); ?>" <?php if ($key == $options['sideitems']) echo('selected'); ?> ><?php echo($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تعداد پروفایل های بروز شده :</strong></label>
                        <div><input type="text"  name="main_numposts" value="<?php echo($options['main_numposts']); ?>" class="required" /></div>
                    </div>
                   
                    <div class="row">
                        <label><strong>دسترسی به لیست انلاین : </strong><small><a href="javascript:info_allowonlinelist();">[توضیحات]</a></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="allowonlinelist[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['allowonlinelist'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('allowonlinelist', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('allowonlinelist',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <center><medium style="color:red">پس از ویرایش ممکن است به طور طبیعی حدودا یک دقیقه اعمال تغییرات طول بکشد</medium><br><button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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