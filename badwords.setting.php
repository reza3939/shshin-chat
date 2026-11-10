<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">

    function edit() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.badwords.setting')); ?>",
            data: $('#formeditsettings').serialize(),
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('title'):
                        $.msgGrowl({type: 'success', title: 'لطفا نامی برای اتاق انتخاب کنید', text: 'خطا'});
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

   function smartfilter() {
        $("#smartfilter").dialog('open');
    }
    $(document).ready(function () {
        $("#smartfilter").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });

   function smartname() {
        $("#smartname").dialog('open');
    }
    $(document).ready(function () {
        $("#smartname").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });

   function mywordinfo() {
        $("#mywordinfo").dialog('open');
    }
    $(document).ready(function () {
        $("#mywordinfo").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });

   function chatreportmsginfo() {
        $("#chatreportmsginfo").dialog('open');
    }
    $(document).ready(function () {
        $("#chatreportmsginfo").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });
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
</script>
<div style="display: none;" id="smartfilter" title="راهنمای تنظیمات این سیستم">
   <p style="color:red; font-size:16px;">فیلتر هوشمند کلمات زشت چیست ؟ <br> فیلتر هوشمند برای مواقعی است که به طور مثال یک فرد از کاراکترهای مختلف برای دور زدن فیلتر استفاده میکند مثلا وقتی فیلتر هوشمند فعال باشد و یک فرد کلمه زشت رو با انواع کاراکتر جهت دور زدن استفاده کند بازم کلمه فیلتر نشان میدهد مثلا کلمه چت رو بخواهد به صورت چ....ت یا چ///***ت برای دور زدن فیلتر کلمات زشت بنویسد باز هم فیلتر خواهد شد اما اگر فیلتر هوشمند فعال نباشد فقط خود کلمه چت فیلتر میشه و اگر فردی بنویسد چ...ت فیلتر نمیشود .</medium>
 </p>
</div>
<div style="display: none;" id="smartname" title="راهنمای تنظیمات این سیستم">
   <p style="color:red; font-size:16px;">فیلتر هوشمند نام کاربری زشت چیست ؟ <br> فیلتر هوشمند نام کاربری زشت برای مواقعی است که به طور مثال یک فرد از کاراکترهای مختلف برای دور زدن ورود به چت روم یا  از نام کاربری زشت استفاده میکند مثلا وقتی فیلتر هوشمند نام کاربری زشت فعال باشد و یک فرد نام کاربری زشت رو با انواع کاراکتر جهت دور زدن استفاده کند بازم نام کاربری تغییر میکند مثلا کلمه چت رو بخواهد به صورت چ....ت یا چ///***ت برای دور زدن فیلتر بنویسد‌و وارد چت روم بشود باز هم اتومات تغییر خواهد کرد اما اگر فیلتر هوشمند نام کاربری زشت فعال نباشد فقط خود کلمه چت فیلتر میشه و اگر فردی با اسم  چ...ت وارد شودتغییر نمیکند . .</medium>
 </p>
</div>
<div style="display: none;" id="mywordinfo" title="راهنمای تنظیمات این سیستم">
   <p style="color:red; font-size:16px;">در صورت غیرفعال بودن به صورت پیش فرض نام کاربری زشت به محض ورود به طور اتوماتیک به کلمه مشخص شده سیستم تغییر می کند مانند تغییر نام اتوماتیک در چوب اخراج که نام کاربر مثلا به این نام تبدیل می شود  : user.99646 <br>
                  در صورت فعال بودن به عنوان مثل فردی با کلمه زشت خر وارد شود و کلمه جایگزین خر کلمه بد باشد و یک کاربر با اسم او خر است وارد شود تغییر میکند به او بد است </medium>
 </p>
</div>
<div style="display: none;" id="smart" title="راهنمای تنظیمات این سیستم">
   <p style="color:red; font-size:16px;">این سیستم به گونه ای است که در صورت فعال بودن گزینه ساکت کلمه زشت بر اساس تعداد تکرار مشخص شده از سوی شما به ازای هر بار تکرار کلمه زشت به آن فرد با درجه ای که تیک آن زده شده هشدار می دهد در صورت تکرار بیشتر از حد مجاز ساکت می شوید و اگر از حد مجاز بیشتر تکرار کند به اندازه زمان مشخص شده ساکت می شود </medium>
 </p>
