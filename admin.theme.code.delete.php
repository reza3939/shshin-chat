<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'theme');
$code = isset($_POST['id']) ? safe::number($_POST['id']) : '';
if ($code == '') {
    echo('id');
    return;
}
$sql->where("id", $code);
if($code = $sql->getOne('codes')){
    $sql->where("id", $code['id']);
    $sql->delete('codes');

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "کد با عنوان \"{$code['title']}\" را حذف کرد");
}

  $tel = json_decode($options['teloptions'], true);
   $text = "کد با عنوان \"{$code['title']}\" را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    tlg($text,'designer');
       if($tel['sendjavacodelog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
}
?>