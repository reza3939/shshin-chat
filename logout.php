<?php

$token = giu('el2');
if (!session('changepw')) {
    include(theme::file('logout.php'));
    exit;
}
if (session('changepw') != $token){
    exit('error!');
}
if (session('id')) {
    Users::Offline(session('id'));
}
$newsession = array();
if (session('ui')) {
    $newsession['chat_ui'] = session('ui');
}
$_SESSION = $newsession;
//include('inc/classes/file.php');
$time = time();
$temps = file::listDirectory('./', true, false);
foreach ($temps as $temp) {
    if (substr(basename($temp), 0, 4) == 'temp') {
        $t = fileatime($temp);
        if ($time - $t > 3600)
            unlink($temp);
    }
}
include(theme::file('logout.php'));
?>
