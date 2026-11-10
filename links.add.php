<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function add() {
        var $form = $('#formaddlink');
        var data = {
            'token': '<?php echo(session('changepw')); ?>',
            'title': $('input[name=title]', $form).val(),
            'url': $('input[name=url]', $form).val(),
            'active': $('input[name=active]', $form).prop('checked'),
        };
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.links.add')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('repeat'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این لینک قبلا ثبت شده'});
                        break;
                    case('url'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک آدرس معتبر وارد کنید'});
                        break;
                    case('title'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا عنوانی مناسب وارد کنید'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">پیوند جدید</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formaddlink">
                <div class="header">
                    <h2>پیوند جدید</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>نام پیوند:</strong></label>
                        <div><input   class="required" autocomplete="off" type="text"  name="title" value=""/></div>
                    </div>
                    <div class="row">
                        <label><strong>آدرس پیوند:</strong></label>
                        <div><input style="direction: ltr;padding-left: 30px;"  class="required"  type="text"  name="url" value="http://www."/></div>
                    </div>
                    <div class="row">
                        <label><strong>فعال:</strong></label>
                        <div>
                            <input type="checkbox" name="active" checked value="1" />
                        </div>
                    </div>
                </div>
            </form>
            <center> <button class="button blue flat block" onclick="add();">ثبت</button></center>
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