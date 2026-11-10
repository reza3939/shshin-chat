<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'msgsettings');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');
/* * *********** Messages SETTINGS********************** */

if (isset($_POST['speedmsgenable'])) {
    $newvalue = isset($_POST['speedmsg']) ? safe::number($_POST['speedmsg']) : 0;
    if ($newvalue != 0) {
        $sql->where("name", 'chat_speedmsg');
        $sql->update('options', array(
            'value' => $newvalue
        ));
    }
} else {
    $newvalue = '0';
        $sql->where("name", 'chat_speedmsg');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if (isset($_POST['numsgmain'])) {
    $newvalue = safe::number($_POST['numsgmain']);
        $sql->where("name", 'chat_numsgmain');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}

if (isset($_POST['sendmsguest'])) {
    $newvalue = 'true';
        $sql->where("name", 'chat_sendmsguest');
        $sql->update('options', array(
            'value' => $newvalue
        ));
} else {
    $newvalue = 'false';
        $sql->where("name", 'chat_sendmsguest');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if (isset($_POST['scoretosendmsg'])) {
    $newvalue = safe::number($_POST['scoretosendmsg']);
        $sql->where("name", 'scoretosendmsg');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if (isset($_POST['repeatmsg'])) {
    $newvalue = safe::number($_POST['repeatmsg']);
        $sql->where("name", 'repeatmsg');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if (isset($_POST['SmiliespMsg'])) {
    $newvalue = safe::number($_POST['SmiliespMsg']);
        $sql->where("name", 'SmiliespMsg');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if (isset($_POST['resemblance'])) {
    $newvalue = safe::number($_POST['resemblance']);
    if ($newvalue < 0 or $newvalue > 99)
        $newvalue = 0;
        $sql->where("name", 'resemblance');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if (isset($_POST['reply'])) {
    $newvalue = 'true';
        $sql->where("name", 'reply');
        $sql->update('options', array(
            'value' => $newvalue
        ));
} else {
    $newvalue = 'false';
        $sql->where("name", 'reply');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if (isset($_POST['forwardtext'])) {
    $newvalue = 'true';
        $sql->where("name", 'forwardtext');
        $sql->update('options', array(
            'value' => $newvalue
        ));
} else {
    $newvalue = 'false';
        $sql->where("name", 'forwardtext');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if (isset($_POST['deletetext'])) {
    $newvalue = 'true';
        $sql->where("name", 'deletetext');
        $sql->update('options', array(
            'value' => $newvalue
        ));

} else {
    $newvalue = 'false';
        $sql->where("name", 'deletetext');
        $sql->update('options', array(
            'value' => $newvalue
        ));

}
if (isset($_POST['edittext'])) {
    $newvalue = 'true';
        $sql->where("name", 'edittext');
        $sql->update('options', array(
            'value' => $newvalue
        ));
} else {
    $newvalue = 'false';
        $sql->where("name", 'edittext');
        $sql->update('options', array(
            'value' => $newvalue
        ));
}
if(isset($_POST['score_msg_status'])){
    $status = isset($_POST['score_msg_status']) ? 'true' : 'false';
    $score  = safe::number($_POST['score_msg_score']);
	$num    = safe::number($_POST['score_msg_num']);
    $json   = json_encode(array("status" => $status, "score" => $score,'num' => $num), JSON_UNESCAPED_UNICODE);
    $sql->where("name",'score_msg');
    $sql->update('options', array(
        'value' => $json
    ));
}
$useroptions = json_decode($options['msgoptions'], true);

$newvalue = isset($_POST['allowforward']) ? $_POST['allowforward'] : array();
$newvalue = safe::arrayNumber($newvalue);
$useroptions['allowforward'] = $newvalue;

$newvalue = isset($_POST['allowdelmsg']) ? $_POST['allowdelmsg'] : array();
$newvalue = safe::arrayNumber($newvalue);
$useroptions['allowdelmsg'] = $newvalue;

$newvalue = isset($_POST['alloweditmsg']) ? $_POST['alloweditmsg'] : array();
$newvalue = safe::arrayNumber($newvalue);
$useroptions['alloweditmsg'] = $newvalue;

$newvalue = isset($_POST['reply']) ? $_POST['reply'] : array();
$newvalue = safe::arrayNumber($newvalue);
$useroptions['reply'] = $newvalue;

$useroptions = json_encode($useroptions, JSON_UNESCAPED_UNICODE);
$sql->where('name', 'msgoptions')->update('options', array(
	'value' => $useroptions
));
$useroptionss = json_decode($options['useroptions'], true);

$newvalue = isset($_POST['reply']) ? $_POST['reply'] : array();
$newvalue = safe::arrayNumber($newvalue);
$useroptionss['reply'] = $newvalue;

$newvalue = isset($_POST['score_msg']) ? $_POST['score_msg'] : array();
$newvalue = safe::arrayNumber($newvalue);
$useroptionss['score_msg'] = $newvalue;

$useroptionss = json_encode($useroptionss, JSON_UNESCAPED_UNICODE);
$sql->where('name', 'useroptions')->update('options', array(
	'value' => $useroptionss
));
chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تنظیمات پیام ها را تغییر داد");
}

  $tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات پیام ها را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendsettinglog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>
