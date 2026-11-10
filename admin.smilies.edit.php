<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'editsmily');


$id = safe::number($_POST['smily']);
$sql->where("id",$id);
if($smiliy = $sql->getOne('smilies')){
    $newName = isset($_POST['name']) ? safe::string($_POST['name']) : '';
    if (!empty($newName) && $sql->where("name", $newName)->where("id", $id, '!=')->has('smilies')) {
        echo('repeatname');
        return;
    }
    $priority = isset($_POST['priority']) ? safe::number($_POST['priority']) : 1;

    if (empty($newName)) {
        $newName = 'NULL';
    } else {
        $newName = "$newName";
    }
    $sql->where("id", $id);
    $sql->update('smilies', array(
        'name' => $newName,
        'priority' => $priority
    ));

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "شکلک \"{$smiliy['code']}\" را ویرایش کرد");
}
    
    echo('ok');
}
?>