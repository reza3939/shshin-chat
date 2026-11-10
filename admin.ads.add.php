<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'addads');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;

$tel = json_decode($options['teloptions'], true);
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}
$title = isset($_POST['title']) ? safe::string($_POST['title']) : 'تبلیغ';

$page = isset($_POST['page']) ? safe::string($_POST['page']) : '';
if (!in_array($page, array('chat', 'login', 'profile', 'banned'))) {
    echo('page');
    return;
}
$title = isset($_POST['title']) ? safe::string($_POST['title']) : 'تبلیغ';

$page = isset($_POST['page']) ? safe::string($_POST['page']) : '';
if (!in_array($page, array('chat', 'login', 'profile', 'banned'))) {
    echo('page');
    return;
}
switch($page){
	case('chat'):
	   $local = 'داخل چتروم';
	   break;
	case('login'):
	   $local = ' بیرون چت روم';
	   break;
	case('profile'):
	   $local = 'پروفایل';
	   break;
	case('banned'):
	   $local = 'صفحه اخراج';
	   break;
	
}
$type = isset($_POST['type']) ? safe::string($_POST['type']) : '';
if (!in_array($type, array('popup', 'newtab', 'banner', 'fixedbanner'))) {
    echo('type');
    return;
}
switch($type){
	case('popup'):
	   $locattion = 'پاپ آپ';
	   break;
	case('newtab'):
	   $locattion = 'نیوتب';
	   break;
	case('banner'):
	   $locattion = 'بنر ساده';
	   break;
	case('fixedbanner'):
	   $locattion = 'بنر گوشه ای';
	   break;

}
$expiration = isset($_POST['expiration']) ? safe::string($_POST['expiration']) : '';
if ($expiration == '' or $expiration == '0') {
    $expiration = '0';
    $expirationTime = 0;
} else {
    $expirationTime = 0;
    $expiration = explode('-', $expiration);
    if (!isset($expiration[1]))
        $expirationTime = 0;

    $expiration[0] = (int) safe::number($expiration[0]);
    switch ($expiration[1]) {
        case('minute'):$expirationTime = time() + ($expiration[0] * 60);
            break;
        case('hour'):$expirationTime = time() + ($expiration[0] * 3600);
            break;
        case('day'):$expirationTime = time() + ($expiration[0] * 86400);
            break;
        case('week'):$expirationTime = time() + ($expiration[0] * 604800);
            break;
        case('month'):$expirationTime = time() + ($expiration[0] * 2592000);
            break;
        case('year'):$expirationTime = time() + ($expiration[0] * 31536000);
            break;
    }
}

if ($type == 'popup' or $type == 'newtab') {
    $sql->where("page", $page);
    $sql->where("type", array('popup', 'newtab'), 'in');
    $num = $sql->getValue('ads', 'count(*)');
    if ($num == 2) {
        echo('capacity-page');
        return;
    }
    $url = isset($_POST['url']) ? safe::url($_POST['url']) : '';
    if ($url == '') {
        echo('url');
        return;
    }
    if (substr($url, 0, 7) != 'http://')
        $url.= 'http://';
    if (strlen($url) == 7) {
        echo('url');
        return;
    }
    $cockie = isset($_POST['cookie']) ? safe::string($_POST['cookie']) : '0';
    if ($cockie == '' or $cockie == '0') {
        $cockie = '0';
        $cockieTime = 0;
    } else {
        $cockieTime = 0;
        $cockie = explode('-', $cockie);
        if (!isset($cockie[1]))
            $cockieTime = 0;

        $cockie[0] = (int) safe::number($cockie[0]);
        switch ($cockie[1]) {
            case('minute'):$cockieTime = time() + ($cockie[0] * 60);
                break;
            case('hour'):$cockieTime = time() + ($cockie[0] * 3600);
                break;
            case('day'):$cockieTime = time() + ($cockie[0] * 86400);
                break;
            case('week'):$cockieTime = time() + ($cockie[0] * 604800);
                break;
            case('month'):$cockieTime = time() + ($cockie[0] * 2592000);
                break;
            case('year'):$cockieTime = time() + ($cockie[0] * 31536000);
                break;
        }
    }
    $inputs = json_encode(array('cockie' => $cockieTime));
    $sql->insert('ads', array(
        'page' => $page,
        'title' => $title,
        'type' => $type,
        'url' => $url,
        'location' => null,
        'createtime' => time(),
        'expiration' => $expirationTime,
        'inputs' => $inputs
    ));
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));

if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
   chatroom::addlog('9', "تبلیغ پاپ آپ $title اضافه کرد");
}
     $text = "تبلیغی با عنوان ($title)  و ادرس ($url)را اضافه کرد\n";
