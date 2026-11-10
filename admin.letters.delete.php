<?php

if (!session('id') or session('admin') == '0')
    exit();
adminpanel::check_Permission('exit', 'delletters');
$letter = isset($_POST['letter']) ? safe::number($_POST['letter']) : '';
$sql->where("id", $letter);
if ($letter = $sql->getOne('letters')) {
    if ($letter['to'] == session('id')) {
        $sql->where("id", $letter['id']);
        $sql->delete('letters');

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
        chatroom::addlog('9', "نامه ای با عنوان \"{$letter['subject']}\" را حذف نمود");
}
  $tel = json_decode($options['teloptions'], true);
   $text = "نامه ای با عنوان \"{$letter['subject']}\" را حذف نمود\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['senddelletterslog'] == 'Sure'){
             tlg($text,'chat');
                 }
        echo('ok');
    } else {
        echo('nottoyou');
    }
} else {
    echo('worngid');
}
?>