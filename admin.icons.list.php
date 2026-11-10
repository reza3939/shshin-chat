<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'theme');
if (
        ($_FILES['bgwand']['size'] == 0) &&
        ($_FILES['user_online']['size'] == 0) &&
        ($_FILES['imard']['size'] == 0) &&
        ($_FILES['izan']['size'] == 0) &&
        ($_FILES['ina']['size'] == 0) &&
        ($_FILES['imgload']['size'] == 0) &&
        ($_FILES['status_private']['size'] == 0) &&
        ($_FILES['defmale']['size'] == 0) &&
        ($_FILES['profile']['size'] == 0) &&
        ($_FILES['deffemale']['size'] == 0) &&
         ($_FILES['deffecover']['size'] == 0) &&
        ($_FILES['user_comment_m_self']['size'] == 0) &&
        ($_FILES['user_comment_n_self']['size'] == 0) &&
        ($_FILES['user_comment_w_self']['size'] == 0) &&
        ($_FILES['idle']['size'] == 0)) {
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
if ($_FILES['bgwand']['size'] > 0) {
    $link = "theme/images/chat/chat.wand.png";
    move_uploaded_file($_FILES['bgwand']['tmp_name'], $link);
}
if ($_FILES['profile']['size'] > 0) {
    $link = "theme/images/chat/chat.pr.png";
    move_uploaded_file($_FILES['profile']['tmp_name'], $link);
}
if ($_FILES['imard']['size'] > 0) {
    $link = "theme/images/chat/chat.user_comment_m.png";
    move_uploaded_file($_FILES['imard']['tmp_name'], $link);
}
if ($_FILES['izan']['size'] > 0) {
    $link = "theme/images/chat/chat.user_comment_w.png";
    move_uploaded_file($_FILES['izan']['tmp_name'], $link);
}
if ($_FILES['ina']['size'] > 0) {
    $link = "theme/images/chat/chat.user_comment_n.png";
    move_uploaded_file($_FILES['ina']['tmp_name'], $link);
}
if ($_FILES['imgload']['size'] > 0) {
    $link = "theme/images/chat/chat.ajax-loader.gif";
    move_uploaded_file($_FILES['imgload']['tmp_name'], $link);
}
if ($_FILES['idle']['size'] > 0) {
    $link = "theme/images/status/status_idle.png";
    move_uploaded_file($_FILES['idle']['tmp_name'], $link);
}

if ($_FILES['status_private']['size'] > 0) {
    $link = "theme/images/status/status_private.png";
    move_uploaded_file($_FILES['status_private']['tmp_name'], $link);
}

if ($_FILES['deffecover']['size'] > 0) {
    $link = "theme/microblog/images/cover.jpg";
    move_uploaded_file($_FILES['deffecover']['tmp_name'], $link);
}

$options['thumbavatarSize'] = explode('*', $options['thumbavatarSize']);
    list($width, $height) = $options['thumbavatarSize'];
if ($_FILES['defmale']['size'] > 0) {
    $link = "theme/images/default/no_avatar_male.png";
    move_uploaded_file($_FILES['defmale']['tmp_name'], $link);
    copy("theme/images/default/no_avatar_male.png", "{$options['avatar_dir']}/no_avatar_male.png");
    $image = new ImageResizer();
    $image->load("{$options['avatar_dir']}/no_avatar_male.png");
    $image->resize($width, $height);
    $image->save("{$options['avatar_dir']}/$width-$height/maledefualt.png");
  
}
if ($_FILES['deffemale']['size'] > 0) {
    $link = "theme/images/default/no_avatar_female.jpg";
    move_uploaded_file($_FILES['deffemale']['tmp_name'], $link);
    copy("theme/images/default/no_avatar_female.jpg", "{$options['avatar_dir']}/no_avatar_female.jpg");  
     $image = new ImageResizer();
    $image->load("{$options['avatar_dir']}/no_avatar_female.jpg");
    $image->resize($width, $height);
    $image->save("{$options['avatar_dir']}/$width-$height/femaledefualt.jpg");

}
                
if ($_FILES['defmale']['size'] > 0) {
    $link = "theme/images/avatars/no_avatar_male.png";
    move_uploaded_file($_FILES['defmale']['tmp_name'], $link);
}
if ($_FILES['deffemale']['size'] > 0) {
    $link = "theme/images/avatars/no_avatar_female.jpg";
    move_uploaded_file($_FILES['deffemale']['tmp_name'], $link);
}
if ($_FILES['user_comment_w_self']['size'] > 0) {
    $link = "theme/images/chat/chat.user_comment_w_self.png";
    move_uploaded_file($_FILES['user_comment_w_self']['tmp_name'], $link);
}
if ($_FILES['user_comment_m_self']['size'] > 0) {
    $link = "theme/images/chat/chat.user_comment_m_self.png";
    move_uploaded_file($_FILES['user_comment_m_self']['tmp_name'], $link);
}
if ($_FILES['user_comment_n_self']['size'] > 0) {
    $link = "theme/images/chat/chat.user_comment_n_self.png";
    move_uploaded_file($_FILES['user_comment_n_self']['tmp_name'], $link);
}
if ($_FILES['user_online']['size'] > 0) {
    $link = "theme/images/chat/chat.user_online.gif";
    move_uploaded_file($_FILES['user_online']['tmp_name'], $link);
}
echo "ok";
?>