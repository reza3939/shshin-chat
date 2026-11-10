<?php 
include 'header.php';
include 'sidebar.php';
$table = safe::string(giu('el4'));
$check = db::check(str_replace(db_prefix, '', $table));
switch (strtolower($check['Msg_text'])) {
	case 'ok':
		$satuts = 'سالم';
		$class = 'label-primary';
		break;
	default:
		$satuts = 'مشکل دار';
		$class = 'label-secondary';
		break;
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
	<h1 class="grid_12 margin-top no-margin-top-phone">پایگاه داده</h1>

	<div class="grid_12">
		<div class="box">
			<div class="header">
				<h2>
					<img class="icon" src="<?php 
echo theme::url('img/icons/packs/fugue/16x16/database-sql.png');
?>">
					پایگاه داده
				</h2>

			</div>
			<div class="content">
				<p><h3 style="font-family: b;">تعمییر جدول <?php 
echo $table;
?></h3></p>
				<p>وضعیت: <span class="label <?php 
echo $class;
?>"><?php 
echo $satuts;
?></span> </p>
				<p>پاسخ سرور: <code><?php 
echo $check['Msg_text'];
?></code></p>
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