</div>
<div style="display: none;" id="chatreportmsginfo" title="راهنمای تنظیمات این سیستم">
   <p style="color:red; font-size:16px;">تیک هر کدوم از سطوح رو بزنید  گزارش همون  درجه یا سطوح  در صورت استفاده از کلمه مورد دار برای مدیران  ارسال خواهد شد به عنوان مثال اگه تیک مدیر اصلی  را بزنید اگه از کلمه زشت استفاده کند  برای سایر مدیران و ناظران ارسال خواهد شد</medium>
 </p>
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
                    <h2>تنظیمات کلمات فیلتر شده</h2>
                </div>
<?php $useroptions = json_decode($options['useroptions'], true); ?>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>فیلتر هوشمند کلمات زشت:</strong>
                        <small><a href="javascript:smartfilter();">[فیلتر هوشمند کلمات زشت چیست؟]</a></small>
                        </label>
                        <div>بلی<input type="checkbox" name="intelligently_text" value="1" <?php if ($options['intelligently_text'] == 'true') echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>فیلتر هوشمند نام های کاربری زشت:</strong>
                        <small><a href="javascript:smartname();">[فیلتر هوشمند نام کاربری زشت چیست‌؟]</a></small>
                        </label>
                        <div>بلی<input type="checkbox" name="intelligently_badname" value="1" <?php if ($options['intelligently_badname'] == 'true') echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                       <label><strong>تغییر نام خودکاربه کلمه جایگزین دلخواه درنام کاربری زشت :</strong>
                      <small><a href="javascript:mywordinfo();">[توضیحات]</a></small><br>
                       <medium style="color:red;"> پیشنهاد میشه این بخش غیرفعال باشد </medium>
 
                       </label>
                        <div>بلی<input type="checkbox" name="myword_badname" value="1" <?php if ($options['myword_badname'] == 'true') echo('checked'); ?>  /></div>
                    </div>
                    <div class="row">
                        <label><strong>خفه شدن خودکار کاربر در صورت مشاهده کلمه زشت:</strong> </label>
                        <div>بلی<input type="checkbox" name="robo_silent" value="1" <?php if ($options['robo_silent'] == 'true') echo('checked'); ?>  /></div>
                    </div>
                      <div class="row">
                        <label><strong>گزارش کلمات زشت در ربات:</strong><a href="javascript:chatreportmsginfo();">[توضیحات]</a></small></label>
                        <div>
                            <?php
                            foreach ($usertype as $type) {

                                    ?>
                                <input type="checkbox" name="chat_report_msg[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['chat_report_msg'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                <?php
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('chat_report_msg', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('chat_report_msg',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                  
                        <label><strong>ساکت شدن هوشمند کاربر توسط ربات:</strong><small><a href="javascript:smart();">[توضیحات]</a></small></label>
                        <div>
                            <?php
                            $admins = array(1, 2, 3);
                            foreach ($usertype as $type) {
                                if (!in_array($type['admin'], $admins)) {
                                    ?>
                                    <input type="checkbox" name="UsersForBann[]" value="<?php echo($type['id']); ?>" <?php if (in_array($type['id'], (array) $useroptions['UsersForBann'])) echo('checked'); ?> /> <?php echo($type['title']); ?>
                                    <?php
                                }
                            }
                            ?>
                            <br>
                            <a style="color:red;cursor:pointer; " onClick="select_all('UsersForBann', '1');">انتخاب همه</a> | <a style="color:red;cursor:pointer; "  onClick="select_all('UsersForBann',
                                            '0');">
                                لغو انتخاب همه</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>تعداد دفعات تکرار کلمات مورد دار برای خفه شدن:</strong></label>
                        <div><input type="text" name="repeat_robo_silent" value="<?php echo($options['repeat_robo_silent']); ?>"  class="required" /></div>
                    </div>
                    <div class="row">
                        <label><strong>مدت زمان خفه شدن توسط ربات به دقیقه:</strong></label>
                        <div><input type="text" name="silent_time_robo" class="required" value="<?php echo ($options['silent_time_robo']);?>"/></div>
                    </div>
                </div>
            </form>
        </div>
        <center><medium style="color:red">پس از ویرایش ممکن است به طور طبیعی حدودا یک دقیقه اعمال تغییرات طول بکشد</medium><br><button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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