<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'deletestatos');

$id = safe::number($_POST['statos']);
$sql->where("id", $id);
if (!$statos = $sql->getOne('statos')) {
    echo('id');
    exit();
}

$sql->where("id", $id);
foreach($sql->get('statos', null, array('id','img')) as $statos ) { 
    if (is_file("theme/images/status/{$statos['img']}")) {
        unlink("theme/images/status/{$statos['img']}");
    }
    if (is_file('theme/images/status/' . status_ . $statos['id'] . _larg . ".png")) {
        unlink('theme/images/status/' . status_ . $statos['id'] . _larg . ".png");
    }
    if (is_file('theme/images/status/' . status_ . $statos['id'] . ".png")) {
        unlink('theme/images/status/' . status_ . $statos['id'] . ".png");
    }
$sql->where("id", $id);
$sql->delete('statos');

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "وضعیت\"{$statos['text']}\" را حذف کرد"); }
    
    echo('ok');
}

?>