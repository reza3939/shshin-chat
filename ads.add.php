<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    var proccted = '';
    function progressHandlingFunction(e) {
        if (e.lengthComputable) {
            //$('progress').attr({value:e.loaded,max:e.total});
        }
    }
    function add() {
        var formData = new FormData($('#formaddword')[0]);
        $.ajax({
            url: '<?php echo(url('ajax/admin.ads.add')); ?>',
            type: 'POST',
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                }
                return myXhr;
            },
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('type'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور در فایل شما مورد امنیتی پیدا کرد و فایل شما از سرور حذف گردید'});
                        break;
                    case('security'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور در فایل شما مورد امنیتی پیدا کرد و فایل شما از سرور حذف گردید.'});
                        break;
                    case('repeatname'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این نام ویژه قبلا ثبت شده'});
                        break;
                    case('page'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'صفحه ای معتبر وارد کنید'});
                        break;
                    case('type'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'نوع تبلیغ معتبر نیست'});
                        break;
                    case('capacity-page'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'ظرفیت صفحه برای این نوع تبلیغ پر است'});
                        break;
                    case('url'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا آدرس تبلیغ دهنده را معتبر وارد کنید'});
                        break;
                    case('capacity-location'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'ظرفیت این موقعیت برای این نوع تبلیغ پر است'});
                        break;
                    default:
                        alert(data);
                        break;
                }

            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });

    }
    $(document).ready(function () {
        var $form = $('#formaddword');
        $('select[name=page]', $form).change(function () {

            if ($(this).val() != '') {
                $('#typerow').slideDown(1000);
                $('select[name=type]', $form).val('').trigger("liszt:updated");
            } else {
                $('#typerow').slideUp(1000);
                $('select[name=type]', $form).val('').change().trigger("liszt:updated");
            }
        })
        $('select[name=type]', $form).change(function () {

            if ($(this).val() != '') {
                if ($(this).val() == 'popup' || $(this).val() == 'newtab') {
                    $('#popup').slideDown(1000);
                } else {
                    $('#popup').slideUp(1000);
                }
                if ($(this).val() == 'banner' || $(this).val() == 'fixedbanner') {

                    $('#banner').slideDown(1000);
                    if ($(this).val() == 'fixedbanner') {
                        $('#fixedbanner').slideDown(1000);
                        var $selecthtml = '<option value="top-right">گوشه سمت راست بالا</option>\
                                    <option value="top-left">گوشه سمت چپ بالا</option>\
                                    <option value="bottom-right">گوشه سمت راست پایین</option>\
                                    <option value="bottom-left">گوشه سمت چپ پایین</option>';
                    }
                    if ($(this).val() == 'banner') {
                        $('#fixedbanner').slideUp(1000);
                        if ($('select[name=page]', $form).val() == 'login') {
                            $.msgGrowl({type: 'success', title: 'امکان قرار دادن بنر ساده در این صفحه وجود ندارد', text: 'خطا'});
                            $('select[name=page]', $form).val('').change().trigger("liszt:updated");
                            $('#banner').slideUp(1000);
                            return false;
                        }
                        var $selecthtml = '<option value="top">بالا - وسط</option>\
                                    <option value="bottom">پایین - وسط</option>';
                    }
                    $('select[name=location]', $form).html($selecthtml).trigger("liszt:updated");
                } else {
                    $('#banner,#fixedbanner').slideUp(1000);
                }
                $('#expirationrow,#urlrow').slideDown(1000);
            } else {
                $('#expirationrow,#urlrow').slideUp(1000);
            }
        })
    })

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
    <h1 class="grid_12 margin-top no-margin-top-phone">مدیریت تبلیغات</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formaddword">
                <input type="hidden" name="token" value="<?php echo(session('changepw')); ?>" />
                <div class="header">
                    <h2>تبلیغ جدید</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>عنوان تبلیغ:</strong></label>
                        <div><input type="text" name="title" class="required" value=""/></div>
                    </div>
                    <div class="row">
                        <label><strong>صفحه تبلیغ:</strong></label>
                        <div>
                            <select name="page" class="search">
                                <option value="">لطفا انتخاب کنید</option>
                                <option value="chat">داخل چت روم</option>
                                <option value="login">بیرون چت روم</option>
                                <option value="profile">پروفایل</option>
                                <option value="banned">صفحه اخراج</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="typerow" style="display: none;">
                        <label><strong>نوع تبلیغ:</strong></label>
                        <div>
                            <select name="type" class="search">
                                <option value="">لطفا انتخاب کنید</option>
                                <option value="popup">پاپ آپ</option>
                                <option value="newtab">نیوتب</option>
                                <option value="banner">بنر ساده</option>
                                <option value="fixedbanner">بنر گوشه ای</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="urlrow" style="display: none;">
                        <label><strong>سایت تبلیغ دهنده:</strong></label>
                        <div>
                            <input type="text" name="url" style="direction: ltr;padding-left: 30px;font-family: sans-serif;" value="http://" class="required">
                        </div>
                    </div>
                    <div class="row" id="expirationrow" style="display: none;">
                        <label><strong>تاریخ انقضا:</strong></label>
                        <div>
                            <select name="expiration" class="search">
                                <?php
                                for ($x = 1; $x != 60; $x++) {
                                    echo("<option value=\"$x-minute\">$x دقیقه</option>");
                                }
                                for ($x = 1; $x != 24; $x++) {
                                    echo("<option value=\"$x-hour\">$x ساعت</option>");
                                }
                                for ($x = 1; $x != 30; $x++) {
                                    echo("<option value=\"$x-day\">$x روز</option>");
                                }
                                for ($x = 1; $x != 12; $x++) {
                                    echo("<option value=\"$x-month\">$x ماه</option>");
                                }
                                for ($x = 1; $x != 6; $x++) {
                                    echo("<option value=\"$x-year\">$x سال</option>");
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div id="popup" style="display: none;">
                        <div class="row">
                            <label><strong>محدودیت بازشدن:</strong></label>
                            <div>
                                <select name="cookie" class="search">
                                    <option value="0">همیشه فعال باش</option>
                                    <?php
                                    for ($x = 1; $x != 30; $x++) {
                                        echo("<option value=\"$x-day\">$x روز بکبار</option>");
                                    }
                                    for ($x = 1; $x != 12; $x++) {
                                        echo("<option value=\"$x-month\">$x ماه بکبار</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="banner" style="display: none;">
                        <div class="row">
                            <label><strong>تصویر بنر:</strong></label>
                            <div>
                                <input type="file" name="banner">
                            </div>
                        </div>
                        <div class="row">
                            <label><strong>موقعیت قرارگیری:</strong></label>
                            <div>
                                <select name="location" class="search"></select>
                            </div>
                        </div>
                    </div>
                    <div id="fixedbanner" style="display: none;">
                        <div class="row">
                            <label><strong>باقابلیت بستن:</strong></label>
                            <div>
                                <input type="checkbox" name="closeable" value="1">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <center> <button class="button blue flat block" onclick="add();">اضافه کن</button></center>
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