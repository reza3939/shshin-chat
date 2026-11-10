<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'pmwlc');
/* * *********** TEXT SETTINGS********************** */
$pmwlc = json_decode($options['pmwlc'], true);

if (isset($_POST['wlcchat'])) {
    $pmwlc['wlcchat'] = 'true';
} else {
    $pmwlc['wlcchat'] = 'false';
}

$newvalue = isset($_POST['headtitle_color']) ? safe::hexColor($_POST['headtitle_color']) : array();
$pmwlc['headtitle_color'] = $newvalue;

$newvalue = isset($_POST['title_color']) ? safe::hexColor($_POST['title_color']) : array();
$pmwlc['title_color'] = $newvalue;


$newvalue = isset($_POST['pmone_color']) ? safe::hexColor($_POST['pmone_color']) : array();
$pmwlc['pmone_color'] = $newvalue;

$newvalue = isset($_POST['Fsturl_color']) ? safe::hexColor($_POST['Fsturl_color']) : array();
$pmwlc['Fsturl_color'] = $newvalue;

$newvalue = isset($_POST['Securl_color']) ? safe::hexColor($_POST['Securl_color']) : array();
$pmwlc['Securl_color'] = $newvalue;

$newvalue = isset($_POST['thdurl_color']) ? safe::hexColor($_POST['thdurl_color']) : array();
$pmwlc['thdurl_color'] = $newvalue;

$newvalue = isset($_POST['pm_color']) ? safe::hexColor($_POST['pm_color']) : array();
$pmwlc['pm_color'] = $newvalue;

$newvalue = isset($_POST['id_color']) ? safe::hexColor($_POST['id_color']) : array();
$pmwlc['id_color'] = $newvalue;

$newvalue = isset($_POST['pmelse_color']) ? safe::hexColor($_POST['pmelse_color']) : array();
$pmwlc['pmelse_color'] = $newvalue;

$newvalue = isset($_POST['head_Title']) ? safe::string($_POST['head_Title']) : array();
$pmwlc['head_Title'] = $newvalue;

$newvalue = isset($_POST['Title']) ? safe::string($_POST['Title']) : array();
$pmwlc['Title'] = $newvalue;

$newvalue = isset($_POST['pm_one']) ? safe::string($_POST['pm_one']) : array();
$pmwlc['pm_one'] = $newvalue;

$newvalue = isset($_POST['Fst_url']) ? safe::string($_POST['Fst_url']) : array();
$pmwlc['Fst_url'] = $newvalue;


$newvalue = isset($_POST['Sec_url']) ? safe::string($_POST['Sec_url']) : array();
$pmwlc['Sec_url'] = $newvalue;

$newvalue = isset($_POST['thd_url']) ? safe::string($_POST['thd_url']) : array();
$pmwlc['thd_url'] = $newvalue;

$newvalue = isset($_POST['pm_link']) ? safe::string($_POST['pm_link']) : array();
$pmwlc['pm_link'] = $newvalue;

$newvalue = isset($_POST['id_tel']) ? safe::string($_POST['id_tel']) : '';
$pmwlc['id_tel'] = $newvalue;

$newvalue = isset($_POST['link']) ? safe::string($_POST['link']) : '';
$pmwlc['link'] = $newvalue;

$newvalue = isset($_POST['pm_else']) ? safe::string($_POST['pm_else']) : '';
$pmwlc['pm_else'] = $newvalue;

 $pmwlc = json_encode($pmwlc, JSON_UNESCAPED_UNICODE);
    $sql->where("name", "pmwlc");
    $sql->update("options", array(
        'value' => $pmwlc
    ));
chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تنظیمات باکس خوش آمدگوی را تغییر داد");
}

  $tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات باکس خوش آمدگوی را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendsettinglog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>