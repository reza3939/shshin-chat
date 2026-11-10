<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addbadnames');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}
include ('inc/badnames.php');
$word = isset($_POST['word']) ? safe::string($_POST['word']) : '';
if ($word == '') {
    echo('word');
    return;
}
$error = false;
foreach ($badnames as $badname) {
    if ($badname['word'] == $word){ 
	     $error = true;
		 break;
	}
}
if ($error) {
    echo ("repeatword");
    return;
}
$replace = isset($_POST['replace']) ? safe::string($_POST['replace']) : '';
if ($replace == '') {
    echo('replace');
    return;
}
$canlogin = isset($_POST['canlogin']) ? safe::string($_POST['canlogin']) : 0;

if ($canlogin == 'true') {
    $canlogin = '1';
} else {
    $canlogin = '0';
}
$robo_tablighat = isset($_POST['robo_tablighat']) ? safe::string($_POST['robo_tablighat']) : 0;
if ($robo_tablighat == 'true') {
    $robo_tablighat = '1';
} else {
    $robo_tablighat = '0';
}
$autorename = isset($_POST['autorename']) ? safe::string($_POST['autorename']) : 0;
if ($autorename == 'true') {
    $autorename = '1';
} else {
    $autorename = '0';
}

$ids = str_shuffle(rand(1,9999));
$file = file_get_contents('inc/badnames.php');
$f = fopen('inc/badnames.php', 'w');
$output  = "<?php\n";
$output .= str_replace(array('<?php','?>',"\n"),"",$file);
$output .= "\$badnames['{$ids}'] = array('id' => '{$ids}', 'word' => '{$word}','replace' => '{$replace}', 'canlogin' => '{$canlogin}', 'tablighat' => '{$robo_tablighat}','autorename'=>'{$autorename}');\n";
$output .= '?>';
fwrite($f, $output);
fclose($f);

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "کلمه ای به نام های کابری زشت اضافه شد : $word");
} 
echo('ok');
?>