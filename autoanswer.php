<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function deletequest(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.autoanswer.delete')); ?>',
            data: {quest: id},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'warning', title: 'موفقیت آمیز', text: 'حذف شد'});
                        break;
                    case('repeatuser'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'دسترسی این کاربر قبلا ساخته شده است'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">کاربران مجازی</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/users.png')); ?>">
                    کاربران مجازی
                </h2>

            </div>
            <div class="content">
                <p style="text-align: center;">
                    <a href="<?php echo(url('admin/autoanswer/add')); ?>"><button class="button grey block">پاسخ جدید</button></a>
                </p>
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>متن دریافتی</th>
                            <th>پاسخ ها</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = db::query("SELECT `id`,`question`,`answer` FROM {prefix}autoanswer");
                        while ($row = mysqli_fetch_array($query)) {
                            $row['answer'] = explode(',', $row['answer']);
                            ?>
                            <tr id="quest-<?php echo($row['id']); ?>">
                                <td><?php echo($row['id']); ?></td>
                                <td><?php echo($row['question']); ?><br/>
                                    <a href="<?php echo(url('admin/autoanswer/edit/' . $row['id'])); ?>">[ویرایش]</a>  <a href="javascript:deletequest('<?php echo($row['id']); ?>');">[حذف]</a>
                                </td>
                                <td><?php echo(implode("<br />", $row['answer'])); ?></td>
                            </tr>
                            <?php
                        }
                        mysqli_free_result($query);
                        ?>
                    </tbody>
                </table>
            </div>
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