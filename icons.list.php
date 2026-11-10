<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function progressHandlingFunction(e) {
        if (e.lengthComputable) {
        }
    }
    function edit() {
        var formData = new FormData($('#form-1')[0]);
        $.ajax({
            url: '<?php echo(url('ajax/admin.icons.list')); ?>',
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
                    case('nofile'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'فایلی انتخاب نشده است'});
                        break;
                    case('security'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور در فایل شما مورد امنیتی پیدا کرد و فایل شما از سرور حذف گردید.'});
                        break;
                    case('repeatname'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این نام ویژه قبلا ثبت شده'});
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
        return false;
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
    <h1 class="grid_12 margin-top no-margin-top-phone">ویرایش ایکون ها</h1>
    <p style="text-align: center;color:red;font-weight: bold;">چنانچه پس از تغییر آیکون ها تغییرات را مشاهده نکردید هیستوری مرورگر خود را پاک کنید</p>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box " id="form-1" method="post" onsubmit="return false;">
                <div class="header">
                    <h2>تنظیمات ویژه ایکون ها</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>تغییر آیکون بالای لیست انلاین:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_online.gif')); ?>"></span>
                            <input type="file" name="user_online" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون اخراج در لیست آنلاین :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.wand.png')); ?>"></span>
                            <input type="file" name="bgwand" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون پروفایل در لیست انلاین : </strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.pr.png')); ?>"></span>
                            <input type="file" name="profile" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون جنسیت مرد در لیست آنلاین :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_comment_m.png')); ?>"></span>
                            <input type="file" name="imard" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون جنسیت زن در لیست آنلاین :</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_comment_w.png')); ?>"></span>
                            <input type="file" name="izan" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون جنسیت ناشناخته در لیست آنلاین:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_comment_n.png')); ?>"></span>
                            <input type="file" name="ina" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر عکس لود لیست انلاین:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.ajax-loader.gif')); ?>"></span>
                            <input type="file" name="imgload" >
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون  زمان بیکاری کاربر:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_idle.png')); ?>"></span>
                            <input type="file" name="idle">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون بستن خصوصی:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/status/status_private.png')); ?>"></span>
                            <input type="file" name="status_private">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون نمایش جنسیت مرد برای خود کاربر:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_comment_m_self.png')); ?>"></span>
                            <input type="file" name="user_comment_m_self">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون نمایش جنسیت زن برای خود کاربر:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_comment_w_self.png')); ?>"></span>
                            <input type="file" name="user_comment_w_self">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون جنسیت ناشناخته برای خود کاربر:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/chat/chat.user_comment_n_self.png')); ?>"></span>
                            <input type="file" name="user_comment_n_self">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون اواتار پیشفرض مرد:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/avatars/no_avatar_male.png')); ?>"></span>
                            <input type="file" name="defmale">
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تغییر آیکون اواتار پیشفرض زن:</strong></label>
                        <div>
                            <span>آیکون فعلی: <img src="<?php echo(url('theme/images/avatars/no_avatar_female.jpg')); ?>"></span>
                            <input type="file" name="deffemale">
                        </div>
                    </div>
                    <div class="row"> 
                        <p style="text-align: center;"><button class="button blue flat block" onclick="edit();">ویرایش</button></p>
                    </div>
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