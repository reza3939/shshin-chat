<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">

    function edit() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.restriction.mod')); ?>",
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

    function info_send_robo2private_admins() {
        $("#info_send_robo2private_admins").dialog('open');
    }
    $(document).ready(function () {
        $("#info_send_robo2private_admins").dialog({
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
<div style="display: none;" id="info_send_robo2private_admins" title="راهنمای تنظیمات این سیستم">
    <p>تیک هر کدام را بزنید ربات برای همان درجه گزارشات را ارسال خواهد کرد</p>
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
                    <h2>محدودیت های امکانات مدیریت</h2>
                </div>
                <?php $useroptions = json_decode($options['useroptions'], true); ?>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>نمایش تمام امکانات چوب دستی : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                    ?>
                                    <input type="checkbox" name="modsaccess[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modsaccess'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                    <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modsaccess', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modsaccess',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
					<div class="row">
                        <label><strong>ارسال گزارش ربات به خصوصی مدیران:</strong><small><a href="javascript:info_send_robo2private_admins();">[توضیحات]</a></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                    ?>
                                    <input type="checkbox" name="send_robo2private_admins[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_robo2private_admins'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                    <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_robo2private_admins', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_robo2private_admins',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
                    <div class="row">
                        <label><strong>مشاهده گزارش کاربران:</strong></label>
                        <div>
                            <?php
                           foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                    ?>
                                    <input type="checkbox" name="send_user2private_admins[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_user2private_admins'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                    <?php
                                }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_user2private_admins', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_user2private_admins',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
                    <div class="row">
                        <label><strong>مشاهد عملکرد مدیران و ناظران:</strong></label>
                        <div>
                            <?php
                           foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                    ?>
                                    <input type="checkbox" name="send_log2private_admins[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_log2private_admins'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                    <?php
                                }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_log2private_admins', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_log2private_admins',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>سیستم حذف کاربر در ایکون اخراج:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="deleteuser_premission[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['deleteuser_premission'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('deleteuser_premission', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('deleteuser_premission',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>افزودن و کسر امتیاز در ایکون اخراج:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="dendscore_premission[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['dendscore_premission'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('dendscore_premission', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('dendscore_premission',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>مخفی کردن کاربر در ایکون اخراج:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modhider[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modhider'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modhider', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modhider',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>نمایان کردن کاربر در ایکون اخراج:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modshower[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modshower'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modshower', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modshower',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>تغییر استاتوس کاربر در ایکون اخراج :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modchangeuserstatos[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modchangeuserstatos'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modchangeuserstatos', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modchangeuserstatos',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
		<div class="row">
                        <label><strong>حذف استاتوس کاربر در ایکون اخراج :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="chengestatosuserdel[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['chengestatosuserdel'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('chengestatosuserdel', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('chengestatosuserdel',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>خفه کردن کاربر در ایکون اخراج : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modsilentuser[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modsilentuser'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modsilentuser', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modsilentuser',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>تغییر نام کاربر در ایکون اخراج :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modrenameuser[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modrenameuser'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modrenameuser', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modrenameuser',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>ریسیت کردن پروفایل کاربر در ایکون اخراج :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modprofilereset[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modprofilereset'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modprofilereset', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modprofilereset',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>اخطار به کاربر در ایکون اخراج : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modswarning[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modswarning'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modswarning', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modswarning',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>امکان اجازه دادن به کاربر برای حرف زدن در عمومی  در ایکون اخراج : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modstalkuser[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modstalkuser'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modstalkuser', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modstalkuser',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>امکان رفرش کردن کاربر در ایکون اخراج : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modsrefresh[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modsrefresh'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modsrefresh', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modsrefresh',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
<div class="row">
                        <label><strong>امکان ریپورت کردن کاربر در ایکون اخراج : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modsreportuser[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modsreportuser'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modsreportuser', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modsreportuser',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>

		
<div class="row">
                        <label><strong>امکان آن ریپورت کردن کاربر در ایکون اخراج : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modsunreportuser[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modsunreportuser'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modsunreportuser', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modsunreportuser',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>امکان انتقال کاربر در ایکون اخراج : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modsmoveuser[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modsmoveuser'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modsmoveuser', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modsmoveuser',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>امکان اخراج کاربر در ایکون اخراج : </strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modsbann[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modsbann'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modsbann', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modsbann',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
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