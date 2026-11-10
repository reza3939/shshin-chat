<?php

// shahinn-cfd: story/responsive hooks removed
class theme {

    static function file($file, $theme = null) {
        global $sql;
        if ($theme == null) {
            global $theme;
        }
        return("theme/$theme/$file");
    }

    static function url($file, $theme = null) {
        global $options;
        global $sql;
        if ($theme == null) {
            global $theme;
        }
        $cdn = session('cdn');
        if (substr($file, 0, 6) == 'theme/') {
            if (isset($options['cdn']) and $options['cdn'] != '' and $cdn and $cdn != 'false') {
                return("http://$cdn/{$options['cdn']}/$file");
            } else {
                return("/$file");
            }
        } else {
            if (isset($options['cdn']) and $options['cdn'] != '' and $cdn and $cdn != 'false') {
                return("http://$cdn/{$options['cdn']}/theme/$theme/$file");
            } else {
                return("/theme/$theme/$file");
            }
        }
    }

    static function option($name, $value = null) {
        global $options;
        global $sql;
        if (isset($options["theme_$name"])) {
            return $options["theme_$name"];
        }
    }

    static function CompressJs($file) {
        global $sql;
        if (is_file($file)) {
            $key = strtolower(substr(strrchr($file, "."), 1));
            $newname = dirname($file) . '/' . str_replace($key, '', basename($file)) . 'compress.' . $key;
        }
    }

