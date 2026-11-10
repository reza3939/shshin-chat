<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'textsetting');
/* * *********** TEXT SETTINGS********************** */
if (isset($_POST['up_box'])) {
    $newvalue = safe::string($_POST['up_box']);
    $sql->where("name", 'up_box');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['down_box'])) {
    $newvalue = safe::string($_POST['down_box']);
    $sql->where("name", 'down_box');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['omomi_fild'])) {
    $newvalue = safe::string($_POST['omomi_fild']);
    $sql->where("name", 'omomi_fild');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['texttouserpv'])) {
    $newvalue = safe::string($_POST['texttouserpv']);
    $sql->where("name", 'texttouserpv');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تنظیمات متون داخل را تغییر داد"); 
}
  $tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات متون داخل را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
 
       if($tel['sendsettinglog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>
