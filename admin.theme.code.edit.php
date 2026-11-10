<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'theme');

$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';
if ($id == '') {
    echo('id');
    return;
}
$title = isset($_POST['title']) ? safe::string($_POST['title']) : '';
if ($title == '') {
    echo('title');
    return;
}

$page = isset($_POST['page']) ? safe::string($_POST['page']) : '';
$location = isset($_POST['location']) ? safe::string($_POST['location']) : '';
$code = isset($_POST['code']) ? $_POST['code'] : '';
$sql->where('id', $id)->update('codes', array(
	'title' => $title,
	'page' => $page,
	'location' => $location,
	'code' => $code
));
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "کد با عنوان \"$title\" را ویرایش کرد");
}

 $tel = json_decode($options['teloptions'], true);
  $text = "کد جاوای با عنوان($title)  را ویرایش کرد \n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    tlg($text,'designer');
       if($tel['sendjavacodelog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>