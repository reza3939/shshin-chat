<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">

function edit(){
    $.ajax({
        type: "POST",
        url: "<?php echo(url('ajax/admin.settings.cmd')); ?>",
        data: $('#formeditsettings').serialize(),
        success: function(data){
            switch(data){
                case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
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
	<h1 class="grid_12 margin-top no-margin-top-phone">تنظیمات</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formeditsettings">
                <div class="header">
                    <h2>تنظیمات دستورات</h2>
                </div>
				<?php
				$cmd_options = json_decode($options['cmd_options'], true);
				?>
                <div class="content tabbed">
                  
                    <div class="row">
                        <label><strong>وضعیت آنلاین بودن:</strong><small></small></label>
                        <div>
							فعال بودن  : <input type="checkbox" value="1"  name="online[2]" <?php if($cmd_options['online'][2] == 'enable')echo('checked');?> />بلی
                            <div>
                             امتیاز لازم برای دستور   <input type="text" name="online[1]" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo $cmd_options['online'][1]; ?>" /> امتیاز بانکی
                            </div>
                            <div>
                                کم شدن امتیاز  : <input type="checkbox" value="1"  name="online[0]" <?php if($cmd_options['online'][0] == 'yes')echo('checked');?> />بلی
                            </div>

						</div>
                    </div>
                    <div class="row">
                        <label><strong>وضعیت جنسیت:</strong><small></small></label>
                        <div>
							فعال بودن  : <input type="checkbox" value="1"  name="sex[2]" <?php if($cmd_options['sex'][2] == 'enable')echo('checked');?> />بلی
                            <div>
                             امتیاز لازم برای دستور   <input type="text" name="sex[1]" value="<?php echo $cmd_options['sex'][1]; ?>" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  /> امتیاز بانکی
                            </div>
                            <div>
                                کم شدن امتیاز  : <input type="checkbox" value="1"  name="sex[0]" <?php if($cmd_options['sex'][0] == 'yes')echo('checked');?> />بلی
                            </div>

						</div>
                    </div>
                    <div class="row">
                        <label><strong>وضعیت فعال بودن:</strong><small></small></label>
                        <div>
							فعال بودن  : <input type="checkbox" value="1"  name="active[2]" <?php if($cmd_options['active'][2] == 'enable')echo('checked');?> />بلی
                            <div>
                             امتیاز لازم برای دستور   <input type="text" name="active[1]" value="<?php echo $cmd_options['active'][1]; ?>" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  /> امتیاز بانکی
                            </div>
                            <div>
                                کم شدن امتیاز  : <input type="checkbox" value="1"  name="active[0]" <?php if($cmd_options['active'][0] == 'yes')echo('checked');?> />بلی
                            </div>

						</div>
                    </div>
                    <div class="row">
                        <label><strong>وضعیت زمان انلاین بودن:</strong><small></small></label>
                        <div>
							فعال بودن  : <input type="checkbox" value="1"  name="onlinetime[2]" <?php if($cmd_options['onlinetime'][2] == 'enable')echo('checked');?> />بلی
                            <div>
                             امتیاز لازم برای دستور   <input type="text" name="onlinetime[1]" value="<?php echo $cmd_options['onlinetime'][1]; ?>" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  /> امتیاز بانکی
                            </div>
                            <div>
                                کم شدن امتیاز  : <input type="checkbox" value="1"  name="onlinetime[0]" <?php if($cmd_options['onlinetime'][0] == 'yes')echo('checked');?> />بلی
                            </div>

						</div>
                    </div>
                   
                    <div class="row">
                        <label><strong>وضعیت نمایش آی پی:</strong><small></small></label>
                        <div>
							فعال بودن  : <input type="checkbox" value="1"  name="myip[2]" <?php if($cmd_options['myip'][2] == 'enable')echo('checked');?> />بلی
                            <div>
                             امتیاز لازم برای دستور   <input type="text" name="myip[1]" value="<?php echo $cmd_options['myip'][1]; ?>" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  /> امتیاز بانکی
                            </div>
                            <div>
                                کم شدن امتیاز  : <input type="checkbox" value="1"  name="myip[0]" <?php if($cmd_options['myip'][0] == 'yes')echo('checked');?> />بلی
                            </div>

						</div>
                    </div>
                    <div class="row">
                        <label><strong>وضعیت نمایش نام کاربری:</strong><small></small></label>
                        <div>
							فعال بودن  : <input type="checkbox" value="1"  name="username[2]" <?php if($cmd_options['username'][2] == 'enable')echo('checked');?> />بلی
                            <div>
                             امتیاز لازم برای دستور   <input type="text" name="username[1]" value="<?php echo $cmd_options['username'][1]; ?>" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  /> امتیاز بانکی
                            </div>
                            <div>
                                کم شدن امتیاز  : <input type="checkbox" value="1"  name="username[0]" <?php if($cmd_options['username'][0] == 'yes')echo('checked');?> />بلی
                            </div>

						</div>
                    </div>
                    
                   
					
                </div>
               
            </form>
            <center> <button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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