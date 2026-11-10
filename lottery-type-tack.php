<?php include('header.php'); include('sidebar.php'); ?>

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
    <h1 class="grid_12 margin-top no-margin-top-phone">قرعه کشی بین گروه های کاربری خاص</h1>
    
    <div class="grid_12">
    <?php if($options['typeload'] == '2'){ ?>
	<?php } ?>


               <form action="" method="post" style="text-align: -moz-center;" >
<h3 style="text-align: right; margin-right: 10%;">جهت قرعه کشی بین گروه کاربری خاص آن را انتخاب کنید و سپس روی دکمه قرعه کشی کلیک کنید :</h3>
                    <?php
                    $query = db::query("SELECT * FROM {prefix}usertypes ORDER BY `sort` ASC");
					$x = 1;
                    while($row = mysqli_fetch_array($query)){
                        switch($row['admin']){
                            case('1'):$admin = 'مدیر کل';break;
                            case('2'):$admin = 'ناظر';break;
                            case('3'):$admin = 'ناظر ارشد';break;
                            default:$admin = 'خیر';break;
                        }
                        if($row['score'] == '0' and $row['admin'] != '0'){$row['score'] = 'تائید مدیریت';}if($row['score'] == '0'){$row['score'] = 'بدون محدودیت';}
                    ?>
					
&nbsp;&nbsp;&nbsp;&nbsp;
 <?php echo($row['title']); ?> : <input type="radio" name="s" checked="checked" value="<?php echo($row['id'] ?? ''); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    }
                    mysqli_free_result($query);
                    ?> 
                             <div>  <input class="button blue flat block"  type="submit" value="قرعه کشی" /></div>
					</form>
<?php
$row = array();
if (isset($_POST['s'])) {
    $x = (int) $_POST['s'];
    $query = db::query("SELECT * FROM ahyir_users WHERE onlinetime >= 1 AND type = $x ORDER BY rand()");
    $row = mysqli_fetch_array($query) ?: array();
}
?>
    <div class="grid_12">
        <div class="box">
               
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
    <th>ای دی</th>
    <th>نام</th>
    <th>نام کاربری</th>
    <th>ای پی</th>
    <td>امتیاز</td>
    <th>درجه</th>
    <th>پروفایل</th>
    <th>وضعیت</th>
    
  </tr>
  <tr>
    <td><?php echo($row['id'] ?? ''); ?></td>
    <td><?php echo($row['name'] ?? ''); ?></td>
    <td><?php echo($row['username'] ?? ''); ?></td>
    <td><?php echo($row['ip'] ?? ''); ?></td>
    <td><?php echo($row['score'] ?? ''); ?></td>
    <td><img src="<?php echo(theme::url($usertype[($row['type'] ?? '')]['icon'] ?? '')); ?>" alt="<?php echo($usertype[($row['type'] ?? '')]['title'] ?? ''); ?>"></td>
    <td><a href="/profile/<?php echo($row['id'] ?? ''); ?>"><img src="/theme/images/chat/chat.user_details.png" alt="پروفایل"></a></td>
    <td><img src="/theme/images/<?php echo($row['online'] ?? ''); ?>.png" alt="<?php echo($row['online'] ?? ''); ?>"></td>
   </tr>
</table>
	<?php

$day_number = jdate::start('j');
$month_number = jdate::start('n');
$year_number = jdate::start('y');
$day_name = jdate::start('l');

?>
</thead>
<form method="POST" action="tack" style="text-align: center; background: rgba(127, 255, 212, 0) none repeat scroll 0% 0%; border: 0px none; margin-top: 31px;">
	<input type="text" name="userid" value="<?php echo($row['id'] ?? ''); ?>" style="display: none;">
	<input type="text" name="name" value="<?php echo($row['name'] ?? ''); ?>" style="display: none;">
	<input type="text" name="username" value="<?php echo($row['username'] ?? ''); ?> "style="display: none;">
	<input type="text" name="score" value="<?php echo($row['score'] ?? ''); ?>" style="display: none;">
	<input type="text" name="type" value="<?php echo($row['type'] ?? ''); ?>" style="display: none;">
	<input type="text" name="online" value="<?php echo($row['online'] ?? ''); ?>" style="display: none;">
<h2>تاریخ قرعه کشی:
	<input type="text" name="hafte" value="<?php echo "$day_name"; ?>">
	<input style="direction: ltr;" type="text" name="mah" value="<?php echo "$year_number/$month_number/$day_number"; ?>">
<h2>جایزه قرعه کشی:<input type="text" name="jayezeh" value="" placeholder="جایزه مورد نظر خود را وارد کنید"></h2>
        <input class="button red flat block"  type="submit" value="انتشار نتیجه" />
</form>		
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