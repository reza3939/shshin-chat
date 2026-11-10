<?php

class adminpanel {

    public static $Permissions = array(
        'letters' => 'نامه ها',
        'delletters' => 'نامه ها - حذف نامه ها',
        'replayletters' => 'نامه ها - پاسخ به نامه ها',
        'users' => 'کاربران',
        'wlcchat' => 'تنظیمات - تنظیمات پنجره خوش آمدگوی داخل',
        'wlclogin' => 'تنظیمات - تنظیمات پنجره خوش آمدگوی بیرون',
        'cmdsettings' => 'تنظیمات - تنظیمات دستورات',
        'logs' => 'رصدخانه',
        'analyzer' => 'آمارها - آنالیزگر',
        'statss' => 'آمارها - آمار کلی',
        'statslist' => 'آمارها - ریز آمار',
        'statsanalyzer' => 'آمارها - آمار تحلیلی',
        'rollcall' => 'حضور و غیاب',
        'avatar' => 'رصدخانه - لیست اواتارها',
        'avatars' => 'آواتار های پیشفرض',
        'cover' => 'رصدخانه - لیست جلدها',
        'profile' => 'رصدخانه - لیست مطلب ها',
        'logon' => 'رصدخانه - فعالیت های داخل چت روم',
        'pmwlc' => 'تنظیمات - پنجره خوش امدگویی',
        'specialactions' => 'اقدامات ویژه',
        'adminpanel' => 'مدیریت دسترسی ها',
        'silent' => 'خفه کن',
        'editusers' => 'کاربران - ویرایش کاربران',
        'bann' => 'کاربران - اخراج کاربران',
        'delusers' => 'کاربران - حذف کاربران',
        'refreshusers' => 'کاربران - رفرش کاربران',
        'alertuser' => 'کاربران - اخطار به کاربران',
        'rooms' => 'اتاق ها',
        'addroom' => 'اتاق ها - اضافه کردن اتاق',
        'editroom' => 'اتاق ها - ویرایش اتاق ها',
        'deleteroom' => 'اتاق ها - حذف اتاق ها',
        'smilies' => 'شکلک ها',
        'smiliesuser' => 'شکلک های ارسال شده کاربران',
        'defualtssettings' => 'تنظیمات - پیشفرض ها',
        'addsmily' => 'شکلک ها - افزودن شکلک',
        'editsmily' => 'شکلک ها - ویرایش شکلک',
        'deletesmily' => 'شکلک ها - حذف شکلک',
        'badwords' => 'فیلتر ها - کلمات زشت',
        'filters' => 'فیلتر ها',
        'badwordsettings' => 'فیلتر ها - تنظیمات فیلتر ها',
        'badnames' => 'فیلتر ها - نام کاربری زشت',
        'report' => 'کاربران ریپورت شده',
        'editbadwords' => 'فیلتر ها - ویرایش کلمات زشت',
        'addbadwords' => 'فیلتر ها - افزودن کلمه زشت',
        'delbadwords' => 'فیلتر ها - حذف کلمات زشت',
        'editbadnames' => 'فیلتر ها - ویرایش نام کاربری زشت',
        'addbadnames' => 'فیلتر ها - افزودن نام کاربری زشت',
        'delbadnames' => 'فیلتر ها - حذف نام کاربری زشت',
        'stats' => 'آمارها',
        'news' => 'اخبار',
        'visualuser' => 'کاربران مجازی',
        'addvisualuser' => 'کاربران مجازی - افزودن کاربر مجازی',
        'delvisualuser' => 'کاربران مجازی - افزودن کاربر مجازی',
        'msgsender' => 'ارسال پیام گروهی',
        'msgreader' => 'خصوصی خوان',
        'adminmsgreader' => 'خصوصی خوان - خواندن خصوصی مدیران',
        'modmsgreader' => 'خصوصی خوان - خواندن خصوصی ناظران',
        'ipbanner' => 'تحریم ها',
        'addipbanner' => 'تحریم ها - تحریم آی پی جدید',
        'delipbanner' => 'تحریم ها - بازکردن تحریم',
        'player' => 'موسیقی ها',
        'addplayer' => 'موسیقی ها - افزودن موسیقی',
        'delplayer' => 'موسیقی ها - حذف موسیقی',
        'links' => 'لینکدونی',
        'addlinks' => 'لینکدونی - فزودن لینک',
        'editlinks' => 'لینکدونی - ویرایش لینک',
        'theme' => 'مدیریت قالب',
        'themechat' => 'مدیریت قالب - قالب داخل چت روم',
        'privatstyle' => 'مدیریت قالب - استایل پنجره',
        'fontsin' => 'مدیریت قالب - فونت ها',
        'headers' => 'مدیریت قالب - سربرگ ها',
        'codejava' => 'مدیریت قالب - کد جاوا و فلش',
        'logintheme' => 'تغییر قالب بیرونی',
        'generalsettings' => 'تنظیمات',
        'msgsettings' => 'تنظیمات - تنظیمات پیام ها',
        'loginsettings' => 'محدودیت ها - محدودیت ورود',
        'formsetting' => 'تنظیمات - تنظیمات گزینه های کادر ارسال',
        'rclicksettings' => 'محدودیت ها - کلیک راست',
        'useroptionsettings' => 'محدودیت ها',
        'usertypes' => 'سطوح کاربری',
        'addusertypes' => 'سطوح کاربری - افزودن سطح کاربری',
        'editusertypes' => 'سطوح کاربری - ویرایش سطح کاربری',
        'delusertypes' => 'سطوح کاربری - حذف سطح کاربری',
        'ads' => 'تبلیغات - مدیریت تبلیغات',
        'adss' => 'تبلیغات',
        'adsbuy' => 'تبلیغات - قیمت تبلیغات',
        'addads' => 'تبلیغات - افزودن تبلیغ',
        'delads' => 'تبلیغات - حذف تبلیغ',
        'themelogins' => 'تغییر قالب بیرونی - انتخاب قالب',
        'editautoanswer' => 'کاربران مجازی - ویرایش پاسخ اتوماتیک',
        'autoanswer' => 'کاربران مجازی - پاسخ اتوماتیک',
        'delautoanswer' => 'کاربران مجازی - حذف پاسخ های اتوماتیک',
        'seepw' => 'کاربران - مشاهده کلمه عبور کاربران',
        'seepwadminteam' => 'کاربران - مشاهده کلمه عبور تیم مدیریتی',
        'changepw' => 'کاربران - تغییر کلمه عبور کاربران',
        'changepwadminteam' => 'کاربران - تغییر کلمه عبور تیم مدیریتی',
        'pays' => 'پرداخت ها',
        'sendedimages' => 'فایل های ارسالی در خصوصی',  
        'tlgsendedpm' => 'تنظیمات - تنظیمات ربات تلگرام',
        'redirectsetting' => 'تنظیمات - تنظیمات ریدایرکت',
        'deletestatos' => 'وضعیت ها - حذف وضعیت',
        'addfonts' => 'مدیریت قالب - افزودن فونت',
     	'statos' => 'وضعیت ها',
        'deletefonts' => 'مدیریت قالب - حذف فونت',
        'iconlist' => 'مدیریت ایکون ها',
        'iconmororgar' => 'مدیریت ایکون ها - تغییر ایکون مرورگر',
        'iconomoomi' => 'مدیریت ایکون ها - تغییر ایکون عمومی',
        'iconprivate' => 'مدیریت ایکون ها - تغییر ایکون چت خصوصی',
        'iconstatus' => 'مدیریت ایکون ها - تغییر ایکون وضعیت',
        'deleteavatar' => 'رصدخانه - اواتار',
        'logscover' => 'رصدخانه - کاور',
        'logsprofile' => 'رصدخانه - پست کاربران',
        'settingsmod' => 'محدودیت ها - ویرایش محدودیت مدیریت',
        'loginsettingsbann' => 'محدودیت ها - محدودیت برای ایپی کشورها',
        'settingsprivate' => 'محدودیت ها - ویرایش محدودیت های چت خصوصی',
        'settingsprofile' => 'محدودیت ها - ویرایش محدودیت های پروفایل',
        'addstatos' => 'وضعیت ها - افزودن وضعیت',
        'settingssocial' => 'محدودیت ها - ویرایش شبکه اجتماعی',
        'textsetting' => 'تنظیمات - ویرایش متون داخل چت روم',
        'settingsvip' => 'محدودیت ها - ویرایش محدودیت امکانات ویژه',     
        'settingsseo' => 'تنظیمات - تنظیمات سئو',
        'corneramar' => 'نمایش آمار گوشه پنل'
    );
    public static $GlobalPages = array('index', 'settings','restriction');

