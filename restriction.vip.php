<?php
include('header.php');
include('sidebar.php');
$useroptions = json_decode($options['useroptions'], true);
?>
<script type="text/javascript">

    function edit() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.restriction.vip')); ?>",
            data: $('#formeditsettings').serialize(),
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    default:
                        alert(data);
                        break;
                }
            }
        });
    }
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
                    <h2>محدودیت های امکانات ویژه</h2>
                </div>
                <div class="content tabbed">
                 
                 
                    <div class="row">
                        <label><strong>ارسال عکس یا آهنگ در عمومی</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="send_image[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_image'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_image', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_image',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال ویس (ضبط صدا)</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="voicesend[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) ($useroptions['voicesend'] ?? array()))) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('voicesend', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('voicesend',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال لینک:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="send_link[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_link'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_link', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_link',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
<!---
                    <div class="row">
                        <label><strong>سیستم خرید درجه:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="buy_type[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['buy_type'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('buy_type', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('buy_type',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
--->
                    <div class="row">
                        <label><strong>حذف و ازاد سازی نام کاربری:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="delete_uname[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['delete_uname'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('delete_uname', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('delete_uname',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
                    <div class="row">
                        <label><strong>سیستم خرید اتاق:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="buy_room[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['buy_room'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('buy_room', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('buy_room',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
                    <div class="row">
                        <label><strong>ارسال موزیک:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['guest'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="send_music[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_music'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_music', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_music',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال فیلم:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['guest'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="send_film[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_film'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_film', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_film',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>انتقال امتیاز :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['guest'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="sendscore[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['sendscore'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('sendscore', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('sendscore',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>مبدل امتیاز به امتیاز بانکی :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['guest'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="addbank[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['addbank'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('addbank', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('addbank',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>دسترسی به حذف فایل های ارسالی در خصوصی : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['guest'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="allow_removeimages[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['allow_removeimages'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('allow_removeimages', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('allow_removeimages',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>اپلود اواتار در امکانات وِیژه:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == 1)
                                    continue;
                                ?>
                                <input type="checkbox" name="uploadavatarvip[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['uploadavatarvip'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('uploadavatarvip', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('uploadavatarvip',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                </div>
            </form>
            <center> <medium style="color:red">پس از ویرایش ممکن است به طور طبیعی حدودا یک دقیقه اعمال تغییرات طول بکشد</medium><br><button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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