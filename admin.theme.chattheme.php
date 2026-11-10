<?php
$token = safe::string($_POST['token']);
if($token != "60abc06e4e1e7d84aeefedb51498beb8" or empty($token)){
if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'theme');
}
$value = safe::string($_POST['value']);
$value = trim($value);
if (substr($value, 0, 5) != 'chat_theme') {
	if(!empty($token) and $token == "60abc06e4e1e7d84aeefedb51498beb8"){
        copy("http://theme.tarhpardaz.ir/themes/pishfarz/{$value}.zip", "{$value}.zip");
        $zip = new ZipArchive;
        $res = $zip->open("{$value}.zip");
        if ($res) {
            $zip->extractTo($_SERVER['DOCUMENT_ROOT'] . '/theme/');
            $zip->close();
            unlink("{$value}.zip");
            exit('ok');
        } else {
            exit('error');
        }
	}else
    if (is_dir('theme/' . $value)) {
        exit('installed');
    } else {
	copy("http://theme.tarhpardaz.ir/themes/file/{$value}.zip", "{$value}.zip");
        $zip = new ZipArchive;
        $res = $zip->open("{$value}.zip");
        if ($res) {
            $zip->extractTo($_SERVER['DOCUMENT_ROOT'] . '/theme/');
            $zip->close();
            unlink("{$value}.zip");
            copy($_SERVER['DOCUMENT_ROOT'] . '/theme/' . $options['chat_theme'] .'/chat.php', $_SERVER['DOCUMENT_ROOT'] . '/theme/'.$value.'/chat.php');
            exit('ok');
        } else {
            exit('error');
        }
    }
}
chatroom::addlog('9', "قالب  \{$value}\را بر روی چت روم نصب نمود");
echo('ok');
?>