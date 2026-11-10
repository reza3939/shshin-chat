<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function deleteads(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.ads.delete')); ?>',
            data: {ad: id},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'حذف گردید'});
                        $('#ads-' + id).slideUp(1000);
                        break;
                    default:
                        alert(data);
                        break;
                }
            }
        });
    }
function filemanager_password_checker() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.filemanager.checkpw')); ?>",
            data: {password: $("#filemanager_password").val()},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        window.location.reload();
                        break;
                    case('invalid'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'پسورد اشتباه است'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">تبلیغات</h1>

    <div class="grid_12">
        <p style="text-align: center;"><a href="<?php echo(url('admin/ads/add')); ?>"><button class="button grey block">افزودن  تبلیغ</button></a></p>
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/image-select.png')); ?>">
                    تبلیغات
                </h2>

            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>صفحه</th>
                            <th>عنوان</th>
                            <th>نوع تبلیغ</th>
                            <th>تاریخ درج</th>
                            <th>تاریخ انقضا</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = db::query("SELECT * FROM {prefix}ads");
                        while ($row = mysqli_fetch_array($query)) {
                            switch ($row['page']) {
                                case('chat'):$row['page'] = 'داخل چتروم';
                                    break;
                                case('login'):$row['page'] = 'بیرون چتروم';
                                    break;
                                case('banned'):$row['page'] = 'صفحه اخراج';
                                    break;
                                case('profile'):$row['page'] = 'پروفایل';
                                    break;
                            }
                            switch ($row['type']) {
                                case('popup'):$row['type'] = 'پاپ آپ';
                                    break;
                                case('newtab'):$row['type'] = 'نیونب';
                                    break;
                                case('banner'):$row['type'] = 'بنر ساده';
                                    break;
                                case('fixedbanner'):$row['type'] = 'بنرگوشه ای';
                                    break;
                            }
                            ?>
                            <tr id="ads-<?php echo($row['id']); ?>">
                                <td><?php echo($row['id']); ?></td>
                                <td><?php echo($row['page']); ?></td>
                                <td>
                                    <?php echo($row['title']); ?>
                                    <br>
                        <center><a href="javascript:deleteads('<?php echo($row['id']); ?>');"><span style="font-size: 10px;">[حذف]</span></a></center>
                        <center><a href="../../../admin/ads/edit/<?php echo $row['id']; ?>"><span style="font-size: 10px;">[ویرایش]</span></a></center>
                        </td>
                        <td><?php echo($row['type']); ?></td>
                        <td><?php echo(jdate::start('Y/m/d H:i', $row['createtime'])); ?></td>
                        <td><?php echo(jdate::start('Y/m/d H:i', $row['expiration'])); ?></td>
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