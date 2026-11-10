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
    <h1 class="grid_12 margin-top no-margin-top-phone">قرعه کشی بین گروه های کاربری خاص</h1>
    
    <div class="grid_12">
    <?php if($options['typeload'] == '2'){ ?>
	<?php } ?>


               <form action="lotterytypetack" method="post" style="text-align: -moz-center;" >
<h3 style="text-align: right; margin-right: 10%;">جهت قرعه کشی بین گروه کاربری خاص ان را انتخاب کنید و سپس روی دکمه قرعه کشی کلیک کنید :</h3>
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
 <?php echo($row['title']); ?>:<input type="radio" name="s" checked="checked" value="<?php echo($row['id']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                   
                    <?php
                    }
                    mysqli_free_result($query);
                    ?> 
                             <div>  <input class="button blue flat block"  type="submit" value="قرعه کشی" /></div>
					</form>


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