    static function getNamePermissions($permissions) {
        if ($permissions == 'all') {
            return('همه');
        }
        $permissions = explode(',', $permissions);
        $NamePermissions = "";
        foreach ($permissions as $permission) {
            if ($NamePermissions != '') {
                $NamePermissions .= ',';
            }
            $NamePermissions.= self::getNamePermission($permission);
        }
        return $NamePermissions;
    }

    static function getNamePermission($permission) {
        return self::$Permissions[$permission];
    }

    static function check_Permission($action = 'notfound', $page = null, $permissions = null) {
        global $sql;
        if (!session('adminpanelogin')) {
            session('adminpanelogin', 'false');
        }
        if ($permissions == null) {
            $permissions = session('permissions');
        } else {
            if (is_string($permissions)) {
                if ($permissions == 'all') {
                    return true;
                }
                $permissions = explode(',', $permissions);
            }
        }
        if ($page == null) {
            $page = giu('el2');
        }
        if (!$page) {
            $page = 'index';
        } 
        if (!$permissions) { 
            $sql->where('user', session('id'));
            if ($permissions = $sql->getOne('adminpanel', array('permissions', 'password'))) {
                if ($permissions['password'] != '') {
                    if (session('adminpanelogin') != 'true') {
if(giu('page') === 'admin'){
                        header::Go(url('admin/login'));
                        }else{
                        	switch($action){
						        case('notfound'):case(null):include("pages/noaccess.php");exit();break;
						        case('bool'):return false;break;
						        case('exit'):exit();break;
						    }
                        }
						exit();
                    }
                }

                session('permissions', $permissions['permissions']);
                $permissions = $permissions['permissions'];
            } else {
                switch ($action) {
                    case('notfound'):case(null):include("pages/noaccess.php");
                        exit();
                        break;
                    case('bool'):return false;
                        break;
                    case('exit'):exit();
                        break;
                }
            }
        }
        if ($permissions == 'all')
            return true;
        $permissions = explode(',', $permissions);
        if (in_array($page, $permissions)) {
            return true;
        } else {
            switch ($action) {
                case('notfound'):case(null):include("pages/noaccess.php");
                    exit();
                    break;
                case('bool'):return false;
                    break;
                case('exit'):exit();
                    break;
            }
        }
    }

}

?>
