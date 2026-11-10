<?php

if (!session('id') or session('admin') == '0')
    exit();
adminpanel::check_Permission('exit', 'delipbanner');

$bann = isset($_POST['id']) ? safe::number($_POST['id']) : '';
if ($bann == '') {
    echo('id');
    return;
}
$sql->where("id", $bann);
$sql->update('users', array(
    'report' => 1
));
$sql->where("id", $bann);
if ($bann = $sql->getOne('banns')) {
    if ($bann['user'] != null) {
        $sql->where("id", $bann['user']);
        $sql->update('users', array(
            'active' => 1
        ));
        $sql->where("id", $bann['user']);
        $sql->update('profiles', array(
            'active' => 1
        ));
        $sql->where("id", $bann['user']);
        $sql->update('users', array(
            'report' => 0
        ));
    }
    $sql->where("id", $bann['id']);
    $sql->delete('banns');
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "کاربر \"" . Users::get('name', $bann['user']) . "\" با آی پی\"{$bann['ip']}\" را از لیست اخراجیان آزاد کرد");

}
    }
echo('ok');
?>