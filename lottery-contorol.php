<?php
include('header.php');
include('sidebar.php');
$page = safe::number($el3) ? ((int) safe::number($el3)) : 1;
if ($page == 1) {
    $startpage = 0;
} else {
    $startpage = ($page - 1) * 100;
}
?>
<script type="text/javascript">
    function changepage(elem) {
        window.location.href = '<?php echo(url('admin/stats/\'+elem.value+\'')); ?>';
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
    <h1 class="grid_12 margin-top no-margin-top-phone">مدیریت نتایج قرعه کشی های انجام شده</h1>

    <div class="grid_12">
        <div class="box">
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
    <th>مدیریت</th>
    <th>#</th>
    <th>نام</th>
    <th>نام کاربری</th>
    <td>امتیاز</td>
    <th>درجه</th>
    <th>پروفایل</th>
    <th>وضعیت</th>
    <th>روز قرع کشی</th>
    <th>تاریخ قرعه کشی</th>
        <th>جایزه</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$query = db::query("SELECT * FROM {prefix}lottery ORDER BY ID DESC LIMIT 15");
while ($row = mysqli_fetch_array($query)){
?>

  <tr>

    <td><a style="color: rgb(243, 96, 96); font-size: 1.2em; font-weight: bold;" href="lotterydelete?id=<?php echo $row['id'].""; ?>">حذف</a></td>
    <td><?php echo $row['userid'].""; ?></td>
    <td><?php echo $row['name'].""; ?></td>
    <td><?php echo $row['username'].""; ?></td>
    <td><?php echo $row['score'].""; ?></td>
    <td><img src="<?php echo(theme::url($usertype[$row['type']]['icon'])); ?>" alt="<?php echo($usertype[$row['type']]['title']); ?>"></td>
    <td><a href="/profile/<?php echo($row['userid']); ?>"><img src="/theme/images/chat/chat.user_details.png" alt="پروفایل"></a></td>
    <td><img src="/theme/images/<?php echo($row['online']); ?>.png" alt="<?php echo($row['online']); ?>"></td>
    <td><?php echo $row['hafte'].""; ?></td>
    <td><?php echo $row['mah'].""; ?></td>
    <td><?php echo $row['jayezeh'].""; ?></td>
   </tr>
<?php } ?>

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
<?php include('footer.php'); ?>