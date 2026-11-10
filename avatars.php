<?php

check_session();
$user = giu('el2');
$size = giu('el3');
$size = explode('x', $size, 2);
$size[0] = safe::number($size[0]);
if (isset($size[1])) {
    $size[1] = safe::number($size[1]);
    if ($user == 'me' || $user == 'photo.png') {
        if (!session('myavatar')) {
            $sql->where('id', session('id'));
            $getav = $sql->getOne('profiles', array('avatar'));
            if ($getav[0] == 'photo.png') {
                $user = session('gender') == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg';
                session('myavatar', $user);
            } else {
                $user = $getav[0];
                session('myavatar', $user);
            }
        } else {
            $user = session('myavatar');
            if ($user == 'photo.png') {
                $user = session('gender') == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg';
            }
        }
    }
    //include('inc/classes/ImageResizer.php');
    $img = new ImageResizer();
    if (is_file("theme/images/avatars/{$user}")) {
        $img->load("theme/images/avatars/{$user}");
    } else {
        $id = explode("_", giu('el2'));
        $id = safe::number($id[0]);
        $sql->where('id', $id);
        $gender = $sql->getOne('profiles', array('gender'));
        $av = $gender[0] == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg';
        $img->load("theme/images/avatars/{$av}");
    }
    $img->resize($size[0], $size[1]);
    header::toJpg();
    header::Cache(86400);
    $img->output();
}
?>
