<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">

function edit(){
    $.ajax({
        type: "POST",
        url: "<?php echo(url('ajax/admin.setting.themes')); ?>",
        data: $('#formeditsettings').serialize(),
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
	<h1 class="grid_12 margin-top no-margin-top-phone">تنظیمات</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formeditsettings">
                <div class="header">
                    <h2>مدیریت قالب ها</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>باز بودن چت روم:</strong></label>
                        <div>خیر<input type="checkbox" name="chat_close" value="1" <?php if($options['chat_close'] == 'true')echo('checked'); ?>/> توجه در صورت کلیک کردن بر روی این گزینه چت روم شما بسته خواهد شد و باز کردن آن فقط توسط تیم پشتیبانی امکان پذیر است پس تا حد امکان از کلیک کردن بر روی این گزینه اجتناب نمایید  </div>
                    </div>
                    <div class="row">
                        <label><strong>قالب پنل مدیریتی:</strong></label>
                        <div><select name="admintheme" class="search required">
                            <option value="adminpanel" <?php if($options['admintheme'] == 'adminpanel')echo('selected'); ?>>AdminPanel (قالب استاندارد)</option>
                        </select></div>
                    </div>
                    <div class="row">
                        <label><strong>روشن بودن تماس با ما:</strong></label>
                        <div>بلی<input type="checkbox" name="contact" value="1" <?php if($options['contact'] == 'true')echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>قالب تماس باما چت روم:</strong></label>
                        <div><select name="chat_contact_theme" class="search required">
                            <option value="contact" <?php if($options['chat_contact_theme'] == 'contact')echo('selected'); ?>>contact | (قالب استاندارد)</option>
                        </select></div>
                    </div>
                    <div class="row">
                        <label><strong>روشن بودن فال چت روم:</strong></label>
                        <div>بلی<input type="checkbox" name="chat_fal_enable" value="1" <?php if($options['chat_fal_enable'] == 'true')echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>قالب فال چت روم:</strong></label>
                        <div><select name="chat_fal_theme" class="search required">
                            <option value="fal" <?php if($options['chat_fal_theme'] == 'fal')echo('selected'); ?>>fal | (قالب استاندارد)</option>
                        </select></div>
                    </div>
                    <div class="row">
                        <label><strong>نوع پروفایل چت روم:</strong></label>
                        <div><select name="chat_profile_theme" class="search required">
                            <option value="profile" <?php if($options['chat_profile_theme'] == 'profile')echo('selected'); ?>>پروفایل حرفه ای (( جامعه مجازی ))</option>
                        </select></div>
                    </div>
                    <div class="row">
                        <label><strong>روشن بودن امتیازات چت روم:</strong></label>
                        <div>بلی<input type="checkbox" name="chat_users_enable" value="1" <?php if($options['chat_users_enable'] == 'true')echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>قالب امتیازات چت روم:</strong></label>
                        <div><select name="chat_users_theme" class="search required">
                            <option value="users" <?php if($options['chat_users_theme'] == 'users')echo('selected'); ?>>users | (قالب استاندارد)</option>
                        </select></div>
                    </div>
                    <div class="row">
                        <label><strong>روشن بودن بازی چت روم:</strong></label>
                        <div>بلی<input type="checkbox" name="chat_game_enable" value="1" <?php if($options['chat_game_enable'] == 'true')echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>قالب بازی چت روم:</strong></label>
                        <div><select name="chat_game_theme" class="search required">
                            <option value="game" <?php if($options['chat_game_theme'] == 'game')echo('selected'); ?>>game | (قالب استاندارد)</option>
                        </select></div>
                    </div>
                    <div class="row">
                        <label><strong>روشن بودن عشق سنج چت روم:</strong></label>
                        <div>بلی<input type="checkbox" name="chat_love_enable" value="1" <?php if($options['chat_love_enable'] == 'true')echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>قالب عشق سنج چت روم:</strong></label>
                        <div><select name="chat_love_theme" class="search required">
                            <option value="love" <?php if($options['chat_love_theme'] == 'love')echo('selected'); ?>>love | (قالب استاندارد)</option>
                            <option value="love2" <?php if($options['chat_love_theme'] == 'love2')echo('selected'); ?>>love new | (قالب بنفش جدید)</option>
                       </select></div>
                    </div>
                    <div class="row">
                        <label><strong>روشن بودن تاریخچه چت روم:</strong></label>
                        <div>بلی<input type="checkbox" name="chat_history_enable" value="1" <?php if($options['chat_history_enable'] == 'true')echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>قالب تاریخچه چت روم:</strong></label>
                        <div><select name="chat_history_theme" class="search required">
                            <option value="history" <?php if($options['chat_history_theme'] == 'history')echo('selected'); ?>>history | (قالب استاندارد)</option>
                        </select></div>
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