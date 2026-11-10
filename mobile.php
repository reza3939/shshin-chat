<?php
if (is_mobile_detect()) {
    $theme = 'mobile';
    $id = session('id');
    $me = db::get('onlines', '`id`,`type`,`gender`,`score`,`type`,`inputs`,`name`', "`id`='$id'");
    if (!$me) {
        if ($user = db::get('users', "`id`,`username`,`name`,`type`,`gender`,`type`", "`id`='$id'")) {
            $room = session('room');
            Users::addOnline($id, $user['username'], $user['name'], $user['gender'], $user['type'], session('hide'), $room, chatroom::getNameRoom($room));
        } else {
            header::Go(url('login'));
            exit();
        }
        $me = db::get('onlines', '`id`,`type`,`gender`,`score`,`type`,`inputs`,`name`', "`id`='$id'");
    }
    $temp = json_decode($me['inputs'], true);
    unset($temp['score']);
    if (is_array($temp)) {
        $me += $temp;
    }
    include(theme::file('mobile.php'));
} else {
    $chat = $options['chat_prefix'];
    include("pages/$chat.php");
}
?>