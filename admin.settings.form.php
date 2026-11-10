<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'settingssocial');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');
$userscore = safe::number($_POST['userscore']) == '1' ? 'list' : 'vip';
$addimage = safe::number($_POST['addimage']) == '1' ? 'list' : 'vip';
$gameonline = safe::number($_POST['gameonline']) == '1' ? 'list' : 'vip';
$faal = safe::number($_POST['faal']) == '1' ? 'list' : 'vip';
$love = safe::number($_POST['love']) == '1' ? 'list' : 'vip';
$offmsg = safe::number($_POST['offmsg']) == '1' ? 'list' : 'vip';
if(!db::num('options',"`name`='formsetting'")){
	db::query("INSERT INTO `ahyir_options`(`id`, `name`, `value`) VALUES (NULL, 'formsetting','{}')");
}
$data = array('addimage' => $addimage, 'userscore' => $userscore, 'gameonline' => $gameonline, 'faal' => $faal, 'love' => $love, 'offmsg' => $offmsg);
$sql->where("name", 'formsetting');
    $sql->update('options', array(
        'value' => json_encode($data, JSON_UNESCAPED_UNICODE)
));
chatroom::reloadconfig();
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تنظیمات بخش گزینه های کادر ارسال را تغییر داد");
}
 $tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات بخش گزینه های کادر ارسال را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['sendLimitationslog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>