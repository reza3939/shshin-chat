<?php

if (!session('id') or session('admin') == '0') {
    exit('No hack AND bots Ye Babye :D sheytooni mamnoo :D');
}
adminpanel::check_Permission('exit', 'settingsseo');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}
/* * *********** seo SETTINGS********************** */
if(isset($_POST['google_code'])){
    $newvalue = safe::string($_POST['google_code']);
    $sql->where("name", "google_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['googleplus_code'])){
    $newvalue = safe::string($_POST['googleplus_code']);
    $sql->where("name", "googleplus_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['samandehi_code'])){
    $newvalue = safe::string($_POST['samandehi_code']);
    $sql->where("name", "samandehi_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['h1_code'])){
    $newvalue = safe::string($_POST['h1_code']);
    $sql->where("name", "h1_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['h2_code'])){
    $newvalue = safe::string($_POST['h2_code']);
    $sql->where("name", "h2_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['h3_code'])){
    $newvalue = safe::string($_POST['h3_code']);
    $sql->where("name", "h3_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['h4_code'])){
    $newvalue = safe::string($_POST['h4_code']);
    $sql->where("name", "h4_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['h5_code'])){
    $newvalue = safe::string($_POST['h5_code']);
    $sql->where("name", "h5_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link1_code'])){
    $newvalue = safe::string($_POST['link1_code']);
    $sql->where("name", "link1_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link2_code'])){
    $newvalue = safe::string($_POST['link2_code']);
    $sql->where("name", "link2_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link3_code'])){
    $newvalue = safe::string($_POST['link3_code']);
    $sql->where("name", "link3_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link4_code'])){
    $newvalue = safe::string($_POST['link4_code']);
    $sql->where("name", "link4_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link5_code'])){
    $newvalue = safe::string($_POST['link5_code']);
    $sql->where("name", "link5_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link6_code'])){
    $newvalue = safe::string($_POST['link6_code']);
    $sql->where("name", "link6_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link7_code'])){
    $newvalue = safe::string($_POST['link7_code']);
    $sql->where("name", "link7_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link8_code'])){
    $newvalue = safe::string($_POST['link8_code']);
    $sql->where("name", "link8_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link9_code'])){
    $newvalue = safe::string($_POST['link9_code']);
    $sql->where("name", "link9_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link10_code'])){
    $newvalue = safe::string($_POST['link10_code']);
    $sql->where("name", "link10_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link11_code'])){
    $newvalue = safe::string($_POST['link11_code']);
    $sql->where("name", "link11_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link12_code'])){
    $newvalue = safe::string($_POST['link12_code']);
    $sql->where("name", "link12_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link13_code'])){
    $newvalue = safe::string($_POST['link13_code']);
    $sql->where("name", "link13_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link14_code'])){
    $newvalue = safe::string($_POST['link14_code']);
    $sql->where("name", "link14_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link15_code'])){
    $newvalue = safe::string($_POST['link15_code']);
    $sql->where("name", "link15_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link16_code'])){
    $newvalue = safe::string($_POST['link16_code']);
    $sql->where("name", "link16_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['link17_code'])){
    $newvalue = safe::string($_POST['link17_code']);
    $sql->where("name", "link17_code");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

chatroom::reloadconfig();


$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تنظیمات سئو را تغییر داد");
}
  $tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات سئو را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    tlg($text,'designer');
       if($tel['sendsettinglog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>