    static function get_header($page) {
        global $options, $sql;
        $output = '';
        if (!isset($GLOBALS['thememanager'])) {
            $GLOBALS['thememanager'] = json_decode($options['thememanager'], true);
        }
        $options_thememanager = $GLOBALS['thememanager'];
        if ($page == 'chat') {
            $output .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />\n";
            if ($options['typeload'] == '1') {
                $output .= "<script src=\"" . self::url('theme/js/compress.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
                $output .= "<script src=\"" . url('jsloader') . "\" type=\"text/javascript\"></script>\n";
                $output .="<link href=\"" . theme::url('css/chat.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .="<link href=\"" . self::url('theme/fonts/fonts.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .="<style type=\"text/css\">\n\tbody{";
                $output .="background-image: url('" . self::url($options_thememanager['chat']['body']['background-image']) . "');";
                $output .="background-repeat: " . $options_thememanager['chat']['body']['background-repeat'] . ";";
                $output .="background-color: " . $options_thememanager['chat']['body']['background-color'] . ";";
                $output .="}\n\t#chatinhalt{";
                $temp = $options_thememanager['chat']['chatinhalt'];
                $output .="background-image: url('" . self::url($temp['background-image']) . "');";
                $output .="background-repeat: " . $temp['background-repeat'] . ";";
                $output .="background-color: " . $temp['background-color'] . ";";
                $output .="font-family: " . $temp['font-family'] . ";";
                $output .="font-size: " . $temp['font-size'] . ";";
                $output .="box-shadow: " . $temp['box-shadow'] . ";";
                $output .="border: " . $temp['border'] . ";";
                $output .="border-radius: " . $temp['border-radius'] . ";";
                if ($temp['float'] == 'right') {
                    $output .="direction: rtl;";
                }
                $output .="}\n\t#onlinelist{";
                if ($temp['float'] == 'right') {
                    $output .="float: left;";
                }
                $temp = $options_thememanager['chat']['onlinelist'];
                $output .="background-image: url('" . self::url($temp['background-image']) . "');";
                $output .="background-repeat: " . $temp['background-repeat'] . ";";
                $output .="background-color: " . $temp['background-color'] . ";";
                $output .="font-family: " . $temp['font-family'] . ";";
                $output .="font-size: " . $temp['font-size'] . ";";
                $output .="box-shadow: " . $temp['box-shadow'] . ";";
                $output .="border-radius: " . $temp['border-radius'] . ";";
                $output .="border: " . $temp['border'] . ";";
                $output .="}\n\t#form{";
                $temp = $options_thememanager['chat']['form'];
                $output .="background-image: url('" . self::url($temp['background-image']) . "');";
                $output .="background-repeat: " . $temp['background-repeat'] . ";";
                $output .="background-color: " . $temp['background-color'] . ";";
                $output .="border: " . $temp['border'] . ";";
                $output .="font-family: " . $temp['font-family'] . ";";
                $output .="font-size: " . $temp['font-size'] . ";";
                $output .="color: " . $temp['color'] . ";";
                $output .="box-shadow: " . $temp['box-shadow'] . ";";
                $output .="border-radius: " . $temp['border-radius'] . ";";
                $output .="}\n\t.rooms,.rooms_not_allowed{";
                $temp = $options_thememanager['chat']['rooms'];
                $output .="background-image: url('" . self::url($temp['background-image']) . "');";
                $output .="background-repeat: " . $temp['background-repeat'] . ";";
                $output .="background-color: " . $temp['background-color'] . ";";
                $output .="border: " . $temp['border'] . ";";
                $output .="font-family: " . $temp['font-family'] . ";";
                $output .="font-size: " . $temp['font-size'] . ";";
                $output .="font-weight: " . $temp['font-weight'] . ";";
                $output .="color: " . $temp['color'] . ";";
                $output .="box-shadow: " . $temp['box-shadow'] . ";";
                $output .="border-radius: " . $temp['border-radius'] . ";}\n</style>\n";
                $output .= "<link href=\"" . self::url('theme/css/story.css') . "?ver=2.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .= "<script src=\"" . self::url('theme/js/story.js') . "?ver=2.0\" type=\"text/javascript\"></script>\n";
            } elseif ($options['typeload'] == '2') {
                $winstyle = $options['chat_winstyle'];
                $output .="<link href=\"" . theme::url('css/chat.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .="<link href=\"" . $winstyle . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .="<link href=\"" . self::url('theme/fonts/fonts.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .="<link href=\"" . ('fonts') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .= "<script src=\"" . self::url('theme/js/compress.js') . "?ver=9.4.0\" type=\"text/javascript\"></script>\n";
                $output .= "<script src=\"" . self::url('theme/js/dstarter.js') . "?ver=9.9.7.9\" type=\"text/javascript\"></script>\n";
				$output .= "<script src=\"" . self::url('theme/js/browser.js') . "?ver=9.7.0\" type=\"text/javascript\"></script>\n";
                $output .= "<link href=\"" . self::url('theme/css/story.css') . "?ver=2.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .= "<script src=\"" . self::url('theme/js/story.js') . "?ver=2.0\" type=\"text/javascript\"></script>\n";
                if ($options['socialitems'] == 'true' || $options['staticreg'] == 'true') {
                    $output .= "<script src=\"" . self::url('theme/js/social.js') . "?ver=9.4.1\" type=\"text/javascript\"></script>\n";
                    $output .="<link href=\"" . theme::url('theme/css/social.css') . "?ver=9.4.1\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                }
                if ($options['offmsgautoshow'] == 'false' &&  $sql->where("userid", session('id'))->has('offline_message')) {
                    $output .="<script>alert('شما " . $sql->where("userid", session('id'))->getValue('offline_message','count(*)') . " پيام افلاین داريد . براي مشاهده پیام های افلاین خود را ببینید')</script>\n";
                }
                $output .= "<script type=\"text/javascript\">\$setup = '" . self::setup_chat() . "';\$thememanager = '" . self::themeloader_chat() . "';\$setting.url_type = '" . $options['url_type'] . "';\$setting.rewrite_prefix = '" . $options['rewtite_suffix'] . "';\$setting.header = true;</script>\n";
            }
            $output .= "<script type=\"text/javascript\">document.addEventListener('DOMContentLoaded',function(){var box=document.getElementById('linkdooni');if(!box){return;}var m=box.getElementsByTagName('marquee')[0];if(!m){return;}var h=m.offsetHeight||22;var clip=document.createElement('div');clip.style.cssText='overflow:hidden;position:relative;width:100%;height:'+h+'px;direction:rtl;';var track=document.createElement('div');track.style.cssText='position:absolute;top:0;left:0;white-space:nowrap;will-change:transform;';track.innerHTML=m.innerHTML;clip.appendChild(track);m.parentNode.replaceChild(clip,m);var W=track.scrollWidth;if(!W){return;}var cw=clip.clientWidth||0;var speed=28.5,x=-W,frozen=false,hovered=false,last=0;function paint(){track.style.transform='translate3d('+x.toFixed(2)+'px,0,0)';}paint();function frame(ts){if(!last){last=ts;}var dt=ts-last;last=ts;if(dt>100){dt=100;}if(!frozen&&!hovered){x+=speed*dt/1000;if(x>=cw){x=-W;}paint();}window.requestAnimationFrame(frame);}window.requestAnimationFrame(frame);clip.addEventListener('mouseenter',function(){hovered=true;});clip.addEventListener('mouseleave',function(){hovered=false;});clip.addEventListener('click',function(e){var t=e.target;while(t&&t!==clip){if(t.tagName==='A'){return;}t=t.parentNode;}frozen=!frozen;if(!frozen){hovered=false;}});});</script>\n";
        } elseif ($page == 'login') {
            $token_val = token();
            $output .="<link href=\"" . self::url('theme/fonts/fonts.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output = '<script src="' . self::url("theme/js/jquery.js") . '?ver=9.3.0" type="text/javascript"></script><script src="/visit" type="text/javascript" defer="defer"></script><script type="text/javascript">$url_type = \'' . $options['url_type'] . '\';$rewrite_prefix = \'' . $options['rewtite_suffix'] . '\';$theme = \'' . $options['chat_theme'] . '\';$chat_prefix = \'' . $options['chat_prefix'] . '\';$token = \'' . $token_val . '\';$robot = \'\';</script>';
            if ($options['typeload'] == '2') {
                $output .="<link href=\"" . self::url('css/login.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .="<link href=\"" . theme::url('theme/css/msgAlert.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .="<link href=\"" . self::url('theme/fonts/fonts.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
      if ($options['anti_spammer'] == 'true') {
                $output.= '<script src="' . url("login.roida") . '?ver=9.8.0" type="text/javascript"></script>';
       } else {      $output.= '<script src="' . self::url("theme/js/login.js") . '?ver=9.8.2" type="text/javascript"></script>';
            }    $output .= "<script src=\"" . self::url('theme/js/msgAlert.js') . "?ver=9.6.4\" type=\"text/javascript\"></script>\n";
            } else {
                $output .="<link href=\"" . self::url('theme/fonts/fonts.css') . "?ver=9.5.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
                $output .="<link href=\"" . self::url('css/login.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
       if ($options['anti_spammer'] == 'true') {          
                  $output.= '<script src="' . url("login.roida") . '?ver=9.8.0" type="text/javascript"></script>';
            } else {     $output.= '<script src="' . self::url("theme/js/login.js") . '?ver=9.8.2" type="text/javascript"></script>';
            }
           }
        } else if ($page == 'mobile') {
            $token_val = token();
            $output .="<link href=\"" . ('fonts') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output .= "<script src=\"" . self::url('js/jquery.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
            $output .= "<script src=\"" . self::url('js/stable.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
            $output .= "<script src=\"" . self::url('js/dstarter.m.js') . "?ver=9.4.1.4\" type=\"text/javascript\"></script>\n";
            $output .="<link href=\"" . theme::url('css/chat.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output .= "<script src=\"" . self::url('js/plugin.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
            $output .= "<script src=\"" . self::url('js/spectrum.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
            $output .= "<script src=\"" . self::url('js/jquery-ui-1.10.4.custom.min.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
            $output .="<link href=\"" . theme::url('css/spectrum.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output .="<link href=\"" . theme::url('css/responsive.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output .="<link href=\"" . self::url('theme/fonts/fonts.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output .= "<script type=\"text/javascript\">\$setup = '" . self::setup_chat() . "';\$thememanager = '" . self::themeloader_chat() . "';\$setting = {};\$setting.url_type = '" . $options['url_type'] . "';\$setting.rewrite_prefix = '" . $options['rewtite_suffix'] . "';\$token = '" . $token_val . "';</script>\n";
        } else if ($page == 'm') {
            $token_val = token();
            $output = "<script src=\"" . self::url('js/jquery-1.10.2.min.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
            $output .="<link href=\"" . self::url('theme/fonts/fonts.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output .="<link href=\"" . theme::url('css/style.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output .="<link href=\"" . theme::url('css/jm.css') . "?ver=9.3.0\" rel=\"stylesheet\" type=\"text/css\"/>\n";
            $output .= "<script src=\"" . self::url('js/jquery.mobile-1.4.2.min.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
            $output .= "<script src=\"" . self::url('js/login.js') . "?ver=9.3.0\" type=\"text/javascript\"></script>\n";
            $output .='<script type="text/javascript">$url_type = \'' . $options['url_type'] . '\';$rewrite_prefix = \'' . $options['rewtite_suffix'] . '\';$token = \'' . $token_val . '\';$robot = \'\';</script>';
        }
        echo($output);
    }

    static function themeloader_chat() {
        global $options, $sql;
        if (!isset($GLOBALS['thememanager'])) {
            $GLOBALS['thememanager'] = json_decode($options['thememanager'], true);
        }
        $options_thememanager = $GLOBALS['thememanager'];
        foreach ($options_thememanager as $key => $val) {
            if ($key != 'chat') {
                unset($options_thememanager[$key]);
            }
        }
        $options_thememanager['chat']['status'] = array('online' => 'آنلاین',
            'busy' => 'مشغول',
            'away' => 'نیستم',
            'smil' => 'مایل به چت',
            'sleep' => 'خوابم میاد',
            'angry' => 'عصبانی هستم',
            'happy' => 'همه چی آرومه من چقد خوشحالم',
            'sad' => 'ناراحتم',
            'cry' => 'دارم گریه میکنم',
            'chell' => 'شیطونم',
            'music' => 'دارم آهنگ گوش میدم',
            'broken' => 'دلشکسته',
            'eating' => 'دارم غذا میخورم',
            'cooking' => 'دارم آشپزی میکنم',
            'angel' => 'فقط خدا',
            'sick' => 'سرما خوردم',
            'working' => 'دارم کار میکنم',
            'shy' => 'خجالتی هستم',
            'cool' => 'جذاب هستم',
            'fm' => 'متاهل هستم',
            'zm' => 'دنبال دختر خوب برای آشنایی',
            'shm' => 'دنبال پسر خوب برای آشنایی',
            'lat' => 'لات چت روم',
            'money' => 'پولدار چت روم',
            'pr' => 'بچه پررو',
            'mokh' => 'در حال مخ زدن',
            'nh' => 'بی حالم',
            'csgamer' => 'کانتر باز',
            'tcs' => 'کانتر تروریست',
            'ctcs' => 'کانتر پلیس',
            'beauty' => 'خوشگل روم',
            'za' => 'زیر آبم',
            'help' => 'کمک میخوام',
            'birthday' => 'روز تولدمه',
            'personable' => 'با شخصیت',
            'baj' => 'باجنبه',
            'bij' => 'بی جنبه',
            'jm' => 'جدی و مغرور',
            'lovely' => 'دوست داشتنی',
            'baby' => 'در حال بچه داری',
            'likeme' => 'لایکم کن تا لایکت کنم',
            'ezraeil' => 'عزراییل',
            'rammal' => 'جادوگر روم',
            'spider' => 'در حال تور کردن',
            'skull' => 'اسکلتم',
            'bt' => 'خفاش روم',
            'fangel' => 'فرشته روم',
            'controller' => 'درحال بازی',
            'telephone' => 'تلفن',
            'heart' => 'عاشقم',
            'invisible' => 'مخفی شدن'
        );
        $sql->orderBy('id', 'DESC');
        foreach($sql->get('statos', null, array('id', 'img', 'text')) as $row){
            $options_thememanager['chat']['status'][$row['id']] = $row['text'];
        }
        $options_thememanager = json_encode($options_thememanager, JSON_UNESCAPED_UNICODE);
        return $options_thememanager;
    }

    static function setup_chat() {
        global $usertype, $options, $me, $sql;
        $types = array();
        foreach ($usertype as $type) {
            $types[] = array('id' => $type['id'],
                'title' => $type['title'],
                'icon' => $type['icon'],
                'guest' => $type['guest'],
                'admin' => $type['admin'],
                'score' => $type['score'],
                'color' => $type['color'],
                'taj' => $type['taj']
            );
        }
        $options['thumbavatarSize'] = explode('*', $options['thumbavatarSize']);
        $allow_image = 0;
        if ($options['allow_image'] == "true") {
            $allow_image = 1;
        }
        if (!chatroom::checkPermission('send_image') && $allow_image) {
            $allow_image = -1;
        }
        $allow_url = 0;
        if ($options['allow_url'] == "true") {
            $allow_url = 1;
        }
        if (!chatroom::checkPermission('send_link') && $allow_url) {
            $allow_url = -1;
        }
        $allowonlinelist = true;
        if (!chatroom::checkPermission('allowonlinelist')) {
            $allowonlinelist = false;
        }
        $myStatus = Users::Inputs();
        $useroptions = json_decode($options['useroptions'], true);
        $msgoptions = json_decode($options['msgoptions'],true);
        $settings = array(
            'theme' => safe::string($options['chat_theme']),
            'textcolor' => session('color'),
            'fontname' => session('fontname'),
            'fontsize' => session('fontsize'),
            'scoretosendmsg' => (int) $options['scoretosendmsg'],
            'speedtext' => $options['chat_speedmsg'] != '0' ? (in_array(session('type'), (array) $useroptions['chat_speedmsg']) ? (int) $options['chat_speedmsg'] : (int) '0') : (int) '0',
            'sendmsguest' => safe::bool($options['chat_sendmsguest']),
            'repeatmsg' => (int) $options['repeatmsg'],
            'SmiliespMsg' => (int) $options['SmiliespMsg'],
            'maxlengthmsg' => (int) $options['chat_maxlengthmsg'],
            'thumbavatar' => safe::bool($options['thumbavatar']),
            'avatardir' => "theme/images/avatars/{$options['thumbavatarSize'][0]}-{$options['thumbavatarSize'][1]}",
            'defaultavatar' => $options['defaultavatar'],
            'timemsg' => safe::bool($options['timemsg']),
            'profile_enable' => safe::bool($options['profile_enable']),
            'reg_btn' => safe::bool($options['registerbtn']),
            'numsgmain' => (int) $options['chat_numsgmain'],
            'colorlistonline' => safe::bool($options['colorlistonline']),
            'cdn' => '',
            'advcreg' => safe::bool((int) $options['advcreg']),
            'allow_image' => $allow_image,
            'useroptions' => $useroptions,
            'allow_url' => $allow_url,
            'image_score' => safe::number($options['image_score']),
            'url_score' => safe::number($options['url_score']),
            'status_private' => !isset($myStatus['status_private']) ? 'pmme' : $myStatus['status_private'],
            'status_cf' => !isset($myStatus['status_cf']) ? 'reqme' : $myStatus['status_cf'],
            'block_request2addf' => !isset($myStatus['status_addfriend']) ? 'reqme' : $myStatus['status_addfriend'],
            'block_video_audio_chat' => !isset($myStatus['status_c2c']) ? 'reqme' : $myStatus['status_c2c'],
            'view_myprofile' => !isset($myStatus['view_myprofile2f']) ? '0' : $myStatus['view_myprofile2f'],
            'allowonlinelist' => $allowonlinelist,
            'socialitems' => safe::bool($options['socialitems']),
            'sreg_email' => safe::bool($options['sreg_email']),
            'sreg_phone' => safe::bool($options['sreg_phone']),
            'showubrowseronlist' => safe::bool($options['showubrowseronlist']),
            'sideitems' => safe::string($options['sideitems']),
            'mainitems' => safe::string($options['mainitems']),
            'roomstyle' => safe::bool($options['roomstyle']),
            'shoavataronlist' => safe::bool($options['shoavataronlist']),
            'staticreg' => safe::bool($options['staticreg']),
            'offmsg' => $options['offmsgautoshow'] == 'true' ? (int) ($sql->where("userid", session('id'))->getValue('offline_message', "count(*)") > 0 ? (int) '1' : (int) '0') : (int) '0',
            'fontlist' => safe::string($options['fontlist']),
            'reply' => safe::bool($options['reply']),
            'forward' => safe::bool($options['forwardtext']),
			'deletemsg' => safe::bool($options['deletetext']),
			'edittext' => safe::bool($options['edittext']),
            'allowchat' => ($options['allowchat'] == "true" && in_array(session("type"), (array) $useroptions['group_allowchat'])) ? safe::bool("true") : safe::bool("false"),
            'chpw' => session('changepw'),
            'winsize' => str_replace(array('*','x'),'*',$options['winsize']),
'formsetting' => $options['formsetting'] ? json_decode($options['formsetting'], true) : array(),
            'timemsgpv' => safe::bool($options['timemsgpv'])
        );
        $cdn = session('cdn');
        if (isset($options['cdn']) and $options['cdn'] != '' and $cdn and $cdn != 'false') {
            $settings['cdn'] = $cdn . '/' . $options['cdn'];
        }
        $mee = array('score' => $me['score'],
            'username' => $me['name'],
            'type' => $me['type'],
            'gender' => $me['gender'],
            'id' => $me['id'],
            'avatar' => $me['avatar'] != null ? $me['avatar'] : ($me['gender'] == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg'),
            'bank' => $me['bank'],
            'reply' => in_array($me['type'], (array) $useroptions['reply']) ? true : false,
            'forward' => in_array($me['type'], (array) $msgoptions['allowforward']) ? true : false,
            'delmsg' => in_array($me['type'], (array) $msgoptions['allowdelmsg']) ? true : false,
            'editmsg' => in_array($me['type'], (array) $msgoptions['alloweditmsg']) ? true : false
        );
        return json_encode(array('types' => $types, 'settings' => $settings, 'me' => $mee), JSON_UNESCAPED_UNICODE);
    }

    static function themeloader($page, $part) {

        global $options, $sql;
        if ($options['typeload'] == '2') {
            return('');
        }
        $output = '';
        if (!isset($GLOBALS['thememanager'])) {
            $GLOBALS['thememanager'] = json_decode($options['thememanager'], true);
        }
        $thememanager = $GLOBALS['thememanager'];
       if($page == 'chat'){
            if($part == 'header'){
                $output .= "<p style='text-align:center;margin:0 auto 4px;max-width:100%;overflow:hidden'><img src='".self::url($thememanager['chat']['header']['src'])."' border='0' alt='' style='max-width:100%;height:auto;display:inline-block'></p>";
            }elseif(substr($part, 0,5) == 'code-'){
                if(!isset($GLOBALS['codes'])){
                    $GLOBALS['codes'] = array();
                    $sql->where("page", $page);
                    foreach($sql->get('codes') as $row){
                        $GLOBALS['codes'][] = array(
                            'location' => $row['location'],
                            'code'     => $row['code']
                        );
                    }
                }
                $codes = $GLOBALS['codes'];
                foreach($codes as $code){
                    if($code['location'] == substr($part, 5)){$output = $code['code'];break;}
                }
            }elseif(substr($part, 0,13) == 'ads-bannerfix'){
                if(!isset($GLOBALS['ads'])){
                    $GLOBALS['ads'] = array();
                    $sql->where("page", $page);
                    foreach($sql->get('ads') as $row){
                        $inputs = json_decode($row['inputs'], true);
                        if(isset($inputs['cockie'])){
                            $inputs['cockie'] = round(($inputs['cockie'] - time())/86400);
                            if($inputs['cockie'] < 1)$inputs['cockie'] = 0;
                        }
                        $GLOBALS['ads'][] = array(
                            'id' => $row['id'],
                            'type' => $row['type'],
                            'url'  => $row['url'],
                            'location'  => $row['location'],
                            'inputs' => $inputs
                        );
                    }
                }
                $ads = $GLOBALS['ads'];
                foreach($ads as $ad){
                    if($ad['type'] == 'fixedbanner'){
                        $css = '';
                        switch($ad['location']){
                            case('top-right'):$css = 'right:0;top:0';break;
                            case('top-left'):$css = 'left:0;top:0';break;
                            case('bottom-left'):$css = 'left:0;bottom:0';break;
                            case('bottom-right'):$css = 'right:0;bottom:0';break;
                        }

                        $closebtn = '';
                        if($ad['inputs']['closeable'] == 'false'){
                            $closebtn = '<div class="closebtn" onclick="this.parentNode.style.display = \'none\';">بستن [x]</div>';
                        }
                        $code = '<div id="ad-' . $ad['id'] . '" class="fixedads" style="position: fixed;' . $css . ';background-color:transparent; z-index: 1000;">' . $closebtn . '<a target="_blank" href="' . $ad['url'] . '"><img src="' . self::Url($ad['inputs']['banner']) . '" border="0" style="max-width:100vw;height:auto"></a></div>';
                        $output .= $code;
                    }
                }
            }elseif(substr($part, 0,11) == 'ads-banner-'){
                if(!isset($GLOBALS['ads'])){
                    $GLOBALS['ads'] = array();
                    $sql->where("page", $page);
                    foreach($sql->get('ads') as $row){
                        $inputs = json_decode($row['inputs'], true);
                        if(isset($inputs['cockie'])){
                            $inputs['cockie'] = round(($inputs['cockie'] - time())/86400);
                            if($inputs['cockie'] < 1)$inputs['cockie'] = 0;
                        }
                        
                        $GLOBALS['ads'][] = array(
                            'id' => $row['id'],
                            'type' => $row['type'],
                            'url'  => $row['url'],
                            'location'  => $row['location'],
                            'inputs' => $inputs
                        );
                    }
                }
                $location = substr($part, 11);
                $ads = $GLOBALS['ads'];
                foreach($ads as $ad){
                    if($ad['type'] == 'banner' and $ad['location'] == $location){
                        $code = '<a target="_blank" href="' . $ad['url'] . '"><img src="' . self::url($ad['inputs']['banner']) . '" border="0" style="max-width:100%;height:auto"></a>';
                        $output .= $code;
                    }
                }
                if($output != '')$output = "<p id='bannerrow" . $location . "' style='text-align:center'>".$output."</p>";
            }elseif (substr($part, 0, 11) == 'form_right') {

                $temp = $thememanager['chat']['form-icons'];
                $output = '<img id="link_sagen" src="' . self::url($temp['icon-send']) . '" class="img_button" alt="ارسال پيام" title="ارسال پيام"/>
                <img id="link_smileys" src="' . self::url($temp['icon-smilies']) . '" class="img_button" alt="شکلک ها" title="شکلک ها"/>
                <img id="link_color" src="' . self::url($temp['icon-fonts']) . '" class="img_button" alt="رنگ و فونت نوشته" title="رنگ و فونت نوشته"/>
                <img id="link_prop" src="' . self::url($temp['icon-settings']) . '" class="img_button" alt="تنظيمات" title="تنظيمات"/>
                <img id="link_vip" src="' . self::url($temp['icon-vip']) . '" class="img_button" alt="امکانات ویژه" title="امکانات ویژه"/>
                <a href="' . url('users/ranks') . '"><img id="link_ranks" src="' . self::url($temp['icon-ranks']) . '" class="img_button" alt="امتيازات کاربران" title="امتيازات کاربران"/></a>
                <a href="' . url('game') . '"><img id="link_game" src="' . self::url($temp['icon-game']) . '" class="img_button" alt="بازي آنلاين" title="بازي آنلاين"/></a>';
                if (session('admin') != '0') {
                    $output .= '<img id="link_eraser" src="' . self::url($temp['icon-eraser']) . '" class="img_button" alt="پاک کن" title="پاک کن"/>
                <a href="' . url('admin') . '"><img id="link_admin" class="img_button" src="' . self::url($temp['icon-panel']) . '" alt="مديريت" title="مديريت"/></a>';
                }
                $output .= '<img id="link_logout" src="' . self::url($temp['icon-logout']) . '" class="img_button" alt="خروج" title="خروج"/>';
            }
        }
        echo($output);
    }

}

?>