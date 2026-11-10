<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'logintheme');
$theme = isset($_POST['theme']) ? safe::string($_POST['theme']) : '';
if ($theme == '') {
    echo('theme');
    return;
}
$newvalue = $theme;
if (substr($newvalue, 0, 5) != 'admin' and substr($newvalue, 0, 5) == 'theme') {
    if (is_dir('theme/' . $newvalue)) {
        $sql->where("name", 'chat_theme');
        $sql->update('options', array(
            'value' => $newvalue
        ));
        $sql->where("name", 'rootdirmanager');
        $sql->update('options', array(
            'value' => "theme/$newvalue/"
        ));
		echo('ok');
        chatroom::reloadconfig();
        chatroom::addlog('9', "قالب ورودی را به قالب $newvalue تغییر داد.");
    }
}
?>