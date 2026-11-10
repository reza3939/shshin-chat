<?php
if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'editbadwords');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');
include ('inc/badwords.php');
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
$error = false;
foreach ($badwords as $badword) {
    if ($badword['id'] != $id and $badword['word'] == $name){ 
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
    echo ('replace');
    return;
}
$general = isset($_POST['general']) ? safe::string($_POST['general']) : 0;
if ($general == 'true') {
    $general = '1';
} else {
    $general = '0';
}
$private = isset($_POST['private']) ? safe::string($_POST['private']) : 0;
if ($private == 'true') {
    $private = '1';
} else {
    $private = '0';
}
$profile = isset($_POST['profile']) ? safe::string($_POST['profile']) : 0;
if ($profile == 'true') {
    $profile = '1';
} else {
    $profile = '0';
}
$silent = isset($_POST['silent']) ? safe::string($_POST['silent']) : 0;
if ($silent == 'true') {
    $silent = '1';
} else {
    $silent = '0';
}
$robo_tablighat = isset($_POST['robo_tablighat']) ? safe::string($_POST['robo_tablighat']) : 0;
if ($robo_tablighat == 'true') {
    $robo_tablighat = '1';
} else {
    $robo_tablighat = '0';
}
$robo_cleaner = isset($_POST['robo_cleaner']) ? safe::string($_POST['robo_cleaner']) : 0;
if ($robo_cleaner == 'true') {
    $robo_cleaner = '1';
} else {
    $robo_cleaner = '0';
}
$output = "<?php\n";
foreach ($badwords as $badword) {
	    if ($badword['id'] == $id){ 
	   $output.= "\$badwords['{$id}'] = array('id' => '{$id}', 'word' => '{$name}', 'replace' => '{$replace}', 'general' => '{$general}', 'private' => '{$private}', 'profile' => '{$profile}','silent' => '{$silent}', 'offlinemsg' => '{$robo_cleaner}', 'tablighat' => '{$robo_tablighat}');\n";
	   continue;
	}
	    $output.= "\$badwords['{$badword['id']}'] = array('id' => '{$badword['id']}', 'word' => '{$badword['word']}', 'replace' => '{$badword['replace']}', 'general' => '{$badword['general']}', 'private' => '{$badword['private']}', 'profile' => '{$badword['profile']}','silent' => '{$badword['silent']}', 'offlinemsg' => '{$badword['offlinemsg']}', 'tablighat' => '{$badword['tablighat']}');\n";
}
$output.= '?>';
$f = fopen('inc/badwords.php', 'w');
fwrite($f, $output);
fclose($f);
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array(
    'id',
    'hide'
));
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "کلمه زشت را ویرایش کرد:$name");
}
echo ('ok');
?>