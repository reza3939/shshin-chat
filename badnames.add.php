<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function add() {
        var $form = $('#formaddword');
        var data = {
            'token': '<?php echo(session('changepw')); ?>',
            'word': $('input[name=word]', $form).val(),
            'replace': $('input[name=replace]', $form).val(),
            'canlogin': $('input[name=canlogin]', $form).prop('checked'),
            'autorename': $('input[name=autorename]', $form).prop('checked'),	
            'robo_tablighat': $('input[name=robo_tablighat]', $form).prop('checked')

        };
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.badnames.add')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('word'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک کلمه برای فیلتر وارد کنید'});
                        break;
                    case('replace'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک کلمه برای جایگزاری وارد کنید'});
                        break;
                    case('repeatword'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این کلمه قبلا وارد شده است'});
                        break;
                    default:
                        alert(data);
                        break;
                }
            }
        });
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
    <h1 class="grid_12 margin-top no-margin-top-phone">فیلتر جدید</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formaddword">
                <div class="header">
                    <h2>ساخت فیلتر جدید</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>نام کاربری زشت:</strong></label>
                        <div><input type="text" name="word" class="required" value=""/></div>
                   </div>
                   <div class="row">
                        <label><strong>کلمه جایگزین:</strong></label>
                        <div><input type="text" name="replace" class="required" value=""/></div>
                    </div> 
                    <div class="row">
                        <label><strong>امکان ورود:</strong></label>
                        <div>
                            <input type="checkbox" name="canlogin" value="1" checked />

                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر نام خودکار توسط ربات:</strong></label>
                        <div>
                            <input type="checkbox" name="autorename" value="1" checked />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>گزارش ورود توسط ربات:</strong></label>
                        <div>
                            <input type="checkbox" name="robo_tablighat" value="1" checked />
                        </div>
                    </div>
                </div>
            </form>
            <center> <button class="button blue flat block" onclick="add();">فیلتر کن</button></center>
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