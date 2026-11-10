<?php
$el4 = giu('el4');
switch($el4){
    case('single'):include(theme::file('avatars.add.single.php'));break;
    case('tuple'):include(theme::file('avatars.add.tuple.php'));break;

    default:
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
	<h1 class="grid_12 margin-top no-margin-top-phone">آواتار جدید</h1>
    <div class="grid_12">
        <div class="grid_12">
        <p style="text-align: center;">ما دو روش برای افزودن  آواتار برای شما محیا کرده ایم!:</p>
            <center>
                <a href="<?php echo(url('admin/avatars/add/single')); ?>"><button class="button blue flat block">افزودن تکی</button></a>
                <a href="<?php echo(url('admin/avatars/add/tuple')); ?>"><button class="button blue flat block">افزودن دسته جمعی</button></a>
            </center>
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
<?php } ?>