$text .='نوع تبلیغ : '.$locattion."\n";
 $text .='محل قرار گیری : '.$local."\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    tlg($text,'designer');
      if($tel['sendadslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($type == 'fixedbanner') {

    $location = isset($_POST['location']) ? safe::string($_POST['location']) : 'top-right';
    if (!in_array($location, array('top-right', 'top-left', 'bottom-right', 'bottom-left'))) {
        $location = 'top-right';
    }

    $sql->where("page", $page);
    $sql->where("type", "fixedbanner");
    $sql->where("location", $location);
    $num = $sql->getValue('ads', 'count(*)');
    if ($num == 1) {
        echo('capacity-location');
        return;
    }
    $url = isset($_POST['url']) ? safe::url($_POST['url']) : '';
    if ($url == '') {
        echo('url');
        return;
    }
    if (substr($url, 0, 7) != 'http://')
        $url = 'http://' . $url;
    if (strlen($url) == 7) {
        echo('url');
        return;
    }
    $closeable = isset($_POST['closeable']) ? 'true' : 'false';

    if (isset($_FILES['banner'])) {
        $typeFile = $_FILES['banner']['type'];
        if ($typeFile != 'image/png' && $typeFile != 'image/jpeg' && $typeFile != 'image/gif') {
            $msg = 'type';
        } else {
            switch ($typeFile) {
                case('image/png'):$format = 'png';
                    break;
                case('image/jpeg'):$format = 'jpg';
                    break;
                case('image/gif'):$format = 'gif';
                    break;
            }
            $folder = 'theme/images/ads';
            if (!is_dir($folder))
                mkdir($folder);

	    $nextid = $sql->where('table_name', db_prefix . 'ads')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
            $name = "ad$nextid.$format";
            $filename = "$folder/$name";
            if (move_uploaded_file($_FILES['banner']['tmp_name'], $filename)) {
                $img = file_get_contents($filename);
                if (strpos((string) $img, '<?php') !== false) {
                    unlink($filename);
                    $msg = 'security';
                } else {
                    $inputs = json_encode(array('banner' => $filename, 'closeable' => $closeable));
                    $sql->insert('ads', array(
                        'page' => $page,
                        'title' => $title,
                        'type' => $type,
                        'url' => $url,
                        'location' => $location,
                        'createtime' => time(),
                        'expiration' => $expirationTime,
                        'inputs' => $inputs
                    ));
                    $msg = 'ok';
                }
            } else {
                $msg = 'noup';
            }
        }
    } else {
        $msg = 'noelemrnr';
    }
    if ($msg == 'ok') {

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){   
}elseif ($hide['hide'] == '0' and session("admin")!=0){

  chatroom::addlog('9', "بنر گوشه ای $title اضافه کرد");

}  
  
    }
       $text = "تبلیغی با عنوان ($title)  و ادرس ($url)را اضافه کرد\n";
$text .='نوع تبلیغ : '.$locattion."\n";
  $text .='محل قرار گیری : '.$local."\n";
 $text .='نام فایل : '.$name."\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    tlg($text,'designer');
      if($tel['sendadslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo($msg);
} elseif ($type == 'banner') {
    if ($page == 'login') {
        echo('cannotpage');
        return;
    }
    $location = isset($_POST['location']) ? safe::string($_POST['location']) : 'top';
    if (!in_array($location, array('top', 'bottom'))) {
        $location = 'top';
    }
    if (isset($_FILES['banner'])) {
        $typeFile = $_FILES['banner']['type'];
        if ($typeFile != 'image/png' && $typeFile != 'image/jpeg' && $typeFile != 'image/gif') {
            $msg = 'type';
        } else {
            switch ($typeFile) {
                case('image/png'):$format = 'png';
                    break;
                case('image/jpeg'):$format = 'jpg';
                    break;
                case('image/gif'):$format = 'gif';
                    break;
            }
            $folder = 'theme/images/ads';
            if (!is_dir($folder))
                mkdir($folder);

	    $nextid = $sql->where('table_name', db_prefix . 'ads')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
            $name = "ad$nextid.$format";
            $filename = "$folder/$name";
            if (move_uploaded_file($_FILES['banner']['tmp_name'], $filename)) {
                $img = file_get_contents($filename);
                if (strpos((string) $img, '<?php') !== false) {
                    unlink($filename);
                    $msg = 'security';
                } else {
                    $url = isset($_POST['url']) ? safe::url($_POST['url']) : '';
                    if ($url == '') {
                        echo('url');
                        return;
                    }
                    if (substr($url, 0, 7) != 'http://')
                        $url = 'http://' . $url;
                    if (strlen($url) == 7) {
                        echo('url');
                        return;
                    }
                    $inputs = json_encode(array('banner' => $filename));
                    $sql->insert('ads', array(
                        'page' => $page,
                        'title' => $title,
                        'type' => $type,
                        'url' => $url,
                        'location' => $location,
                        'createtime' => time(),
                        'expiration' => $expirationTime,
                        'inputs' => $inputs
                    ));
                    $msg = 'ok';
                }
            } else {
                $msg = 'noup';
            }
        }
    } else {
        $msg = 'noelemrnr';
    }
    if ($msg == 'ok') {
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
      chatroom::addlog('9', "بنر $title اضافه کرد");

}  

    }
     $text = "تبلیغی با عنوان ($title)  و ادرس ($url)را اضافه کرد\n";
 $text .='نوع تبلیغ : '.$locattion."\n";
 $text .='محل قرار گیری : '.$local."\n";
 $text .='نام فایل : '.$name."\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";

      if($tel['sendadslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo($msg);
}
?>