<?php

if (!session('id')) {
    header::Go(url('login'));
    exit();
}
if ($options['chat_history_enable'] == 'true') {
    $defualtroom = chatroom::defaultRoom();
    include(theme::file("history.php", $options['chat_history_theme']));
}
?>