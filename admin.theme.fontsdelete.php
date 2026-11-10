<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'deletefonts');

$id = safe::number($_POST['fonts']);

$sql->where("id", $id);
if(!$fonts = $sql->getOne('chatfonts')){
    echo('id');
    exit();
}
$sql->where("id", $id);
foreach($sql->get('chatfonts', null, array('id','name')) as $fonts) { 
    if (is_file('theme/chatfont/' . $fonts['id'] . ".woff")) {
        unlink('theme/chatfont/' . $fonts['id'] . ".woff");
    }
    if (is_file('theme/chatfont/' . $fonts['id'] . ".eot")) {
        unlink('theme/chatfont/' . $fonts['id'] . ".eot");
    }
    if (is_file('theme/chatfont/' . $fonts['id'] . ".ttf")) {
        unlink('theme/chatfont/' . $fonts['id'] . ".ttf");
    }
$sql->where("id", $id);
$sql->delete('chatfonts');
    chatroom::addlog('9', "فونت\"{$fonts['name']}\" را حذف کرد");
    echo('ok');
}
?>