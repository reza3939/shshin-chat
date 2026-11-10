<?php
include('header.php');
include('sidebar.php');

?>
<script type="text/javascript">

function edit(){
    $.ajax({
        type: "POST",
        url: "<?php echo(url('ajax/admin.adsbuy')); ?>",
        data: $('#formeditsettings').serialize(),
        success: function(data){
            switch(data){
                case('ok'):$.jGrowl('ذخیره شد', { header: 'موفقیت آمیز' });break;
                default:alert(data);break;
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
                    <h2>قیمت تبلیغات </h2>
                </div>
                <?php $useroptions = json_decode($options['ads'], true); ?>
                <div class="content tabbed">
<div class="row">
                        <label><strong> آدرس صفحه تبلیغات :</strong></label>
                        <div style="font-size:14px;" ><a style="position: relative;top: 20px;" href="/advertise" target="_blank" >کلیک کنید</a></div>
                        <div style="font-size:13px; color:#F00;" >از این آدرس می توانید در لینکدونی جهت تبلیغات استفاده کنید </a></div>
                   
</div> 
<div class="row">
                        <label><strong>تعرفه تبلیغات فعال باشد:</strong></label>
                        <div><input type="checkbox" value="1" name="chat_advertise_enable" <?php if ($options['chat_advertise_enable'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
            <div class="row">
                        <label><strong>پاپ آپ:</strong><small>داخل چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="pupin" <?php if ($options['pupin'] == 'true') echo('checked'); ?> />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="1" value="<?php echo($options['1']) ?>" /> تومان
							</div>
						</div> 
                    </div>
					  <div class="row">
                        <label><strong>پاپ آپ:</strong><small>بیرون چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="pupout" <?php if ($options['pupout'] == 'true') echo('checked'); ?>  />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="2" value="<?php echo($options['2']); ?>" /> تومان
							</div>
						</div> 
                    </div>
					
					  <div class="row">
                        <label><strong>نیوتب:</strong><small>داخل چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="newin" <?php if ($options['newin'] == 'true') echo('checked'); ?> />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="3" value="<?php echo($options['3']) ?>" /> تومان
							</div>
						</div> 
                    </div>
					  <div class="row">
                        <label><strong>نیوتب:</strong><small>بیرون چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="newout" <?php if ($options['newout'] == 'true') echo('checked'); ?>  />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="4" value="<?php echo($options['4']); ?>" /> تومان
							</div>
						</div> 
                    </div>
					
					  <div class="row">
                        <label><strong>بنر ساده:</strong><small>داخل چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="banin" <?php if ($options['banin'] == 'true') echo('checked'); ?> />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="5" value="<?php echo($options['5']) ?>" /> تومان
							</div>
						</div> 
                    </div>
					  <div class="row">
                        <label><strong>بنر ساده:</strong><small>بیرون چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="banout" <?php if ($options['banout'] == 'true') echo('checked'); ?>  />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="10" value="<?php echo($options['10']); ?>" /> تومان
							</div>
						</div> 
                    </div>
					
					  <div class="row">
                        <label><strong>بنرگوشه ای:</strong><small>داخل چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="banclein" <?php if ($options['banclein'] == 'true') echo('checked'); ?> />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="7" value="<?php echo($options['7']) ?>" /> تومان
							</div>
						</div> 
                    </div>
					  <div class="row">
                        <label><strong> بنر کوشه ای:</strong><small>بیرون چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="bancleout" <?php if ($options['bancleout'] == 'true') echo('checked'); ?>  />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="8" value="<?php echo($options['8']); ?>" /> تومان
							</div>
						</div> 
                    </div>
					  <div class="row">
                        <label><strong>لینک دونی:</strong><small>داخل چت</small></label>
					
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="linkin" <?php if ($options['linkin'] == 'true') echo('checked'); ?> />بلي
						</div>
                        <div>
							<div>
						قیمت:
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="9" value="<?php echo($options['9']) ?>" /> تومان
							</div>
						</div> 
                    </div>

					  <div class="row">
                        <label><strong>صاحب حساب:</strong><small>نامی که روی کارت بانکی نوشته شده</small></label>
        
                       
						<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="lnamefname" <?php if ($options['lnamefname'] == 'true') echo('checked'); ?> />بلي
						</div>
							<div>
					
								<input type="text"  style="width:120px" name="lname_fname" value="<?php echo($options['lname_fname']) ?>" /> 
							</div>
						</div> 
                 
                  
						  <div class="row">
                        <label><strong>شماره کارت:</strong></label>
                        	<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="numbercart" <?php if ($options['numbercart'] == 'true') echo('checked'); ?> />بلي
						</div>
                        <div> <input type="text"  style="width:120px" name="number_cart" value="<?php echo($options['number_cart']) ?>"/></div>
						
                    </div>
						  <div class="row">
                        <label><strong>شماره حساب:</strong></label>
                          	<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="numberhesab" <?php if ($options['numberhesab'] == 'true') echo('checked'); ?> />بلي
						</div>
                        <div> <input type="text"  style="width:120px" name="number_hesab" value="<?php echo($options['number_hesab']) ?>"/></div>
						
                    </div>
					
						  <div class="row">
                        <label><strong>بانک:</strong></label>
                        	<div>
						فعال باشد:
							 <input type="checkbox" value="1" name="bank2" <?php if ($options['bank2'] == 'true') echo('checked'); ?> />بلي
						</div>
                        <div> <input type="text"  style="width:120px" name="bank" value="<?php echo($options['bank']) ?>"/></div>
						
                    </div>
                    	  <div class="row">
                        <label><strong>شماره تماس:</strong></label>
                      
                        <div> <input type="text"  style="width:120px" name="phone" value="<?php echo($options['phone']) ?>"/> </div>
						
                    </div>
                    
                    
                    							  <div class="row">
                        <label><strong>قوانین خرید تبلیغات:</strong><small><font color="red" >لطفا بعد از هر قانون <br>از تگ br استفاده کنید<br></font></small></label>
            
					 <div>	<textarea name="ghavanin"  rows="4" cols="100">
<?php echo($options['ghavanin']) ?>
</textarea>
                       </div> </div>
		   </div>
		
            </form>
            <center><medium style="color:red">پس از ویرایش ممکن است به طور طبیعی حدودا یک دقیقه اعمال تغییرات طول بکشد</medium><br> <button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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