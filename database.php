<?php
include('header.php');
include('sidebar.php');
?>
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
    <h1 class="grid_12 margin-top no-margin-top-phone">پایگاه داده</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/database-sql.png')); ?>">
                    پایگاه داده
                </h2>

            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام جدول</th>
                            <th>سطرها</th>
                            <th>سایز</th>
                            <th>وضعيت</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        $sizes = db::size();
                        $query = db::query("show tables");
                        while ($row = mysqli_fetch_array($query)) {
                            $row['status'] = '';
                            $temp = '';
                            if (in_array($row[0], $blocktables)) {
                                $row['status'] .= 'قفل';
                                $temp = '0';
                            } else {
                                $row['status'] .= 'آزاد';
                                $temp = '1';
                            }
                            $row['status'] .= ' - ';
                            $check = mysqli_fetch_array(db::query("CHECK TABLE `$row[0]`"));
                            if (strtolower($check['Msg_text']) == 'ok') {
                                $row['status'] .= 'سالم';
                                $temp .= '1';
                            } else {
                                $row['status'] .= 'خراب';
                                $temp .= '0';
                            }
                            switch ($temp) {
                                default:$row['class'] = 'label-secondary';
                                    break;
                                case('11'):$row['class'] = 'label-primary';
                                    break;
                            }
                            ?>
                            <tr>
                                <td><?php echo($x); ?></td>
                                <td>
                                    <a href="<?php echo(url("admin/database/table/$row[0]")); ?>"><?php echo($row[0]); ?></a>
                                    <p>
                                        <a href="<?php echo(url("admin/database/check/$row[0]")); ?>">[بررسی کردن]</a>
                                        <a href="<?php echo(url("admin/database/repair/$row[0]")); ?>">[تعمیر کردن]</a>
                                        <a href="<?php echo(url("admin/database/optimize/$row[0]")); ?>">[بهینه کردن]</a>
                                    </p>
                                </td>					
                                <td><?php echo(mysqli_num_rows(db::query("SELECT * FROM $row[0]"))); ?></td>
                                <td><?php echo($sizes[$row[0]] . ' کیلوبایت'); ?></td>
                                <td><span class="label <?php echo($row['class']); ?>"><?php echo($row['status']); ?></span></td>
                            </tr>
                            <?php
                            $x++;
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