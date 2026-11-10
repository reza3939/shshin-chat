<?php
$chat = $options['chat_prefix'];
if(session('id')){header::Go(url($chat));exit();}
setcookie('testcookie', '1');
//if(session("token2")==""): token2(); endif;
$sql->where("expiration",0, '!=');
$sql->where("expiration", time(), '<');
$sql->delete('ads');
if (is_mobile_detect() && $options['mobiledetect'] == 'true' && is_file(theme::file('index.php', 'm')) && session('myOS') != 'pc') {
    $theme = 'm';
    include(theme::file('index.php', 'm'));
} else
if (is_file(theme::file('index.php'))) {
    include(theme::file('index.php'));
} else {
    include(theme::file('login.php'));
}
?>