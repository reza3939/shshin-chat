<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function add() {

        var $form = $('#formaddquest');
        var data = {
            'question': $('input[name=question]', $form).val(),
            'answer': $('textarea[name=answer]', $form).val()
        };
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.autoanswer.add')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'ذخیره شد', text: 'موفقیت آمیز'});
                        break;
                    case('question'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سوالی وارد کنید!'});
                        break;
                    case('repeatquest'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این متن دریافتی قبلا وارد شده'});
                        break;
                    case('answer'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا پاسخی وارد کنید'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">پاسخگوی خودکار</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formaddquest">
                <div class="header">
                    <h2>افزودن پاسخ خودکار</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>متن دریافتی:</strong></label>
                        <div> <input type="text" name="question" class="required" value=""/> </div>
                    </div>
                    <div class="row">
                        <label><strong>پاسخ:</strong><small>پاسخ هارا با  , از هم جدا کنید</small></label>
                        <div>
                            <textarea name="answer"></textarea>

                        </div>
                    </div>
                </div>

            </form>
            <center> <button class="button blue flat block" onclick="add();">افزودن</button></center>
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