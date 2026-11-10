<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">

    function edit() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.restriction.profile')); ?>",
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
                    <h2>محدودیت های امکانات پروفایل</h2>
                </div>
                <?php $useroptions = json_decode($options['useroptions'], true); ?>
                <div class="content tabbed">

 <div class="row">
                        <label><strong>محدودیت ارسال پست:</strong></label>
                        <div>
                           <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="send_post[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_post'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_post', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_post',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
					 <div class="row">
                        <label><strong>ارسال پیام آفلاین در پروفایل:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="ppmoff[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['ppmoff'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('ppmoff', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('ppmoff',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ویرایش پروفایل:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="profile[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['profile'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('profile', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('profile',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
            
    <div class="row">
                        <label><strong>مشاهده پروفایل:</strong></label>
                        <div>
                        <?php
                        foreach($usertype as $type){
                        ?>
                        <input type="checkbox" name="viewprofile[]" value="<?php echo($type['id']); ?>" <?php if(in_array($type['id'], (array) $useroptions['viewprofile']))echo('checked'); ?> /> <?php echo($type['title']); ?>
                        <?php
                        }
                        ?>
                                  <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('viewprofile', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('viewprofile',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال مطلب در پروفایل:</strong><small></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="send_post_inprofile[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_post_inprofile'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_post_inprofile', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_post_inprofile',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
                    <div class="row">
                        <label><strong>ارسال نظر در پروفایل:</strong><small></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="send_comment_inprofile[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['send_comment_inprofile'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('send_comment_inprofile', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('send_comment_inprofile',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
                    <div class="row">
                        <label><strong>لایک و دیسلایک در پروفایل:</strong><small></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="ld_inprofile[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['ld_inprofile'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('ld_inprofile', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('ld_inprofile',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
                    
                    <div class="row">
                        <label><strong>امکان تغییر نام در پروفایل :</strong><small></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="changenamepr[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['changenamepr'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('changenamepr', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('changenamepr',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>مدیریت بر اطلاعات پروفایل ها:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['admin'] == '0')
                                    continue;
                                ?>
                                <input type="checkbox" name="modprofile[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['modprofile'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('modprofile', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('modprofile',
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