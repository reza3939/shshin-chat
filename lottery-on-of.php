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
    <h1 class="grid_12 margin-top no-margin-top-phone">قرعه کشی بین کاربران آنلاین و آفلاین</h1>

    <div class="grid_12">
        <div class="box">
                <div class="tabletools">
                </div>
<form action="lotteryon" method="post" style="text-align: -moz-center;" >
<h3 style="text-align: right; margin-right: 10%;">جهت قرعه کشی بین افراد انلاین ، انلاین را و  برای افلاین ، افلاین رو انتخاب کنید سپس روی قرعه کشی کلیک کنید:</h3>

            <p>انلاین ها  <input type="radio" name="on" checked="checked" value="1">
&nbsp;&nbsp;
افلاین ها  <input type="radio" name="on" value="0"></p>
                     
         

<br>
<input class="button blue flat block"  type="submit" value="قرعه کشی" />
</form>

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