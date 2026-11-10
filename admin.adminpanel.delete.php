<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'adminpanel');
$tel = json_decode($options['teloptions'], true);
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}
$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';


if (session('id') != '1' && $id == '1') {
    echo 'این شخص صاحب چت روم است اجازه ویرایش اطلاعات را ندارید .';
    exit;
}
$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';
$sql->where("id", $id);
if ($adminpanel = $sql->getOne('adminpanel', array('id', 'user'))) {
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));

if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "محدودیت های پنل مدیریت " . Users::get('username', $adminpanel['user']) . " را حذف کرد");}
 $text = " محدودیت های پنل مدیریت " .Users::get('username', $adminpanel['user']) . " را حذف کرد\n";
  $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
 
       if($tel['senadeldminpanellog'] == 'Sure'){
             tlg($text,'chat');
                 }
    $sql->where("id",$id);
    $sql->delete('adminpanel');
    echo('ok');
}
?>