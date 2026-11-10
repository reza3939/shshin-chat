<?php
if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'delbadwords');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');
$id = safe::string($_POST['word']);
include('inc/badwords.php');
$output = "<?php\n";
foreach ($badwords as $badword) {
    if ($badword['id'] == $id) {
        $word = $badword['word'];
        continue;
    }
    $output .= "\$badwords['{$badword['id']}'] = array('id' => '{$badword['id']}', 'word' => '{$badword['word']}', 'replace' => '{$badword['replace']}', 'general' => '{$badword['general']}', 'private' => '{$badword['private']}', 'profile' => '{$badword['profile']}','silent' => '{$badword['silent']}', 'offlinemsg' => '{$badword['offlinemsg']}', 'tablighat' => '{$badword['tablighat']}');\n";
}
$output .= '?>';
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
    chatroom::addlog('9', "کلمه \"{$word}\" را آزاد کرد");
}
echo ('ok');
?>