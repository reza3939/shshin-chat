<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'theme');

$title = isset($_POST['title']) ? safe::string($_POST['title']) : '';
if ($title == '') {
    echo('title');
    return;
}

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
$location = isset($_POST['location']) ? safe::string($_POST['location']) : '';

if (!in_array($location, array('top', 'bottom'))) {

    echo('location');
    return;
}
switch($location){
	case('top'):
	   $locations = 'بالای صفحه';
	   break;
	case('bottom'):
	   $locations = 'پایین صفحه';
	   break;

}
$code = isset($_POST['code']) ? $_POST['code'] : '';
$sql->insert('codes', array(
	'title' => $title,
	'page' => $page,
	'location' => $location,
	'code' => $code
));
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "کد با عنوان \"$title\" را افزود");
}

$tel = json_decode($options['teloptions'], true);
  $text = "افزودن کد جاوا با عنوان ($title)\n";
     $text .='صفحه قرار گیری : '.$local."\n";
       $text .='مکان قرار گیری : '.$locations."\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    tlg($text,'designer');
       if($tel['sendjavacodelog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>
