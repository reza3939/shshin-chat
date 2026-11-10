<?php
if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'editbadnames');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');
include ('inc/badnames.php');
$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';
if ($id == '') {
    echo ('id');
    return;
}
$name = isset($_POST['word']) ? safe::string($_POST['word']) : '';
if ($name == '') {
    echo ('word');
    return;
}
$replace = isset($_POST['replace']) ? safe::string($_POST['replace']) : '';
if ($replace == '') {
    echo('replace');
    return;
}
$error = false;
foreach ($badnames as $badname) {
    if ($badname['id'] != $id and $badname['word'] == $name){ 
	     $error = true;
		 break;
	}
}
if ($error) {
    echo ("repeatword");
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
$output = "<?php\n";
foreach ($badnames as $badname) {
	    if ($badname['id'] == $id){ 
	   $output .= "\$badnames['{$id}'] = array('id' => '{$id}', 'word' => '{$name}', 'replace' => '{$replace}', 'canlogin' => '{$canlogin}', 'tablighat' => '{$robo_tablighat}','autorename'=>'{$autorename}');\n";
	   continue;
	}
	   $output .= "\$badnames['{$badname['id']}'] = array('id' => '{$badname['id']}', 'word' => '{$badname['word']}', 'replace' => '{$badname['replace']}', 'canlogin' => '{$badname['canlogin']}', 'tablighat' => '{$badname['tablighat']}','autorename'=>'{$badname['autorename']}');\n";
}
$output.= '?>';
$f = fopen('inc/badnames.php', 'w');
fwrite($f, $output);
fclose($f);
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array(
    'id',
    'hide'
));
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "نام کاربری زشت را ویرایش کرد : $name");
}
echo ('ok');
?>