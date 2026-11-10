<?php
include('header.php');
include('sidebar.php');
$ads = safe::number(giu('el4'));
$ads = db::get('ads', "*", "`id`='$ads'");
?>
<script type="text/javascript" src="<?php echo(theme::url('js/ajaxfileupload.js')); ?>"></script>
<script type="text/javascript"> 
    function edit() {
        var $form = $('#formeditads');
        var formData = new FormData();
        formData.append('token', '<?php echo(session('changepw')); ?>');
        formData.append('id', '<?php echo($ads['id']); ?>');
        formData.append('title', $('input[name=title]', $form).val());
        formData.append('url', $('input[name=url]', $form).val()); 
        formData.append('type', $('select[name=type]', $form).val());
        formData.append('page', $('select[name=page]', $form).val());
        formData.append('location', $('select[name=location]', $form).val()); 
        formData.append('exptime', $('input[name=exptime]', $form).val());
        formData.append('expiration', $('select[name=expiration]', $form).val());
        formData.append('expirationk', $('select[name=expirationk]', $form).val());
        if ($('#banner')[0].files)
            formData.append('banner', $('#banner')[0].files[0]);
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.ads.edit')); ?>",
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقيت آميز', text: 'ذخيره شد'});
                        break;
                    case('type'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور در فايل شما مورد امنيتي پيدا کرد و فايل شما از سرور حذف گرديد'});
                        break;
                    case('security'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سرور در فايل شما مورد امنيتي پيدا کرد و فايل شما از سرور حذف گرديد.'});
                        break;
                    case('repeatname'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'اين نام ويژه قبلا ثبت شده'});
                        break;
                    case('url'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا آدرس تبليغ دهنده را معتبر وارد کنيد'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">مديريت تبليغات</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formeditads">
                <input type="hidden" name="token" value="<?php echo(session('changepw')); ?>" />
                <div class="header">
                    <h2>ويرايش <?php echo $ads['title']; ?></h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>عنوان تبليغ:</strong></label>
                        <div><input type="text" name="title" class="required" value="<?php echo $ads['title']; ?>"/></div>
                    </div> 
                    <div class="row" id="urlrow" >
                        <label><strong>سايت تبليغ دهنده:</strong></label>
                        <div>
                            <input type="text" name="url" style="direction: ltr;padding-left: 30px;font-family: sans-serif;" value="<?php echo $ads['url']; ?>" class="required">
                        </div>
                    </div>
<?php 
     if ($ads['page'] == 'chat') 
       {
 	    $n1= 'selected="selected"';
            
     }if ($ads['page'] == 'login') 
       {
 	    $n2= 'selected="selected"';
            
     }if ($ads['page'] == 'profile') 
       {
 	    $n3= 'selected="selected"';
            
     }if ($ads['page'] == 'banned') 
       {
 	    $n4= 'selected="selected"';
            
     }
if ($ads['type'] == 'newtab') 
       {
 	    $j1= 'selected="selected"';
            
     }if ($ads['type'] == 'popup') 
       {
 	    $j2= 'selected="selected"';
            
     }if ($ads['type'] == 'banner') 
       {
 	    $j3= 'selected="selected"';
            
     }if ($ads['type'] == 'fixedbanner') 
       {
 	    $j4= 'selected="selected"';
            
     }
                 if($ads['type']!=banner) { ?> 
                    <div class="row">
                        <label><strong>صفحه تبليغ:</strong></label>
                        <div>
                            <select name="page" class="search">
                                <option value="chat" <?php print $n1; ?> >داخل چت روم</option>
                                <option value="login" <?php print $n2; ?> >بيرون چت روم</option>
                                <option value="profile" <?php print $n3; ?> >پروفايل</option>
                                <option value="banned" <?php print $n4; ?> >صفحه اخراج</option>
                            </select>
                        </div>
                    </div>
                        <?php }else { ?>
                       <div class="row" style="display:none;">
                        <label><strong>صفحه تبليغ:</strong></label>
                        <div>
                            <select name="page" class="search">
                                <option value="chat" <?php print $n1; ?> >داخل چت روم</option>
                                <option value="login" <?php print $n2; ?> >بيرون چت روم</option>
                                <option value="profile" <?php print $n3; ?> >پروفايل</option>
                                <option value="banned" <?php print $n4; ?> >صفحه اخراج</option>
                            </select>
                        </div>
                    </div>
                    <?php } if($ads['type']==banner ) { ?> 
                    <div class="row" id="typerow">
                        <label><strong>نوع تبلیغ:</strong></label>
                        <div>
                            <select name="type" class="search">
                                <option value="banner" <?php print $j3; ?> >بنر ساده</option>
                            </select>
                        </div>
                    </div>
              <?php } else if($ads['type']==fixedbanner ) { ?>
                  <div class="row" id="typerow">
                        <label><strong>نوع تبلیغ:</strong></label>
                        <div>
                            <select name="type" class="search">
                                <option value="fixedbanner" <?php print $j4; ?>>بنر گوشه ای</option>
                            </select>
                        </div>
                    </div>

              <?php } else if($ads['type']==newtab || $ads['type']==popup) { ?>  
                   <div class="row" id="typerow" >
                        <label><strong>نوع تبلیغ:</strong></label>
                        <div>
                            <select name="type" class="search">
                                <option value="popup" <?php print $j2; ?>>پاپ آپ</option>
                                <option value="newtab" <?php print $j1; ?> >نیوتب</option>
                            </select>
                        </div>
                    </div>
                   
<?php }
     if ($ads['location'] == 'top') 
       {
 	    $m1= 'selected="selected"';
            
     }if ($ads['location'] == 'bottom') 
       {
 	    $m2= 'selected="selected"';
            
     }

 if ($ads['location'] == 'top-right') 
       {
 	    $o1= 'selected="selected"';
            
     }if ($ads['location'] == 'top-left') 
       {
 	    $o2= 'selected="selected"';
            
     } if ($ads['location'] == 'bottom-right') 
       {
 	    $o3= 'selected="selected"';
            
     }if ($ads['location'] == 'bottom-left') 
       {
 	    $o4= 'selected="selected"';
            
     }
?>
                   <?php if($ads['type']!=newtab && $ads['type']!=popup ) { ?> 
                <div id="bannerr" >
                        <div class="row">
                            <label><strong>تصوير بنر:</strong></label>
                            <div>
                                <input type="file" name="banner" id="banner" >
                                <span style="font-size:12px; color:#F00;"> در صورت عدم تغییر بنر نیاز به اپلود مجدد بنر نمی باشد</span>
                            </div> 
                        </div> 
                    </div>
                   <?php } else { ?>
                   <div id="bannerr" >
                        <div class="row" style="display:none;">
                            <label><strong>تصوير بنر:</strong></label>
                            <div>
                                <input type="file" name="banner" id="banner" >
                                <span style="font-size:12px; color:#F00;"> در صورت عدم تغییر بنر نیاز به اپلود مجدد بنر نمی باشد</span>
                            </div> 
                        </div> 
                    </div>
                   <?php } if($ads['type']==banner ) { ?> 
                   <div class="row" >
                            <label><strong>موقعيت قرارگيري:</strong></label>
                            <div>
                                <select name="location" class="search">
                                <option value="top" <?php print $m1; ?> >بالا - وسط</option>
                                 <option value="bottom" <?php print $m2; ?> >پایین - وسط</option>
                                 </select>
                            </div>
                        </div>
                     <?php } else if($ads['type']==fixedbanner ) { ?>
                      <div class="row">
                            <label><strong>موقعيت قرارگيري:</strong></label>
                            <div>
                                <select name="location" class="search">
                                <option value="top-right" <?php print $o1; ?> >گوشه سمت راست بالا</option>
                                    <option value="top-left" <?php print $o2; ?>>گوشه سمت چپ بالا</option>
                                    <option value="bottom-right" <?php print $o3; ?>>گوشه سمت راست پایین</option>
                                    <option value="bottom-left" <?php print $o4; ?>>گوشه سمت چپ پایین</option>
                                 </select>
                            </div>
                        </div>
                     <?php } else {   ?>
                    <div class="row" style="display:none;">
                            <label><strong>موقعيت قرارگيري:</strong></label>
                            <div>
                                <select name="location" class="search">
                                <option value="top" <?php print $m1; ?> >بالا - وسط</option>
                                 <option value="bottom" <?php print $m2; ?> >پایین - وسط</option>
                                 </select>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row" id="ctrow" >
                        <label><strong>تاريخ درج:</strong></label>
                            <div><input type="text" name="ctt" disabled="disabled" value="<?php echo(jdate::start('Y/m/d H:i', $ads['createtime'])); ?>"/></div>
                    </div>
                    <div class="row" id="etimeee" >
                        <label><strong>تاريخ انقضا:</strong></label>
                            <div><input type="text" name="etimeee" disabled="disabled" value="<?php echo(jdate::start('Y/m/d H:i', $ads['expiration'])); ?>"/></div>
                    </div>
                    <div class="row" id="exptime" style="display:none;">
                        <label><strong>تاريخ انقضا:</strong></label>
                            <div><input type="text" name="exptime" disabled="disabled" value="<?php echo $ads['expiration']; ?>"/></div>
                    </div>
                    <div class="row" id="expirationrow" >
                        <label><strong>افزايش تاريخ انقضا:</strong></label>
                        <div>
                            <select name="expiration" class="search">
                                <?php
                                for ($x = 1; $x != 60; $x++) {
                                    echo("<option value=\"$x-minute\">$x دقيقه</option>");
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
                    <div class="row" id="expirationrow" >
                        <label><strong>کاهش تاريخ انقضا:</strong></label>
                        <div>
                            <select name="expirationk" class="search">
                                 <option value="1">بدون تغيير</option>
                                <?php
                                for ($x = 1; $x != 60; $x++) {
                                    echo("<option value=\"$x-minute\">$x دقيقه</option>");
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
                </div>
              
            </form>
            <center> <button class="button blue flat block" onclick="edit();">ويرايش</button></center>
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