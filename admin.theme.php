<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'theme');

$uploadfiles = array();
$msg = "ok";
if (!empty($_FILES)) {
    $e = $_FILES;
    foreach ($_FILES as $key => $s) {
        $e = $key;
        if ($_FILES[$e]['name'] != '') {
            $type = $_FILES[$e]['type'];
            if ($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/gif') {
                $msg = 'type';
                break;
            } else {
                switch ($type) {
                    case ('image/png'):
                        $format = 'png';
                        break;
                    case ('image/jpeg'):
                        $format = 'jpg';
                        break;
                    case ('image/gif'):
                        $format = 'gif';
                        break;
                }
                $folder = 'theme/images/bg/';
                $name = "bg" . rand(0, 5000) . ".$format";
                $filename = "$folder/$name";

                if (is_file($filename)) {
                    $name = "bg" . rand(0, 5000) . ".$format";
                    $filename = "$folder/$name";
                }
                if (move_uploaded_file($_FILES[$e]['tmp_name'], $filename)) {
                    $img = file_get_contents($filename);
                    if (strpos((string) $img, '<?php') !== false) {
                        unlink($filename);
                        $msg = 'security';
                        break;
                    } else {
                        $msg = 'ok';
                        $uploadfile[$e] = $name;
                    }
                } else {
                    $msg = 'noup';
                    break;
                }
            }
        }
    }
} else {
    $msg = 'noelemrnr';
}

$thememanager = json_decode($options['thememanager'], true);
$part = isset($_POST['part']) ? safe::string($_POST['part']) : '';
if (!isset($thememanager[$part])) {
    exit();
}
$subset = isset($_POST['subset']) ? safe::string($_POST['subset']) : '';
switch($subset){
	case('body'):
	   $local = 'ویرایش پس زمینه چت روم';
	   break;
	case('privat'):
	   $local = 'ویرایش خصوصی چت روم';
	   break;
	case('chatinhalt'):
	   $local = 'ویرایش عمومی چت روم';
	   break;
	case('onlinelist'):
	   $local = 'ویرایش لیست انلاین چت روم';
	   break;
	case('rooms'):
	   $local = 'ویرایش اتاق ها';
	   break;
	case('form'):
	   $local = 'ویرایش کادر ارسال';
	   break;
	case('linkdooni'):
	   $local = 'ویرایش لینکدونی';
	   break;
          case('avatar'):
	   $local = 'ویرایش اواتار ';
	   break;
	case('welcomebox'):
	   $local = 'ویرایش باکس خوش آمد گویی';
	   break;
}
  $tel = json_decode($options['teloptions'], true);
   $text = "قالب داخل چت روم \n";
$text .='عملکرد: '.$local."\n";

    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
 
       if($tel['sendusertypeslog'] == 'Sure'){
             tlg($text,'chat');
                 }
if (!isset($thememanager[$part][$subset])) {
    exit();
}

if ($subset == 'admin-icons') {
    if ($msg == 'ok') {
        $thememanager[$part][$subset][$e] = 'theme/images/bg/' . $name;
    }
} elseif ($subset == 'form-icons') {

    if ($msg == 'ok') {
        foreach ($uploadfile as $key => $val) {
            $thememanager[$part][$subset][$key] = 'theme/images/bg/' . $val;
        }
    }
} else {
    foreach ($_POST as $key => $val) {
        if (!isset($thememanager['chat']['onlinelist']['width'])) {
            $thememanager['chat']['onlinelist']['width'] = '260px';
        }
if ($key == 'space-text') {
    $sql->where("name", 'spacetext');
    $sql->update('options', array(
         'value' => safe::string($val)
   ));
}
        if (isset($thememanager[$part][$subset][$key])) {
            $val = safe::string($val);
            if ($key == 'background-color' and substr($val, 0, 4) == '#fff') {
                $val = '#fff';
            }
            $thememanager[$part][$subset][$key] = $val;
        }
    }
    if (isset($thememanager[$part][$subset][$e]) and isset($name)) {
        $thememanager[$part][$subset][$e] = 'theme/images/bg/' . $name;
    }

}

$sql->where("name", 'thememanager');
$sql->update('options', array(
    'value' => json_encode($thememanager, JSON_UNESCAPED_UNICODE)
));



 $avatarstyle= json_decode($options['avatarstyle'], true);
if (isset($_POST['avatar-hover'])&&trim($_POST['avatar-hover']) != ' ') {
   $avatarstyle['border-radius'] = safe::string($_POST['avatar-radius']);
}
if (isset($_POST['border-size'])&& trim($_POST['border-size']) != ' ') {
   $avatarstyle['border-size'] = safe::string($_POST['border-size']);
}
if (isset($_POST['border-size'])&& trim($_POST['border-size']) != ' ') {
   $options['border-size'] = safe::string($_POST['border-size']);
}

if (isset($_POST['avatar-hover'])&& trim($_POST['avatar-hover']) != ' ') {
   $avatarstyle['avatar-hover'] = safe::string($_POST['avatar-hover']);
}
if (isset($_POST['avatar-color'])&& trim($_POST['avatar-color']) != ' ') {
   $avatarstyle['avatar-color'] = safe::string($_POST['avatar-color']);
}


$avatarstyle = json_encode($avatarstyle, JSON_UNESCAPED_UNICODE);

$sql->where("name", 'avatarstyle');
$sql->update('options', array(
    'value' => $avatarstyle
));
chatroom::reloadconfig();
echo ("$msg");
?>