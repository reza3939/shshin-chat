<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'delautoanswer');

$id = safe::number($_POST['quest']);
$sql->where('id', $id);
if($word = $sql->getOne('autoanswer', array('id', 'question'))){
    $sql->where('id', $word['id']);
    $sql->delete('autoanswer');

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "پاسخ اتوماتیک \"{$word['question']}\" را حذف کرد");
}
    chatroom::reloadautoanswer();
    if (!$sql->has('autoanswer')) {
        $sql->where('name', 'autoanswer');
        $sql->update('options', array(
            'value' => 0
        ));
        chatroom::reloadconfig();
    }
    echo('ok');
}
?>