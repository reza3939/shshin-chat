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
    <h1 class="grid_12 margin-top no-margin-top-phone">مدیران برتر</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/users.png')); ?>">
                    مشاهده مدیران برتر بر اساس امتیاز
                </h2>

            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربري</th>
                            <th>نام</th>
                            <th>جنسيت</th>
                            <th>سطح کاربري</th>
                            <th>آي پي</th>
                            <th>امتیاز</th>
                            <th>آخرين ورود</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admins = implode(',', Users::AdminsType());
                        $query = db::query("SELECT * FROM {prefix}users WHERE `type` IN($admins) ORDER BY `score` DESC");
                        $x = 1;
                        while ($row = mysqli_fetch_array($query)) {
                            switch ($row['gender']) {
                                case('0'):$gender = 'نامشخص';
                                    break;
                                case('1'):$gender = 'مرد';
                                    break;
                                case('2'):$gender = 'زن';
                                    break;
                                default:$gender = 'نا مشخص';
                                    break;
                            }
                            ?>
                            <tr id="user-<?php echo($row['id']); ?>">
                                <td><?php echo($x); ?></td>
                                <td><a href="../../../admin/users/edit/<?php echo $row[0] ?>"><?php echo($row['username']); ?></a></td>
                                <td><?php echo($row['name']); ?></td>
                                <td><?php echo($gender); ?></td>
                                <td><a href="<?php echo(url('admin/users/list/' . $row['type'])); ?>"><img src="<?php echo(theme::url($usertype[$row['type']]['icon'])); ?>"></a></td>
                                <td><?php echo($row['ip']); ?></td>
                                <td><?php echo($row['score']); ?></td>
                                <td><?php echo(jdate::start('l d F Y ساعت H:i', $row['lastlogin'])); ?></td>
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