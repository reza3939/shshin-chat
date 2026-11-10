<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript" src="<?php echo(theme::url('js/ajaxfileupload.js')); ?>"></script>
<script type="text/javascript">
    function add() {
        var $form = $('#formaddsmily');
        var data = {
            'name': $('input[name=name]', $form).val(),
            'priority': $('input[name=priority]', $form).val(),
        };
        $.ajaxFileUpload({
            url: '<?php echo(url('ajax/admin.smilies.add.single')); ?>',
            secureuri: false,
            fileElementId: 'filesmily',
            data: data,
            dataType: 'text',
            success: function (data, status) {
                switch (data) {
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
            },
            error: function (data, status, e)
            {
                alert(data);
            }
        });
    }
    $(document).ready(function () {
        $(".uploader").each(function () {
            var k = $(this);
            k.pluploadQueue($.extend({
                runtimes: "html5,flash,html4",
                url: "<?php echo(url('ajax/admin.smilies.add.tuple')); ?>",
                max_file_size: "10mb",
                chunk_size: "1mb",
                unique_names: true,
                filters: [
                    {title: "فایل های تصویری", extensions: "jpg,gif,png"},
                    {title: "فایل های فشرده", extensions: "zip"}
                ], flash_swf_url: "js/mylibs/forms/uploader/plupload.flash.swf"
            },
                    k.data()
                    ));
            k.find(".plupload_button").addClass("button grey btn");
            k.find(".plupload_add").addClass("icon-plus");
            k.find(".plupload_start").addClass("icon-ok")
        });
    });
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
    <h1 class="grid_12 margin-top no-margin-top-phone">شکلک جدید</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formaddsmily">
                <div class="header">
                    <h2>آپلود دست جمعی شکلک ها</h2>
                </div>
                <div class="content">
                    <p style="color: red;text-decoration: blink;text-align: center;">شما در قسمت هم میتوانید فایل های فشرده (.zip) ارسال کنید هم شکلک ها را گروهی آپلود کنید</p>


                    <div class="uploader"></div>
                </div>

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
<?php include 'footer.php'; ?>