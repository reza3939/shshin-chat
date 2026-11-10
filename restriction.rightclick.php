<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">

    function edit() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.restriction.rightclick')); ?>",
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
                    <h2>تنظیمات کلیک راست</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>در محیط چت روم:</strong></label>
                        <?php
                        $rightclick = $options['chat_rightclick'];
                        $rightclick = explode(',', $rightclick);
                        ?>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="chatallowclick[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], $rightclick)) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
  <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('chatallowclick', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('chatallowclick',
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