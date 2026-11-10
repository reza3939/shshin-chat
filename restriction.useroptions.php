<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">

    function edit() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.restriction.useroptions')); ?>",
            data: $('#formeditsettings').serialize(),
            success: function (data) {
                switch (data) {
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
    var formblock;
    var forminputs;
    function smart() {
        $("#smart").dialog('open');
    }
    $(document).ready(function () {
    $("#smart").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });
    function prepare() {
        formblock = document.getElementById('formeditsettings');
        forminputs = formblock.getElementsByTagName('input');
    }

    function select_all(name, value) {
        for (i = 0; i < forminputs.length; i++) {
            // regex here to check name attribute
            var regex = new RegExp(name, "i");
            if (regex.test(forminputs[i].getAttribute('name'))) {
                if (value == '1') {
                    forminputs[i].checked = true;
                } else {
                    forminputs[i].checked = false;
                }
            }
        }
    }

    if (window.addEventListener) {
        window.addEventListener("load", prepare, false);
    } else if (window.attachEvent) {
        window.attachEvent("onload", prepare)
    } else if (document.getElementById) {
        window.onload = prepare;
    }
    function info_allowonlinelist() {
        $("#info_allowonlinelist").dialog('open');
    }
    $(document).ready(function () {
        $("#info_allowonlinelist").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });

    });

</script>
<div style="display: none;" id="info_allowonlinelist" title="راهنمای تنظیمات این سیستم">
    <p>برای استفاده از این قسمت حتما باید از قسمت تنظیمات اصلی قسمت شکل اولیه لیست انلاین را روی نمایش پروفایل های بروز شده قرار دهید تا این سیستم کار بکنه.</p>
</div>
  <div style="display: none;" id="smart" title="راهنمای تنظیمات این سیستم">
    <p>اگر تیک اخراج هوشمند یک کلمه را در قسمت کلمات زشت بزنید و  از اینجا هر درجه ای که فعال باشد با نوشتن آن کلمه زشت در چت روم به طور هوشمند اخراج می شود . که فعلا توصیه می شود این امکان را فعال نکنید</p>
</div>
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
                <input type="hidden" name="token" value="<?php echo(session('changepw')); ?>" />
                <div class="header">
                    <h2>محدودیت های امکانات</h2>
                </div>
                <?php $useroptions = json_decode($options['useroptions'], true); ?>
                <?php $allow_formats = json_decode($options['allow_formats'], true); ?>
                <?php $allow_formatso = json_decode($options['allow_formatso'], true); ?>
