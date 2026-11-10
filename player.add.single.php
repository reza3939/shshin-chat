<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript" src="<?php echo(theme::url('js/ajaxfileupload.js')); ?>"></script>
<script type="text/javascript">
    function add() {
        var $form = $('#formaddmusic');
        var data = {
            'name': $('input[name=name]', $form).val(),
            'priority': $('input[name=priority]', $form).val(),
        };
        $.ajaxFileUpload({
            url: '<?php echo(url('ajax/admin.player.add.single')); ?>',
            secureuri: false,
            fileElementId: 'filemusic',
            data: data,
            dataType: 'text',
            success: function (data, status) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('type'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'نوغ فایل توسط سرور تایید نشد'});
                        break;
                    case('security'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور در فایل شما مورد امنیتی یافت کرد فایل شما حذف گردید'});
                        break;
                    default:
                        alert(data);
                        break;
                }
            },
            error: function (data, status, e)
            {
                alert(data);
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
    <h1 class="grid_12 margin-top no-margin-top-phone">موزیک جدید</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formaddmusic">
                <div class="header">
                    <h2>آپلود موزیک</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>نام:</strong></label>
                        <div><input type="text" name="name" class="required" value=""/></div>
                    </div>
                    <div class="row">
                        <label><strong>اولویت پخش:</strong></label>
                        <div><input type="text" name="priority" class="required" value="1" pattern="^\d{1,10}$"/></div>
                    </div>
                    <div class="row">
                        <label><strong>انتخاب فایل:</strong></label>
                        <div>
                            <input name="filemusic" id="filemusic" type="file" class="required" />
                        </div>
                    </div>
                </div>

            </form>
            <center> <button class="button blue flat block" onclick="add();">اضافه کردن</button></center>
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