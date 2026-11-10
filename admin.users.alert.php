<?php
if(!session('id') or session('admin') == '0')exit();
adminpanel::check_Permission('exit', 'alertusers');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}

$id = isset($_POST['user']) ? safe::number($_POST['user']) : '';
if (session('id') != '1' && $id == '1') {
    echo 'این شخص صاحب چت روم است اجازه ویرایش اطلاعات را ندارید در صورتی که صاحب چت روم هستید برای تغییر رمز از ایکون چرخ دنده در داخل چت روم رمز خود را تغییر دهید';
    exit;
}
if($id == ''){echo('id');return false;}
$sql->where("id", $id);
if(!$user = $sql->getOne('users',array('id', 'username'))){echo('user');return false;}
$sql->where("id", $user['id']);
$online = $sql->getOne('onlines', array('id'));
if($online){
    $text = isset($_POST['text']) ? safe::string($_POST['text']) : '';
    if($text != '')Users::warning($online['id'], $text);

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "به کاربر   \"$user[1]\" اخطاری داد");}
}
echo('ok');
?>