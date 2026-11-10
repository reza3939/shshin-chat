<?php
include('header.php');
include('sidebar.php');
$perm_send_file = json_decode($options['perm_send_file'], true);
$mod_protect = json_decode($options['mod_protect'], true);
$options['thumbavatarSize'] = str_replace(array('*','x'),'*',$options['avataromomi']);
$options['winsize'] = str_replace(array('*','x'),'*',$options['winsize']);
list($width_avatar, $height_avatar) = explode("*", $options['avataromomi']);

if(db::num('chatfonts') != '0'){
$query = db::query("select `id`,`name` from ahyir_chatfonts ORDER BY `id`  DESC");
while ($fonts = mysqli_fetch_array($query)) {
    $font_family = array('BYekan', 'BMorvarid', 'BNarm', 'BZiba', 'BKoodak', 'BSina', 'BTitr', 'BSinaBold', 'BBadr', 'BBaran', 'BBardiya', 'BElham', 'BLotus', 'BNazanin', 'BZar', 'Yekp', 'myriadarabicregular', 'dinarm', 'Mj Baseet', 'Rezvan', 'AGoogle', 'tahoma', $fonts['name']);
}
mysqli_free_result($query);
} else {
	    $font_family = array('BYekan', 'BMorvarid', 'BNarm', 'BZiba', 'BKoodak', 'BSina', 'BTitr', 'BSinaBold', 'BBadr', 'BBaran', 'BBardiya', 'BElham', 'BLotus', 'BNazanin', 'BZar', 'Yekp', 'myriadarabicregular', 'dinarm', 'Mj Baseet', 'Rezvan', 'AGoogle', 'tahoma');
}
?>
<style>
    .cpicker{
        display: inline-block;
        width: 25px !important;
    }
</style>
<script type="text/javascript">

    function edit() {
        var $form = $('#formeditsettings');
        var $defaultcolor = $('input[name=defaultcolor]', $form);
        $defaultcolor.val(rgb2hex($('.color', $defaultcolor.parent()).css('background-color')));

        var $systemcolor = $('input[name=systemcolor]', $form);
        $systemcolor.val(rgb2hex($('.color', $systemcolor.parent()).css('background-color')));

        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.settings.defualts')); ?>",
            data: $form.serialize(),
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
    var hexDigits = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f");

    function rgb2hex(rgb) {
        rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }
    function hex(x) {
        return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
    }
    function info_idle() {
        $("#info_idle").dialog('open');
    }
    function info_ban_time_robo() {
        $("#info_ban_time_robo").dialog('open');
    }
    function info_tabligh_reporter() {
        $("#info_tabligh_reporter").dialog('open');
    }
    function info_buyscore_code() {
        $("#info_buyscore_code").dialog('open');
    }
    function info_report_user() {
        $("#info_report_user").dialog('open');
    }
    function info_idle_system() {
        $("#info_idle_system").dialog('open');
    }
    function info_security_question() {
        $("#info_security_question").dialog('open');
    }
    function info_deallow_country() {
        $("#info_deallow_country").dialog('open');
    }
    function closediv() {
        $('#msgdiv').slideUp(1000);
    }
    $(document).ready(function () {
        $('#buyscore_code').css('display', 'none');

        var $thumbavatar = $('#thumbavatar').prop('checked');
        if ($thumbavatar == true) {
            $('#thumbavatarSizediv').slideDown(1000);
        } else {
            $('#thumbavatarSizediv').slideUp(1000);
        }
        $('.checkbox').click(function () {
            $thumbavatar = $('#thumbavatar').prop('checked');
            if ($thumbavatar == true) {
                $('#thumbavatarSizediv').slideDown(1000);
            } else {
                $('#thumbavatarSizediv').slideUp(1000);
            }

        });
        var $buyscore = $('#buyscorelocal').prop('checked');
        if($buyscore == true){
        $('#msgdiv').slideDown(1000);
        }else{
        $('#msgdiv').slideUp(1000);
        }
	$('#buyscorelocal').click(function(){
        $buyscore = $(this).val();
        if($buyscore == true){
            $('#msgdiv').slideDown(1000);
        }
        });
        var $shoavataronlist = $('#shoavataronlist').prop('checked');
        if ($shoavataronlist == true) {
            $('#avataronlinediv').slideDown(1000);
        } else {
            $('#avataronlinediv').slideUp(1000);
        }
        $('.checkbox').click(function () {
            $shoavataronlist = $('#shoavataronlist').prop('checked');
            if ($shoavataronlist == true) {
                $('#avataronlinediv').slideDown(1000);
            } else {
                $('#avataronlinediv').slideUp(1000);
            }

        });
        var $noekhrajer = $('#noekhrajer').prop('checked');
        if ($noekhrajer == true) {
            $('#ekhrajernamediv').slideDown(1000);
        } else {
            $('#ekhrajernamediv').slideUp(1000);
        }
        $('.checkbox').click(function () {
            $noekhrajer = $('#noekhrajer').prop('checked');
            if ($noekhrajer == true) {
                $('#ekhrajernamediv').slideDown(1000);
            } else {
                $('#ekhrajernamediv').slideUp(1000);
            }

        });
     var $nodalil = $('#nodalil').prop('checked');
        if ($nodalil == true) {
            $('#dalildiv').slideDown(1000);
        } else {
            $('#dalildiv').slideUp(1000);
        }
        $('.checkbox').click(function () {
            $nodalil = $('#nodalil').prop('checked');
            if ($nodalil == true) {
                $('#dalildiv').slideDown(1000);
            } else {
                $('#dalildiv').slideUp(1000);
            }

        });
        $("#info_idle").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
        $("#info_ban_time_robo").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
        $("#info_tabligh_reporter").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
        $("#info_buyscore_code").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
        $("#info_report_user").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
        $("#info_idle_system").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
        $("#info_security_question").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });


    });

    $(document).ready(function () {
        $("#typeloadd1,#typeloadd2,#banned1,#silent1,#rename1,#secure2,#secure1").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
        $('#typeloadi1').click(function () {
            $("#typeloadd1").dialog("open");
        });
        $('#bannedo1').click(function () {
            $("#banned1").dialog("open");
        });
        $('#silento1').click(function () {
            $("#silent1").dialog("open");
        });
        $('#renameo1').click(function () {
            $("#rename1").dialog("open");
        });
        $('#secureo2').click(function () {
            $("#secure2").dialog("open");
        });
        $('#secureo1').click(function () {
            $("#secure1").dialog("open");
        });
        $('#typeloadi2').click(function () {
            $("#typeloadd2").dialog("open");
        });
    });
   function info_top_msgnum() {
        $("#info_top_msgnum").dialog('open');
    }
    $(document).ready(function () {
        $("#info_top_msgnum").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });

 function info_top_stm() {
        $("#info_top_stm").dialog('open');
    }
    $(document).ready(function () {
        $("#info_top_stm").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: [{text: "متوجه شدم", click: function () {
                        $(this).dialog("close");
                    }}]
        });
    });
