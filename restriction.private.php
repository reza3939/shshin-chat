<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">

    function edit() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.restriction.private')); ?>",
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
                    <h2>محدودیت های جت خصوصی</h2>
                </div>
                <?php $useroptions = json_decode($options['useroptions'], true); ?>

                <div class="content tabbed">
				<div class="row">
                        <label><strong>امکان اجازه چت خصوصی :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="group_allowchat[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['group_allowchat'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('group_allowchat', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('group_allowchat',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال پیام در پنجره خصوصی:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="allowtypessender[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['allowtypessender'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('allowtypessender', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('allowtypessender',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تلنگر:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="buzz[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['buzz'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('buzz', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('buzz',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>پاک کن خصوصی:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="private_eraser[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['private_eraser'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('private_eraser', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('private_eraser',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
<!---
                    <div class="row">
                        <label><strong>چت صوتی تصویری:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="videochat[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['videochat'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('videochat', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('videochat',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
--->	
                    <div class="row">
                        <label><strong>ارسال فایل و عکس در خصوصی:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="sendedimages[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['sendedimages'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('sendedimages', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('sendedimages',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>بررسی وضعیت:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="private_status_check[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['private_status_check'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('private_status_check', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('private_status_check',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>مسدود سازی:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="private_blocker[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['private_blocker'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('private_blocker', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('private_blocker',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>گزارش:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="addreport[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['addreport'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('addreport', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('addreport',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال لینک در خصوصی :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="sendlink[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['sendlink'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('sendlink', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('sendlink',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    
                </div>
            </form>
            <center><medium style="color:red">پس از ویرایش ممکن است به طور طبیعی حدودا یک دقیقه اعمال تغییرات طول بکشد</medium><br> <button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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