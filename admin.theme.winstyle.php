<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'logintheme');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}
if (isset($_POST['chat_winstyle'])) {
    $newvalue = safe::string($_POST['chat_winstyle']);
    $sql->where("name", 'chat_winstyle');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "استایل پنجره ها را به $newvalue تغییر داد ");
}

echo('ok');
?>