</script>
<div style="display: none;" id="info_top_msgnum" title="راهنمای تنظیمات این سیستم">
    <p>در صورت فعال بودن این سیستم پیام کاربر فرستنده سمت راست و  گیرنده سمت چپ قرار خواهد گرفت به سبک تلگرام  </p>
</div>
<div style="display: none;" id="info_top_stm" title="راهنمای تنظیمات این سیستم">
    <p>در صورت فعال بودن این سیستم امکانات بالای عمومی (رفرش کردن,راست چین و چپ چین کردن پیام ها,عدم نمایش لیست ,عدم نمایش عمومی)نمایش داده نخواهد شد   </p>
</div>

<div style="display: none;" id="info_idle" title="راهنمای تنظیمات این سیستم">
    <p>مثلا اگر شما مدت زمان را 2 دقیقه قرار بدهید . کاربر اگر بیشتر از 2 دقیقه در چت روم ( عمومی یا خصوصی ) به کسی پیام ندهد وضعیت وی پشت سیستم نیست اعلام خواهد شد</p>
</div>
<div style="display: none;" id="info_ban_time_robo" title="راهنمای تنظیمات این سیستم">
    <p>مثلا اگر شما در سیستم کلمات زشت کلمه چت را فیلتر کنید و تیک اخراج اتوماتیک را بزنید وقتی کاربری در خصوصی این کلمه را استفاده کند سیستم فورا شناسایی کرده و به مدت دقیقه ای که در اینجا وارد میکنید کاربر را از چت روم اخراج میکند</p>
</div>
<div style="display: none;" id="info_tabligh_reporter" title="راهنمای تنظیمات این سیستم">
    <p>مثلا اگر شما در سیستم کلمات زشت کلمه چت را فیلتر کنید و تیک گزارش تبلیغ را بزنید اگر کاربری در خصوصی این کلمه را استفاده کند سیستم فورا شناسایی کرده و اسم کاربر ارسال کننده این کلمه و کاربر دریافت کننده را به مدیران و ناظران آنلاین در چت روم خواهد فرستاد</p>
</div>
<div style="display: none;" id="info_buyscore_code" title="راهنمای تنظیمات این سیستم">
    <p>برای استفاده از این سیستم ابتدا در سایت <a href="https://www.zarinpal.com/" target="_blank">www.zarinpal.com</a> عضو شوید و در اینجا ابتدا با زدن تیک ( بله مرچنت کد زرین پال دارم) و سپس در کادر مرچنت کد زرین پال من , مرچنت کد خود را وارد کنید <br /> در غیر این صورت با زدن تیک (به حساب کاربری من در مهر طرح اضافه شود)  هر کاربری هر مقدار امتیازی خرید کند 2% کسر (بخاطر کسر کارمزد موقع تسویه حساب در زرین پال) و مابقی به موجودی  حساب شما در مهر طرح اضافه خواهد شد</p>
