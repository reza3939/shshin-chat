<?php

if (!session('id') or session('admin') == '0')
    exit();
adminpanel::check_Permission('exit', 'silent');

$silent = isset($_POST['id']) ? safe::number($_POST['id']) : '';
if ($silent == '') {
    echo('id');
    return;
}
$sql->where("id", $silent);
if ($silent = $sql->getOne('silents')) {
    $sql->where("ip", $silent['ip']);
    foreach($sql->get('onlines', null, array('id', 'inputs', 'username')) as $row){
        $inputs = json_decode($row['inputs'], true);
        $inputs['silent'] = 0;
        Users::Inputs($row['id'], $inputs);


$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
 chatroom::addlog('9', "کاربر \"{$row['username']}\" از لیست ساکت شدگان خارج کرد");
}  
    }
    $sql->where("id", $silent['id']);
    $sql->delete('silents');
}
echo('ok');
?>