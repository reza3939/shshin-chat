<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'generalsettings');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')){
	    die('لطفا صفحه خود را رفرش کنيد');
}
$id = session('id');
/* * *********** GENERAL SETTINGS********************** */
if (isset($_POST['site_title'])) {
    $newvalue = safe::string($_POST['site_title']);
    $sql->where("name", "chat_site_title");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['site_url'])){
    $newvalue = safe::url($_POST['site_url']);
    $sql->where("name", "chat_site_url");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['profile_url'])) {
    $newvalue = safe::url($_POST['profile_url']);
    foreach($sql->get('profiles', null, array('id')) as $row) { 
    $sql->where("id", $row['id']);
    $sql->update("profiles", array(
        'site' => $newvalue
    ));
   }
    $sql->where("name", "profile_url");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['chat_prefix'])) {
  $oldvalue = $options['chat_prefix'];
    $newvalue = safe::string($_POST['chat_prefix']);
  rename("pages/$oldvalue.php", "pages/$newvalue.php");
    $sql->where("name", "chat_prefix");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['keywords'])) {
    $newvalue = safe::string($_POST['keywords']);
    $sql->where("name", "chat_keywords");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['description'])) {
    $newvalue = safe::string($_POST['description']);
    $sql->where("name", "chat_description");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['top_smilies'])) {
    $newvalue = safe::string($_POST['top_smilies']);
    $sql->where("name", "top_smilies");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['method_online_sort']) && in_array($_POST['method_online_sort'], array('sort_score', 'sort_name', 'type_score', 'type_name', 'default'))) {
    $newvalue = safe::string($_POST['method_online_sort']);
    $sql->where("name", "method_online_sort");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['defaultroom'])) {
    $newvalue = safe::number($_POST['defaultroom']);
    if (chatroom::checkroomid($newvalue)) {
    $sql->where("name", "chat_defaultroom");
    $sql->update("options", array(
        'value' => $newvalue
    ));
    }
}
if (isset($_POST['chat_prefix'])) {
	$oldvalue = $options['chat_prefix'];
	$newvalue = safe::string($_POST['chat_prefix']);
	rename("pages/{$oldvalue}.php", "pages/{$newvalue}.php");
	$sql->where('name', 'chat_prefix')->update('options', array(
		'value' => $newvalue
	));
}
if (isset($_POST['theme'])) {
    $newvalue = safe::filename($_POST['theme']);
    if (substr($newvalue, 0, 5) != 'admin') {
        if (is_dir('theme/' . $newvalue)) {
    $sql->where("name", "chat_theme");
    $sql->update("options", array(
        'value' => $newvalue
    ));
    $sql->where("name", "rootdirmanager");
    $sql->update("options", array(
        'value' => "theme/$newvalue/"
    ));
        }
    }
}

if (isset($_POST['outputtype'])) {
    $newvalue = 'json';
    $sql->where("name", "outputtype");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['rejecttowww'])) {
    $newvalue = 'true';
    $sql->where("name", "rejecttowww");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "rejecttowww");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['permitCPsmlies'])) {
    $newvalue = 'true';
    $sql->where("name", "permitCPsmlies");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "permitCPsmlies");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['ekhrajer'])) {
    $newvalue = 'true';
    $sql->where("name", "ekhrajer");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "ekhrajer");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['ekhrajername'])) {
    $newvalue = safe::string($_POST['ekhrajername']);
    $sql->where("name", "ekhrajername");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
/*if (isset($_POST['Questionexit'])) {
    $newvalue = 'true';
    $sql->where("name", "Questionexit");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "Questionexit");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}*/
chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
	chatroom::addlog('9', "تنظیمات اصلی  را تغییر داد");
}
  $tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات اصلی  را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
 
       if($tel['sendsettinglog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>
