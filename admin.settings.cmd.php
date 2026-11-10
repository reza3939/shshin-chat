<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'cmdsettings');
/************* User Options SETTINGS***********************/
$cmd_options = json_decode($options['cmd_options'], true);


$newvalue = isset($_POST['online']) ? $_POST['online'] : array();
if ( isset($newvalue[0]) AND $newvalue[0] == 1 )  $newvalue[0] = 'yes';
else $newvalue[0] = 'no';
if ( isset($newvalue[2]) AND $newvalue[2] == 1 )  $newvalue[2] = 'enable';
else $newvalue[2] = 'disable';
if ( isset($newvalue[1]) AND  $newvalue[1] > 0 )  $newvalue[1] = $newvalue[1];
else $newvalue[1] = 0;
$cmd_options['online'] = $newvalue;

$newvalue = isset($_POST['sex']) ? $_POST['sex'] : array();
if ( isset($newvalue[0]) AND $newvalue[0] == 1 )  $newvalue[0] = 'yes';
else $newvalue[0] = 'no';
if ( isset($newvalue[2]) AND $newvalue[2] == 1 )  $newvalue[2] = 'enable';
else $newvalue[2] = 'disable';
if ( isset($newvalue[1]) AND  $newvalue[1] > 0 )  $newvalue[1] = $newvalue[1];
else $newvalue[1] = 0;
$cmd_options['sex'] = $newvalue;

$newvalue = isset($_POST['active']) ? $_POST['active'] : array();
if ( isset($newvalue[0]) AND $newvalue[0] == 1 )  $newvalue[0] = 'yes';
else $newvalue[0] = 'no';
if ( isset($newvalue[2]) AND $newvalue[2] == 1 )  $newvalue[2] = 'enable';
else $newvalue[2] = 'disable';
if ( isset($newvalue[1]) AND  $newvalue[1] > 0 )  $newvalue[1] = $newvalue[1];
else $newvalue[1] = 0;
$cmd_options['active'] = $newvalue;

$newvalue = isset($_POST['onlinetime']) ? $_POST['onlinetime'] : array();
if ( isset($newvalue[0]) AND $newvalue[0] == 1 )  $newvalue[0] = 'yes';
else $newvalue[0] = 'no';
if ( isset($newvalue[2]) AND $newvalue[2] == 1 )  $newvalue[2] = 'enable';
else $newvalue[2] = 'disable';
if ( isset($newvalue[1]) AND  $newvalue[1] > 0 )  $newvalue[1] = $newvalue[1];
else $newvalue[1] = 0;
$cmd_options['onlinetime'] = $newvalue;

$newvalue = isset($_POST['myip']) ? $_POST['myip'] : array();
if ( isset($newvalue[0]) AND $newvalue[0] == 1 )  $newvalue[0] = 'yes';
else $newvalue[0] = 'no';
if ( isset($newvalue[2]) AND $newvalue[2] == 1 )  $newvalue[2] = 'enable';
else $newvalue[2] = 'disable';
if ( isset($newvalue[1]) AND  $newvalue[1] > 0 )  $newvalue[1] = $newvalue[1];
else $newvalue[1] = 0;
$cmd_options['myip'] = $newvalue;

$newvalue = isset($_POST['username']) ? $_POST['username'] : array();
if ( isset($newvalue[0]) AND $newvalue[0] == 1 )  $newvalue[0] = 'yes';
else $newvalue[0] = 'no';
if ( isset($newvalue[2]) AND $newvalue[2] == 1 )  $newvalue[2] = 'enable';
else $newvalue[2] = 'disable';
if ( isset($newvalue[1]) AND  $newvalue[1] > 0 )  $newvalue[1] = $newvalue[1];
else $newvalue[1] = 0;
$cmd_options['username'] = $newvalue;


$cmd_options = json_encode($cmd_options, JSON_UNESCAPED_UNICODE);
$sql->where('name', 'cmd_options')->update('options', array(
	'value' => $cmd_options
));


chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "اجرای دستورات های کاربری را تغییر داد");
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
