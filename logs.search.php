<?php
include('header.php');
include('sidebar.php');
$if = "1";
$ip = isset($_REQUEST['ip']) && !empty($_REQUEST['ip']) ? safe::string($_REQUEST['ip']) : '.';
if (isset($_REQUEST['type'])) {
    $type = safe::number($_REQUEST['type']);
    if (isset($_REQUEST['username']) && isset($_REQUEST['name']) && !empty($_REQUEST['username']) || !empty($_REQUEST['name'])) {
        $userid = db::get("users", "`id`", "`username`='" . safe::string($_REQUEST['username']) . "'");
        $userid2 = db::get("users", "`id`", "`name`='" . safe::string($_REQUEST['name']) . "'");
        $if1 = "(`user`='$userid[0]' OR `user`='$userid2[0]')";
    } else {
        $if1 = "1";
    }
    switch ($type) {
        case('1'):$if = "(`ip` REGEXP '$ip') AND (`type` = '1' or `type` = '2') AND $if1";
            break;
        case('3'):case('2'):$if = "(`type` = '3') AND (`ip` REGEXP '$ip') AND $if1";
            break;
        case('4'):$if = "(`type` = '4' or `type` = '5'  or  `type` = '6' or `type` = '7') AND (`ip` REGEXP '$ip') AND $if1";
            break;
        case('8'):$if = "(`type` = '8') AND (`ip` REGEXP '$ip') AND $if1";
            break;
        case('9'):$if = "(`type` = '9') AND (`ip` REGEXP '$ip') AND $if1";
            break;
        default:return;
            break;
    }
}
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
    <h1 class="grid_12 margin-top no-margin-top-phone">رصد خانه</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/balloons-box.png')); ?>">
                    نتیجه جستجو
                </h2>
            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th align="center">#</th>
                            <th align="center">آی پی</th>
                            <th align="center">تاریخ</th>
                            <th align="center">ساعت</th>
                            <th align="center">نام کاربری</th>
                            <th align="center">نام نمایشی</th>
                            <th align="center">شرح</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        $query = db::query("SELECT * FROM {prefix}logs where $if order by id desc");
                        while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr id="reuslt-<?= $row[0] ?>">
                                <td align="center"><?= $x ?></td>
                                <td align="center"><?= $row[1] ?></td>
                                <td align="center"><?= jdate::start('Y/m/d', $row['date']) ?></td>
                                <td align="center"><?= jdate::start('H:i:s', $row['date']) ?></td>
                                <td align="center"><?= Users::get('username', $row['user']) ?></td>
                                <td align="center"><?= Users::get('name', $row['user']) ?></td>
                                <td align="center"><?= $row[5] ?></td>
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