</div>
<div style="display: none;" id="info_report_user" title="راهنمای تنظیمات این سیستم">
    <p>اگر این سیستم را فعال بذارید کاربران میتواند از طریق سیستم ارسال گزارش در خصوصی ، گزارش های خود را از کاربران برای مدیران آنلاین بفرستند</p>
</div>
<div style="display: none;" id="info_idle_system" title="راهنمای تنظیمات این سیستم">
    <p>با فعال شدن این سیستم کاربر میتواند در خصوصی از گزینه برسی وضعیت استفاده کرده و  اطلاعات فردی کاربر مورد نظر را ببیند از قبیل: در حال مکالمه است یا خیر - امتیاز وی - نام نمایشی و ...</p>
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
                    <h2>تنظیمات پیشفرض</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>رنگ پیشفرض متون:</strong></label>
                        <div><input type="color" name="defaultcolor" value="#<?php echo($options['chat_defaultcolor']); ?>" /></div>
                    </div>
                    <div class="row">
                        <label><strong>فونت پیشفرض متون:</strong></label>
                        <div><select name="defaultfontname" class="search">
                                <?php
                                foreach ($font_family as $font) {
                                    ?>
                                    <option value="<?php echo($font); ?>" <?php if ($options['chat_defaultfontname'] == $font) echo(' selected'); ?>><?php echo($font); ?></option>
                                    <?php
                                }
                                ?>
                            </select></div>
                    </div>
                    <div class="row">
                        <label><strong>سایز فونت پیشفرض متون:</strong></label>
                        <div><input type="text" name="defaultfontsize" value="<?php echo($options['chat_defaultfontsize']); ?>" /></div>
                    </div>
                    <div class="row">
                        <label><strong>حداکثر کارکتر های پیام:</strong></label>
                        <div><input type="text"  pattern="^\d{1,10}$" name="maxlengthmsg" value="<?php echo($options['chat_maxlengthmsg']); ?>" style="width: 100px;text-align: center;" class="required" />
                        <span style="color:red;"> جهت عدم مشکل در ارسال عکس و اهنگ حداقل 200 کاراکتر باشد</span>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>حداکثر کارکتر های نام:</strong></label>
                        <div><input type="text"  pattern="^\d{1,10}$" name="maxlengthname" value="<?php echo($options['chat_maxlengthname']); ?>" style="width: 100px;text-align: center;" class="required" /></div>
                    </div>

                    <div class="row">
                        <label><strong>نام کاربر سیستم:</strong></label>
                        <div><input type="text"  name="systemname" value="<?php echo($options['chat_systemname']); ?>" class="required" /></div>
                    </div>
                    <div class="row">
                        <label><strong>رنگ متون سیستم:</strong></label>
                        <div><input type="color" name="systemcolor" value="#<?php echo($options['chat_systemcolor']); ?>" /></div>
                    </div>
                    <div class="row">
                        <label><strong>مکان پیام سیستم:</strong></label>
                        <div><select name="systeminto" class="search"><option value="main" <?php if ($options['chat_systeminto'] == 'main') echo('checked'); ?>>عمومی</option><option value="pm" <?php if ($options['chat_systeminto'] == 'pm') echo('checked'); ?>>خصوصی</option></select></div>
                    </div>
                    <div class="row">
                        <label><strong>عمر تاریخچه:</strong></label>
                        <div><input type="text" pattern="^\d{1,10}$" name="historytime" value="<?php echo($options['chat_historytime']); ?>" style="width: 100px;text-align: center;" class="required" /> ثانیه</div>
                    </div>
                    <div class="row">
                        <label><strong>ناظر شدن توسط سیستم امتیازدهی:</strong></label>
                        <div><input type="checkbox" value="1" name="automod" <?php if ($options['automod'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>نمایش عکس در کنار پیام:</strong></label>
                        <div>
                            <input type="checkbox" value="1" id="thumbavatar" name="thumbavatar" <?php if ($options['thumbavatar']) echo('checked'); ?> />بلی
                            <div id="thumbavatarSizediv">
                                <input type="text" name="thumbavatarSize"  pattern="^(\d{1,10})x(\d{1,10})$" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo(str_replace('*', 'x', $options['avataromomi'])); ?>" />
                            </div>
                        </div>
                    </div>
                    
					<div class="row">
                        <label><strong>نمایش اواتار در لیست انلاین : </strong> </label>
                        <div>
						    <input type="checkbox" name="shoavataronlist" id="shoavataronlist" value="1" <?php if ($options['shoavataronlist'] == 'true') echo('checked'); ?>  />بلی
							<div id="avataronlinediv">
                                <input type="text" name="avatarOnline"  pattern="^(\d{1,10})x(\d{1,10})$" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo(str_replace('*', 'x', $options['avatarOnline'])); ?>" />
                            </div>
						</div>
                    </div> 
 <div class="row">
                        <label><strong>سایز پنجره خصوصی:</strong><small style="color:red;">توصیه می شود عدد رقم سمت چپ که ارتفاع پنجره خصوصی می باشد تغییر نکند</small></label>
                        <div>
                                <input type="text" name="winsize"  pattern="^(\d{1,10})x(\d{1,10})$" style="padding-left: 0px;width:180px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo(str_replace('*', 'x', $options['winsize'])); ?>" />
                            </div>

                    </div>
                     	<div class="row">
                        <label><strong>نمایش نام اخراج کننده در صفحه اخراج : </strong> </label>
                        <div>
						    <input type="checkbox" name="noekhrajer" id="noekhrajer" value="1" <?php if ($options['noekhrajer'] == 'true') echo('checked'); ?>  />خیر
							<div id="ekhrajernamediv">
                                <input type="text" name="ekhrajername" pattern="^(\d{1,10})x(\d{1,10})$" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo($options['ekhrajername']); ?>" />نام پیشفرض  را وارد کنید
                            </div>
						</div>
                    </div> 
<div class="row">
                        <label><strong>نمایش دلیل اخراج در صفحه اخراج : </strong> </label>
                        <div>
						    <input type="checkbox" name="nodalil" id="nodalil"   value="1" <?php if ($options['nodalil'] == 'true') echo('checked'); ?>  />خیر
							<div id="dalildiv">
                                <input type="text" name="dalil"     style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo $options['dalil']; ?>" />دلیل پیشفرض را وارد کنید
                            </div>
						</div>
                    </div> 
                    <div class="row">
                        <label><strong>نوع امتیازدهی:</strong></label>
                        <div><select name="getscoretype" class="search"><option value="login" <?php if ($options['getscoretype'] == 'login') echo('selected'); ?>>هنگام ورود و خروج</option><option value="ajax" <?php if ($options['getscoretype'] == 'ajax') echo('selected'); ?>>در لحظه و پویا</option></select></div>
                    </div>
                    <div class="row">
                        <label><strong>تصویر پیشفرض پروفایل:</strong></label>
                        <div><input type="text" name="defaultavatar"  style="padding-left: 25px;direction: ltr;font-family: sans-serif;" class="required" value="<?php echo $options['defaultavatar'] ?>"/></div>
                    </div>
                    <div class="row">
                        <label><strong>پیشوند شکلک ها:</strong></label>
                        <div><input type="text" name="prefixsmlies"  style="padding-left: 25px;direction: ltr;font-family: sans-serif;" class="required" value="<?php echo $options['prefixsmlies'] ?>"/></div>
                    </div>
                    <div class="row">
                        <label><strong>گزینه ثبت نام در بالای لیست:</strong></label>
                        <div><input type="checkbox" value="1" name="registerbtn" <?php if ($options['registerbtn'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>رنگی بودن لیست آنلاین ها:</strong></label>
                        <div><input type="checkbox" value="1" name="colorlistonline" <?php if ($options['colorlistonline'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>تبادل لینک اتوماتیک:</strong></label>
                        <div><input type="checkbox" value="1" name="autolinker" <?php if ($options['autolinker'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>ساعت کنار متون در عمومی:</strong></label>
                        <div><input type="checkbox" value="1" name="timemsg" <?php if ($options['timemsg'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>ساعت کنار متون در خصوصی:</strong></label>
                        <div><input type="checkbox" value="1" name="timemsgpv" <?php if ($options['timemsgpv'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
  <div class="row">
                        <label><strong>نمایش ساعت و تاریخ در کادر خوش آمدگویی:</strong></label>
                        <div><input type="checkbox" value="1" name="date_time" <?php if ($options['date_time'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
  <div class="row">
                        <label><strong>نمایش گزینه های کادر خوش آمدگویی:</strong></label>
                        <div><input type="checkbox" value="1" name="show_msgs" <?php if ($options['show_msgs'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
  <div class="row">
                        <label><strong>فعال بودن لینکدونی :</strong></label>
                        <div><input type="checkbox" value="1" name="linkdooni" <?php if ($options['linkdooni'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
  <div class="row">
                        <label><strong>شطرنجی کردن عکس های ارسالی در صفحه چت روم :</strong><small>عکس های ارسالی در خصوصی و عمومی به صورت شطرنجی دیده می شود</small></label>
                        <div><input type="checkbox" value="1" name="blur" <?php if ($options['blur'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
  <div class="row">
                      <label><strong>کادر دور پیام فعال باشد:</strong><small> پیام ها داخل کادر قرار خواهند گرفت</small></label>
                        <div><input type="checkbox" value="1" name="kadr_myself" <?php if ($options['kadr_myself'] == 'true') echo('checked'); ?> >بلی</div>
                    </div>
					<div class="row">
						<label><strong>دو کاربر با یک آی پی:</strong><small>با غیر فعال شدن این گزینه امکان ورود به چت روم با دو مرورگر وجود ندارد</small></label>
						<div><input type="checkbox" value="1" name="1ip2user" <?php
if ($options['1ip2user'] == 'true') {
	echo 'checked';
}
?> />بلی</div>
					</div>
                    <div class="row">
                        <label><strong>ورود با فیلترشکن،آیپی فاکر:</strong></label>
                        <div><input type="checkbox" value="1" name="ipfucker" <?php if ($options['ipfucker'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
<!--
                    <div class="row">
                        <label><strong>ثبت نام پیشرفته:</strong></label>
                        <div><input type="checkbox" value="1" name="advcreg" <?php if($options['advcreg'] == '1')echo('checked');?> />بلی</div>
                    </div>
-->
                    <div class="row">
                        <label><strong>فعال کردن صفحه تماس با ما ( /contact )  :</strong><small>با فعال شدن این گزینه امکان ارسال نامه توسط کاربران غیرفعال می شود</small></label>
                        <div><input type="checkbox" value="1" name="contact" <?php if ($options['contact'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>امکان ارسال تصویر:</strong></label>
                        <div>
                            <input type="checkbox" value="1" id="allow_image" name="allow_image" <?php if ($options['allow_image']) echo('checked'); ?> />بلی
                            <div>
                                <input type="text" name="image_score" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo $options['image_score']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>امکان ارسال لینک:</strong></label>
                        <div>
                            <input type="checkbox" value="1" id="allow_url" name="allow_url" <?php if ($options['allow_url']) echo('checked'); ?> />بلی
                            <div>
                                <input type="text" name="url_score" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo $options['url_score']; ?>" />
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <label><strong>سیستم خرید امتیاز فعال باشد:</strong></label>
                        <div>
							 <input type="checkbox" value="1" id="buyscore_status" name="buyscore_status" <?php if($options['buyscore_status'])echo('checked');?> />بلی
						</div>
                    </div>
                    <div class="row">
                        <label><strong>خرید امتیاز (شناسه بازپرداخت):</strong><small><a href="javascript:info_buyscore_code();">[توضیحات]</a></small></label>
                        <div>
                            <input type="checkbox" value="1" id="buyscore" name="buyscore" <?php if(is_numeric($options['buyscore_code']))echo('checked="checked"');?> /> بلی شناسه باز پرداخت دارم
                            <div>
                                <input type="text" name="buyscore_code" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php if($options[''] != '59942651') echo $options['buyscore_code']; ?>" /> شناسه باز پرداخت من<br />
                            </div>
								<input type="checkbox" value="1" id="in_nilitarh" name="in_nilitarh" <?php if($options['buyscore_code'] == '59942651')echo('checked="checked"');?> /> به حساب کاربری من در مهر طرح اضافه شود
                        </div>
                    </div>
					<div class="row">
                        <label><strong>حداقل خرید امتیاز چقدر باشد:</strong></label>
						<div>
							<div>
								<input type="text" name="buyscore_amount" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo $options['buyscore_amount']; ?>" /> تومان
							</div>
						</div>
                    </div>
                    <div class="row">
                        <label><strong>افزایش موجودی بانک با حضور (یک امتیاز به ازای تایم انتخابی):</strong></label>
                        <div>
                            <input type="checkbox" value="1" id="update_bank" name="update_bank" <?php if ($options['update_bank']) echo('checked'); ?> />بلی
                            <div>
                                <input type="text" name="time_bank" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo $options['time_bank']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>قیمت هر امتیاز بانک:</strong></label>
                        <div>
                            <div>
                                <input type="text" name="pay_bank" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" value="<?php echo $options['pay_bank']; ?>" /> تومان
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>سه باکس فعال باشد:</strong></label>
                        <div><input type="checkbox" value="1" name="box3" <?php if ($options['box3'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>					
                    <div class="row">
                        <label><strong>اخبار چت روم فعال باشد:</strong></label>
                        <div><input type="checkbox" value="1" name="chatnews" <?php if ($options['chatnews'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>			
                    <div class="row">
                        <label><strong>ارسال عکس و فایل در خصوصی فعال باشد:</strong></label>
                        <div><input type="checkbox" value="1" name="allow_sendfile_in_private" <?php if ($options['allow_sendfile_in_private'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>سیستم ارسال گزارش در خصوصی فعال باشد:</strong><small><a href="javascript:info_report_user();">[توضیحات]</a></small></label>
                        <div><input type="checkbox" value="1" name="report_user" <?php if ($options['report_user'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>سیستم امنیتی گزارش تبلیغ در خصوصی فعال باشد:</strong><small><a href="javascript:info_tabligh_reporter();">[توضیحات]</a></small></label>
                        <div><input type="checkbox" value="1" name="tabligh_reporter" <?php if ($options['tabligh_reporter'] == '1') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>اخراج اتوماتیک توسط ربات فعال باشد:</strong></label>
                        <div><input type="checkbox" value="1" name="robo_bann" <?php if ($options['robo_bann'] == '1') echo('checked'); ?> />بلی</div>
                    </div>
					<div class="row">
                        <label><strong>مدت زمان اخراج شدن توسط ربات به دقیقه:</strong><small><a href="javascript:info_ban_time_robo();">[توضیحات]</a></small></label>
                        <div>
							<div>
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="ban_time_robo" value="<?php echo($options['ban_time_robo']); ?>" /> دقیقه 
							</div>
						</div>
					</div>
                    <div class="row">
                        <label><strong>بررسی وضعیت کاربر در خصوصی فعال باشد:</strong><small><a href="javascript:info_idle_system();">[توضیحات]</a></small></label>
                        <div><input type="checkbox" value="1" name="check_status_system_private" <?php if ($options['check_status_system_private'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>	
                  
                    <div class="row">
                        <label><strong>بررسی وضعیت کاربر در خصوصی به دقیقه:</strong><small><a href="javascript:info_idle();">[توضیحات]</a></small></label>
                        <div>
                            <div>
                                <input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="check_idle" value="<?php echo($options['check_idle']); ?>" /> دقیقه
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>حداکثر تعداد دعوت کاربران به اتاق کنفرانس:</strong><small></small></label>
                        <?php $capacity_cf = json_decode($options['capacity_cf'], true); ?>
                        <div>
                            <div>
                                <input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="capacity_cf_admins" value="<?php echo($capacity_cf['admins']); ?>" />(نفر) گروه کاربرانی که دسترسی مدیریت دارند مثل مدیران - ناظرین - معاونین...
                            </div>
                        </div> 
                        <div>
                            <div>
                                <input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="capacity_cf_users" value="<?php echo($capacity_cf['users']); ?>" />(نفر) گروه کاربرانی که دسترسی مدیریت ندارند مثل سرپرست - ارشد - فعال...
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال فعالیت مدیران و ناظران در پنل مدیریت به خصوصی:</strong></label>
                        <div><input type="checkbox" value="1" name="send_activity2private_admins" <?php if ($options['send_activity2private_admins'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال نامه از طریق ارتباط با ما به خصوصی مدیر:</strong></label>
                        <div><input type="checkbox" value="1" name="send_letters2private_admin" <?php if ($options['send_letters2private_admin'] == 'true') echo('checked'); ?> />بلی</div>
                    </div>
<!--
                  <div class="row">
                        <label><strong>سیستم خرید درجه فعال باشد:</strong></label>
                        <div>
                            <input type="checkbox" value="1" name="buy_type" <?php if ($options['buy_type'] == '1') echo('checked'); ?> />بلی
                        </div>
                    </div>
-->
                     <div class="row">
                        <label><strong>سیستم خرید اتاق:</strong><small></small></label>
                        <?php $buy_room = json_decode($options['buy_room'], true); ?>
                        <div>
                            <input type="checkbox" value="1" name="buy_room" <?php if ($buy_room['buy_room'] == '1') echo('checked'); ?> />سیستم خرید اتاق فعال باشد
                        </div>
                        <div>
                            <div>
                                <input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="buy_room_score_for_admin" value="<?php echo($buy_room['score_for_admin']); ?>" />(امتیاز) خرید اتاق با دسترسی مدیریت در همان اتاق
                            </div>
                        </div> 
                        <div>
                            <div>
                                <input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="buy_room_score" value="<?php echo($buy_room['score']); ?>" />(امتیاز) خرید اتاق بدون دسترسی مدیریت
                            </div>
                        </div>
                    </div>
                    	<div class="row">
                        <label><strong>تعداد دفعات تکرار کلمات مورد دار برای اخراج:</strong><small>0 = بدون تکرار</small></label>
                        <div>
							<div>
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="repeat_robo_bann" value="<?php echo($options['repeat_robo_bann']); ?>" /> 
							</div>
						</div>
					</div>
                    <div class="row">
                        <label><strong>نمایش زمان بیکار بودن کاربران در لیست آنلاین:</strong></label>
                        <div>
                            <input type="checkbox" value="1" name="show_idleTime_onlinelist" <?php if ($options['show_idleTime_onlinelist'] == 'true') echo('checked'); ?> />بلی
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>نمایش سیستم عامل کاربران در لیست آنلاین:</strong></label>
                        <div>
                            <input type="checkbox" value="1" name="show_userOs" <?php if ($options['show_userOs'] == 'true') echo('checked'); ?> />بلی
                        </div>
                    </div>
<!--
                    <div class="row">
                        <label><strong>چت صوتی تصویری:</strong></label>
                        <div>
                            <input type="checkbox" value="1" name="videochat" <?php if ($options['videochat'] == 'true') echo('checked'); ?> />بلی
                        </div>
                    </div>
-->
                    <div class="row">
                        <label><strong>ارسال مطلب در پروفایل:</strong></label>
                        <div>
                            <input type="checkbox" value="1" name="send_post_inprofile" <?php if ($options['send_post_inprofile'] == 'true') echo('checked'); ?> />بلی
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ارسال نظر در پروفایل:</strong></label>
                        <div>
                            <input type="checkbox" value="1" name="send_comment_inprofile" <?php if ($options['send_comment_inprofile'] == 'true') echo('checked'); ?> />بلی
                        </div>
                    </div>	
                    <div class="row">
                        <label><strong>لایک و دیسلایک در پروفایل:</strong></label>
                        <div>
                            <input type="checkbox" value="1" name="ld_inprofile" <?php if ($options['ld_inprofile'] == 'true') echo('checked'); ?> />بلی
                        </div>
                    </div>	
              
                    <div class="row">
                        <label><strong>حداقل امتیاز لازم برای لایک و دیسلایک:</strong><small>0 = فرقی نمیکند</small></label>
                        <div>
                            <div>
                                <input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="ld_score" value="<?php echo($options['ld_score']); ?>" /> امتیاز
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>حداقل امتیاز لازم برای انتقال امتیاز :</strong></label>
                        <div>
                            <div>
                                <input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="scoretosendscore" value="<?php echo($options['scoretosendscore']); ?>" /> امتیاز
                            </div>
                        </div>
                    </div>
                  
                    <div class="row">
                        <label><strong>قیمت هر امتیاز بانکی (( امتیاز معمولی )):</strong></label>
                        <div><input type="text"  name="add_bank" value="<?php echo($options['add_bank']); ?>" class="required"></div>
                    </div>
                    <div class="row">
                        <label><strong>امکان ارسال موزیک:</strong></label>
                        <div>
                            <input type="checkbox" value="1" id="allow_send_music" name="allow_send_music" <?php if ($options['allow_send_music'] == 'true') echo('checked'); ?> />بلی
                            <label><strong>امتیاز لازم برای ارسال موزیک:</strong></label>
                            <div>
                                <input type="text" name="music_score" style="padding-left: 0px;direction: ltr;text-align: center;" value="<?php echo $options['music_score']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>امکان ارسال فیلم:</strong></label>
                        <div>
                            <input type="checkbox" value="1" id="allow_send_film" name="allow_send_film" <?php if ($options['allow_send_film'] == 'true') echo('checked'); ?> />بلی
                            <label><strong>امتیاز لازم برای ارسال فیلم:</strong></label>
                            <div>
                                <input type="text" name="film_score" style="padding-left: 0px;direction: ltr;text-align: center;" value="<?php echo $options['film_score']; ?>" />
                            </div>
                        </div>
                    </div>

<div class="row">
                        <label><strong>رمز تغییر نام و اخراج و خفه کردن کاربر برای مدیران و ناظران:</strong><small></small></label>
				
						<div>
							 <input type="checkbox" value="1" name="mod_protect" <?php if($mod_protect['status'] == '1')echo('checked');?> />بلي
						</div>
                        <div>
							<div>
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="mod_protect_pw" value="<?php echo($mod_protect['pw']); ?>" /> کلمه عبور
							</div>
						</div> 
                    </div>

<div class="row">
                        <label><strong>حداکثر تعداد شکلک های شخصی :</strong></label>
                        <div>
							<div>
								<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="num_smileuser" value="<?php echo($options['num_smileuser']); ?>" /> شکلک
							</div>
          </div></div>
                    <div class="row">
                        <label><strong>تغییر استایل اتاق ها :</strong> <small> (نمایش تعداد کاربر انلاین برروی هر اتاق)</small></label>
                        <div><input type="checkbox" name="roomstyle" value="1" <?php if ($options['roomstyle'] == 'true') echo('checked'); ?>  />بلی</div>
                    </div>
  
                    <div class="row">
                        <label><strong>نمایش موزیک پلیر:</strong> </label>
                        <div><input type="checkbox" name="showPlayer" value="1" <?php if ($options['showPlayer'] == 'true') echo('checked'); ?>  />بلی</div>
                    </div>       
                   
                    <div class="row">
                        <label><strong>تشخیص اتوماتیک نسخه موبایل و انتقال خودکار به ان :</strong> </label>
                        <div><input type="checkbox" name="mobiledetect" value="1" <?php if ($options['mobiledetect'] == 'true') echo('checked'); ?>  />بلی</div>
                    </div>
                    
                    <div class="row">
                        <label><strong>نمایش مرورگر کاربران در لیست:</strong></label>
                        <div><input type="checkbox" value="1" name="showubrowseronlist" <?php if ($options['showubrowseronlist'] == 'true') echo('checked'); ?> >بلی</div>
                    </div>
 <div class="row">
                        <label><strong>نمایش امکانات بالای عمومی :</strong><small><a href="javascript:info_top_stm();">[توضیحات]</a> </small></label>
                        <div><input type="checkbox" value="1" name="stm" <?php if ($options['stm'] == 'true') echo('checked'); ?> >بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>نمایش پیام افلاین به صورت اتوماتیک :</strong></label>
                        <div><input type="checkbox" value="1" name="offmsgautoshow" <?php if ($options['offmsgautoshow'] == 'true') echo('checked'); ?> >بلی</div>
                    </div>
	 <div class="row">
                        <label><strong>فعال بودن قابلیت تغییر فونت 7 تایی در خصوصی و عمومی :</strong> </label>
                        <div><input type="checkbox" name="enablechatfont" value="1" <?php if ($options['enablechatfont'] == 'true') echo('checked'); ?>  />بلی</div>
                    </div
 </div>
            
                    <div class="row">
                        <label><strong>فونت نام کاربران در لیست انلاین :</strong></label>
                        <div><select name="fontlist" class="search">
                                <?php
                                foreach ($font_family as $font) {
                                    ?>
                                    <option value="<?php echo($font); ?>" <?php if ($options['fontlist'] == $font) echo(' selected'); ?>><?php echo($font); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>                    
                    </div>
                    <div class="row">
                        <label><strong>افکت نمایش عنوان ایکون ها : </strong></label>
                        <div><input type="checkbox" value="1" name="titleefect" <?php if ($options['titleefect'] == 'true') echo('checked'); ?> >بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>درخواست چت خصوصی : </strong></label>
                        <div><input type="checkbox" value="1" name="allowchat" <?php if ($options['allowchat'] == 'true') echo('checked'); ?> >بلی</div>
                    </div>

                     
                        <div class="row">
                        <label><strong>تعداد ارسال فایل در 1 دقیقه :</strong><small></small></label>
                        <div><input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  name="psf_numdat" value="<?php echo($perm_send_file['numdat']) ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>امتیاز لازم برای ارسال فایل:</strong></label>
                        <div><input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"   name="psf_score" value="<?php echo($perm_send_file['score']) ?>"/>
                        </div>
                    </div>
                   <div class="row">
                        <label><strong>کسر امتیاز برای ارسال فایل:</strong></label>
                        <div><input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  name="psf_zscore" value="<?php echo($perm_send_file['zscore']) ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ریپورت کاربران موقع مسدود شدن</strong></label>
                        <div><input <?php if ($options['reportBlock_user'] == 'true') echo('checked'); ?> type="checkbox" name="reportBlock_user" style="padding-left: 25px;direction: ltr;" class="required">بلی</div>
                    </div>
                    <div class="row">
                        <label><strong>دفعات ریپورت کاربر  برای مسدود شدن</strong></label>
                        <div><input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  value="<?=$options['reportBlock_user_num']?>" name="reportBlock_user_num"></div>
                    </div>
                   <div class="row">
                        <label><strong>مدت زمان ریپورت بودن کاربر</strong></label>
                        <div><input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  value="<?=$options['reportBlock_user_time']?>" name="reportBlock_user_time" > روز</div>
                    </div>
                    <div class="row">
                        <label><strong>مقدار امتیاز برای گزارش دهنده</strong></label>
                        <div><input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  value="<?=$options['report_score']?>" name="report_score"  > امتیاز</div>
                    </div>
              <div class="row">
                        <label><strong>زمان پیشفرض اخراج کاربر</strong></label>
                        <div><input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;"  value="<?=$options['bann_defualttime']?>" name="bann_defualttime" > دقیقه</div>
                    </div>
                   <div class="row">
                        <label><strong>کسرامتیاز هنگام بستن ارسال گزارش </strong></label>
                        <div>
<input type="text" style="padding-left: 0px;direction: ltr;font-family: sans-serif;text-align: center;" name="score_report" value="<?php echo($options['score_report']); ?>" />امتیاز </div>
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