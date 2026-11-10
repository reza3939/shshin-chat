<?php
if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'delbadnames');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');
$id = safe::number($_POST['word']);
include ('inc/badnames.php');
$output = "<?php\n";
foreach ($badnames as $badname) {
    if ($badname['id'] == $id) {
        $word = $badname['word'];
        continue;
    }
    $output .= "\$badnames['{$badname['id']}'] = array('id' => '{$badname['id']}', 'word' => '{$badname['word']}','replace' => '{$badname['replace']}','canlogin' => '{$badname['canlogin']}', 'tablighat' => '{$badname['tablighat']}','autorename'=>'{$badname['autorename']}');\n";
}
$output .= '?>';
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
    chatroom::addlog('9', "نام کاربری زشت \"{$word}\" را آزاد کرد");
}
echo ('ok');
?>