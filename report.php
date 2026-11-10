<?php 
include 'header.php';
include 'sidebar.php'; 
?>
<script type="text/javascript">
function DelReport(id){
	$.ajax({
		type:"POST",
		url:'<?php echo url('ajax/admin.users.report');?>',
		data:{id:id},
		success: function(data){
			switch(data){
                case('ok'):$.jGrowl('ذخیره شد', { header: 'موفقیت آمیز' });break;
                case('emailpattern'):$.jGrowl('لطفا یک ایمیل معتبر وارد کنید', { header: 'خطا' });break;
                case('emailrepeat'):$.jGrowl('این ایمیل مطعلق به کاربر دیگری است', { header: 'خطا' });break;
                case('nullusername'):$.jGrowl('پر کردن نام کاربری اجباری است', { header: 'خطا' });break;
                case('lenusername'):$.jGrowl('تعداد حروف نام کاربری بیش از حد تعیین شده است', { header: 'خطا' });break;
                case('lenname'):$.jGrowl('تعداد حروف نام نمایشی بیش از حد تعیین شده است', { header: 'خطا' });break;
                case('guest'):$.jGrowl('امکان حذف سطح کاربری مهمان وجود ندارد', { header: 'خطا' });break;
                case('admin'):$.jGrowl('وجود حداقل یک سطح مدیریت کامل لازم است', { header: 'خطا' });break;
                case('totype'):$.jGrowl('گروه جایگزین صحیح نیست', { header: 'خطا' });break;
                case('id'):$.jGrowl('این سطح کاربری وجود ندارد . ممکن است قبلا حذف شده باشد یا ساخته نشده باشد.', { header: 'خطا' });break;
                case('title'):$.jGrowl('لطفا عنوان درستی وارد کنید', { header: 'خطا' });break;
                case('url'):$.jGrowl('لطفا یک آدرس معتبر وارد کنید', { header: 'خطا' });break;
                case('repeat'):$.jGrowl('این لینک قبلا ثبت شده', { header: 'خطا' });break;
                case('page'):$.jGrowl('لطفا صفحه کد را مشخص کنید', { header: 'خطا' });break;
                case('location'):$.jGrowl('مکان کد مشخص نشده', { header: 'خطا' });break;
                case('emptypw'):$.jGrowl('رمز جداگانه اختصاص داده نشده است', { header: 'خطا' });break;
                case('capacity-page'):$.jGrowl('ظرفیت صفحه برای این نوع تبلیغ پر است', { header: 'خطا' });break;
                case('user'):$.jGrowl('این کاربر وجود ندارد', { header: 'خطا' });break;
                case('emptytext'):$.jGrowl('لطفا متنی را وارد کنید', { header: 'خطا' });break;
                case('text'):$.jGrowl('لطفا متنی را وارد کنید', { header: 'خطا' });break;
                case('question'):$.jGrowl('لطفا سوال را وارد کنید', { header: 'خطا' });break;
                case('repeatquest'):$.jGrowl('این متن دریافتی قبلا وارد شده', { header: 'خطا' });break;
                case('answer'):$.jGrowl('لطفا پاسخی را وارد کنید', { header: 'خطا' });break;
                case('type'):$.jGrowl('لطفا نوع را انتخاب کنید', { header: 'خطا' });break;
                case('security'):$.jGrowl('سرور در فایل شما مورد امنیتی پیدا کرد', { header: 'خطا' });break;
                case('repeatname'):$.jGrowl('این نام ویژه قبلا ثبت شده', { header: 'خطا' });break;
                case('capacity-location'):$.jGrowl('ظرفیت این موقعیت برای این نوع تبلیغ پر است', { header: 'خطا' });break;
                case('noadminstrator'):$.jGrowl('سطح کاربری این کاربر لازم نیست', { header: 'خطا' });break;
                case('repeatuser'):$.jGrowl('دسترسی این کاربر قبلا ساخته شده است', { header: 'خطا' });break;
                case('word'):$.jGrowl('لطفا يک کلمه براي فيلتر وارد کنيد', { header: 'خطا' });break;
                case('replace'):$.jGrowl('لطفا يک کلمه براي جايگزاري وارد کنيد', { header: 'خطا' });break;
                case('repeatword'):$.jGrowl('اين کلمه قبلا وارد شده است', { header: 'خطا' });break;
                case('nouser'):$.jGrowl('این کاربر وجود ندارد', { header: 'خطا' });break;
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
	<h1 class="grid_12 margin-top no-margin-top-phone">کاربران ریپورت شده</h1>
	
	<div class="grid_12">
		<div class="box">
			<div class="header">
				<h2>
					<img class="icon" src="<?php echo theme::url('img/icons/packs/fugue/16x16/balloons-box.png');?>">
					ریپورت شده ها
				</h2>
			</div>
			<div class="content">
			
				<div class="tabletools">
				</div>
				<table class="styled" id="daynmic_table">
					<thead>
						<tr>
							<th>ردیف</th>
							<th>کاربر</th>
							<th>تعداد دفعات بلاک</th>
							<th>زمان خارج شدن از ریپورت</th>
							<th>مدیریت</th>
						</tr>
					</thead>
					<tbody>
					<?php 
$x = 0;
$query = $sql->get('report_users');
foreach ($query as $row) {
	$user = $sql->where('id', $row['user'])->getOne('users');
	$x++; 
	?>
						<tr id="report-<?php echo $row['user'];?>">
							<td align="center"><?php echo $x;?></td>
							<td align="center"><?php echo $user['username'];?></td>
							<td align="center"><?php echo $user['report'];?></td>
							<td align="center"><?php echo jdate::start('l d F Y ساعت H:i:s', $row['time']);?></td>
							<td align="center"><a onclick="DelReport('<?php echo $row['user'];?>')" style="cursor:pointer; color:#F00">خارج کردن از ریپورت</a></td>
						</tr>
						<?php 
} 
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