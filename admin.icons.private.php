<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'iconprivate');
if (($_FILES['Checked_small']['size'] == 0) &&
        ($_FILES['Smiley_small']['size'] == 0) &&
        ($_FILES['buzz']['size'] == 0) &&
        ($_FILES['blocker_small']['size'] == 0) &&
        ($_FILES['eraser']['size'] == 0) &&
        ($_FILES['status_check']['size'] == 0) &&
        ($_FILES['gozaresh']['size'] == 0) &&
        ($_FILES['upload_images_private']['size'] == 0) &&
        ($_FILES['privat']['size'] == 0) &&
        ($_FILES['cfinviter']['size'] == 0) &&
        ($_FILES['videochat_small']['size'] == 0) &&
        ($_FILES['friend_add']['size'] == 0)) {
    exit("nofile");
}
if(!empty($_FILES)) {
    $e = $_FILES;
    foreach($_FILES as $key => $s) {
        $e = $key;
        if($_FILES[$e]['name'] != '') {
            $type = $_FILES[$e]['type'];
            if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/gif') {
                exit('type');
                break;
            } else {
                switch($type) {
                    case ('image/png'):
                        $format = 'png';
                       break;
                    case ('image/jpeg'):
                        $format = 'jpg';
                        break;
                    case ('image/gif'):
                        $format = 'gif';
                        break;
                }
            }
        }
    
	}
	}
if ($_FILES['Checked_small']['size'] > 0) {
    $link = "theme/images/chat/Checked_small.png";
    move_uploaded_file($_FILES['Checked_small']['tmp_name'], $link);
}
if ($_FILES['Smiley_small']['size'] > 0) {
    $link = "theme/images/chat/Smiley_small.png";
    move_uploaded_file($_FILES['Smiley_small']['tmp_name'], $link);
}
if ($_FILES['buzz']['size'] > 0) {
    $link = "theme/images/chat/buzz.png";
    move_uploaded_file($_FILES['buzz']['tmp_name'], $link);
}
if ($_FILES['blocker_small']['size'] > 0) {
    $link = "theme/images/chat/blocker_small.png";
    move_uploaded_file($_FILES['blocker_small']['tmp_name'], $link);
}
if ($_FILES['eraser']['size'] > 0) {
    $link = "theme/images/chat/eraser.png";
    move_uploaded_file($_FILES['eraser']['tmp_name'], $link);
}
if ($_FILES['status_check']['size'] > 0) {
    $link = "theme/images/chat/status_check.png";
    move_uploaded_file($_FILES['status_check']['tmp_name'], $link);
}
if ($_FILES['gozaresh']['size'] > 0) {
    $link = "theme/images/chat/gozaresh.png";
    move_uploaded_file($_FILES['gozaresh']['tmp_name'], $link);
}
if ($_FILES['upload_images_private']['size'] > 0) {
    $link = "theme/images/chat/upload_images_private.png";
    move_uploaded_file($_FILES['upload_images_private']['tmp_name'], $link);
}
if ($_FILES['privat']['size'] > 0) {
    $link = "theme/images/chat/silent.privat.png";
    move_uploaded_file($_FILES['privat']['tmp_name'], $link);
}
if ($_FILES['cfinviter']['size'] > 0) {
    $link = "theme/images/chat/chat.cfinviter.png";
    move_uploaded_file($_FILES['cfinviter']['tmp_name'], $link);
}
if ($_FILES['friend_add']['size'] > 0) {
    $link = "theme/images/chat/chat.friend_add.png";
    move_uploaded_file($_FILES['friend_add']['tmp_name'], $link);
}
if ($_FILES['videochat_small']['size'] > 0) {
    $link = "theme/images/chat/videochat_small.png";
    move_uploaded_file($_FILES['videochat_small']['tmp_name'], $link);
}

echo "ok";
?>