<div class="content tabbed">
 <div class="row">
                        <label><strong>آپلود شکلک شخصی:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="usersmile[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['usersmile'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('usersmile', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('usersmile',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <label><strong>ویرایش دلنوشته (استاتوس):</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="statos[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['statos'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('statos', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('statos',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>عشق سنج:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="love[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['love'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('love', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('love',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>فال حافظ:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="fal[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['fal'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('fal', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('fal',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>بازی:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="game[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['game'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('game', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('game',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                      <div class="row">
                        <label><strong>تاریخچه:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="history[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['history'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('history', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('history',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ضبط آنلاین صدا و ارسال در چت (حداکثر یک دقیقه):</strong><small>فقط درجه هایی که تیک بزنید دکمه میکروفون کنار کادر پیام را می بینند</small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="voicesend[]" value="<?php echo($type['id']); ?>" <?php if (isset($useroptions['voicesend']) && in_array($type['id'], (array) $useroptions['voicesend'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('voicesend', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('voicesend',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>استوری (تصویر یا نوشته‌ای که یک روز می ماند):</strong><small>نوار استوری بالای اتاق فقط برای درجه های انتخاب شده باز می شود</small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="story[]" value="<?php echo($type['id']); ?>" <?php if (isset($useroptions['story']) && in_array($type['id'], (array) $useroptions['story'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('story', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('story',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>لیست کاربران:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="users[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['users'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('users', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('users',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>فرمت های مجاز برای ارسال فایل در خصوصی:</strong></label>
                        <div>
                           <table><tr><td>
                            mp3<input type="checkbox" name="allow_formats[]" value="mp3" <?php if ($allow_formats['mp3'] == 1) echo('checked'); ?> /></td><td> 
                            3gp<input type="checkbox" name="allow_formats[]" value="3gp" <?php if ($allow_formats['3gp'] == 1) echo('checked'); ?> /></td><td>  
                            jpg<input type="checkbox" name="allow_formats[]" value="jpg" <?php if ($allow_formats['jpg'] == 1) echo('checked'); ?> /></td><td>  
                            gif<input type="checkbox" name="allow_formats[]" value="gif" <?php if ($allow_formats['gif'] == 1) echo('checked'); ?> /></td><td>  
                            jpeg<input type="checkbox" name="allow_formats[]" value="jpeg" <?php if ($allow_formats['jpeg'] == 1) echo('checked'); ?> /></td><td> 
                            mov<input type="checkbox" name="allow_formats[]" value="mov" <?php if ($allow_formats['mov'] == 1) echo('checked'); ?> /></td><td>  
                                 png<input type="checkbox" name="allow_formats[]" value="png" <?php if ($allow_formats['png'] == 1) echo('checked'); ?> /></td><td>  
                            txt<input type="checkbox" name="allow_formats[]" value="txt" <?php if ($allow_formats['txt'] == 1) echo('checked'); ?> /></td><td>  
                            pdf<input type="checkbox" name="allow_formats[]" value="pdf" <?php if ($allow_formats['pdf'] == 1) echo('checked'); ?> /></td><td>  
                            wma<input type="checkbox" name="allow_formats[]" value="wma" <?php if ($allow_formats['wma'] == 1) echo('checked'); ?> /></td><td>  
                            wmv<input type="checkbox" name="allow_formats[]" value="wmv" <?php if ($allow_formats['wmv'] == 1) echo('checked'); ?> /></td><td>  
                            mp4<input type="checkbox" name="allow_formats[]" value="mp4" <?php if ($allow_formats['mp4'] == 1) echo('checked'); ?> /></td> 
                           </tr></table>
                            <a style="color:red;cursor:pointer; " onClick="select_all('allow_formats', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('allow_formats',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <label><strong>فرمت های مجاز برای ارسال فایل در عمومی:</strong></label>
                        <div>
                           <table><tr><td>
                            mp3<input type="checkbox" name="allow_formatso[]" value="mp3" <?php if ($allow_formatso['mp3'] == 1) echo('checked'); ?> /></td><td>
                            3gp<input type="checkbox" name="allow_formatso[]" value="3gp" <?php if ($allow_formatso['3gp'] == 1) echo('checked'); ?> /></td><td> 
                            jpg<input type="checkbox" name="allow_formatso[]" value="jpg" <?php if ($allow_formatso['jpg'] == 1) echo('checked'); ?> /></td><td> 
                            gif<input type="checkbox" name="allow_formatso[]" value="gif" <?php if ($allow_formatso['gif'] == 1) echo('checked'); ?> /></td><td> 
                            jpeg<input type="checkbox" name="allow_formatso[]" value="jpeg" <?php if ($allow_formatso['jpeg'] == 1) echo('checked'); ?> /></td><td>
                            mov<input type="checkbox" name="allow_formatso[]" value="mov" <?php if ($allow_formatso['mov'] == 1) echo('checked'); ?> /></td><td> 
                             png<input type="checkbox" name="allow_formatso[]" value="png" <?php if ($allow_formatso['png'] == 1) echo('checked'); ?> /></td><td> 
                            txt<input type="checkbox" name="allow_formatso[]" value="txt" <?php if ($allow_formatso['txt'] == 1) echo('checked'); ?> /></td><td> 
                            pdf<input type="checkbox" name="allow_formatso[]" value="pdf" <?php if ($allow_formatso['pdf'] == 1) echo('checked'); ?> /></td><td> 
                            wma<input type="checkbox" name="allow_formatso[]" value="wma" <?php if ($allow_formatso['wma'] == 1) echo('checked'); ?> /></td><td> 
                            wmv<input type="checkbox" name="allow_formatso[]" value="wmv" <?php if ($allow_formatso['wmv'] == 1) echo('checked'); ?> /></td><td> 
                            mp4<input type="checkbox" name="allow_formatso[]" value="mp4" <?php if ($allow_formatso['mp4'] == 1) echo('checked'); ?> /></td> 
                           </tr></table>
                            <a style="color:red;cursor:pointer; " onClick="select_all('allow_formatso', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('allow_formatso',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <label><strong>ارسال پیام در عمومی:</strong><small></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="allowtypessender_main[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['allowtypessender_main'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('allowtypessender_main', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('allowtypessender_main',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ساخت اتاق کنفرانس:</strong><small></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                if ($type['id'] == '1')
                                    continue;
                                ?>
                                <input type="checkbox" name="conference_premission[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['conference_premission'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('conference_premission', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('conference_premission',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>محدودیت سرعت در ارسال پیام:</strong><small>برای توضحات کامل تنظیمات قسمت پیام ها را بخوانید</small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="chat_speedmsg[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['chat_speedmsg'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('chat_speedmsg', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('chat_speedmsg',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>نمایش سیستم عامل کاربران در لیست آنلاین:</strong><small></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="show_userOs[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['show_userOs'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('show_userOs', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('show_userOs',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>	
                    <div class="row">
                        <label><strong>نمایش زمان بیکار بودن کاربران در لیست آنلاین:</strong><small></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="show_idleTime_onlinelist[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['show_idleTime_onlinelist'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('show_idleTime_onlinelist', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('show_idleTime_onlinelist',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <label><strong>قسمت اخبار:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="chat_news[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['chat_news'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('chat_news', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('chat_news',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>نمایش مرورگر کاربران در لیست انلاین:</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="show_browser[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['show_browser'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('show_browser', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('show_browser',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>نمایش پیام های ارسالی در خصوصی :</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="showpv[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['showpv'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('showpv', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('showpv',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>نمایش پیام های دریافتی در خصوصی</strong></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {
                                ?>
                                <input type="checkbox" name="showms[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['showms'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('showms', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('showms',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
        
                </div>
            </form>
            <center> <medium style="color:red">پس از ویرایش ممکن است به طور طبیعی حدودا یک دقیقه اعمال تغییرات طول بکشد</medium><br><button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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