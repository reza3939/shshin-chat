<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addbadwords');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')){
	    die('لطفا صفحه خود را رفرش کنيد');
}
$id = session('id');
/* * *********** BADWORDS SETTINGS********************** */
if (isset($_POST['intelligently_text'])) {
    $newvalue = 'true';
    $sql->where("name", "intelligently_text");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "intelligently_text");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['intelligently_badname'])) {
    $newvalue = 'true';
    $sql->where("name", "intelligently_badname");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "intelligently_badname");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['myword_badname'])) {
    $newvalue = 'true';
    $sql->where("name", "myword_badname");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "myword_badname");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['robo_silent'])) {
    $newvalue = 'true';
    $sql->where("name", "robo_silent");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "robo_silent");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['repeat_robo_silent'])) {
    $newvalue = safe::number($_POST['repeat_robo_silent']);
    $sql->where("name", "repeat_robo_silent");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['silent_time_robo'])) {
    $newvalue = safe::number($_POST['silent_time_robo']);
    $sql->where("name", "silent_time_robo");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
$useroptions = json_decode($options['useroptions'], true);

$newvalue = isset($_POST['chat_report_msg']) ? $_POST['chat_report_msg'] : array();
$newvalue = safe::arrayNumber($newvalue);
$useroptions['chat_report_msg'] = $newvalue;

$newvalue = isset($_POST['UsersForBann']) ? $_POST['UsersForBann'] : array();
$newvalue = safe::arrayNumber($newvalue);
$useroptions['UsersForBann'] = $newvalue;

$useroptions = json_encode($useroptions, JSON_UNESCAPED_UNICODE);
$sql->where("name", 'useroptions');
$sql->update('options', array(
    'value' => $useroptions
));
chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
	chatroom::addlog('9', "تنظیمات کلمات زشت را تغییر داد");
}
  $tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات کلمات زشت را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
 
       if($tel['sendsettinglog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>
