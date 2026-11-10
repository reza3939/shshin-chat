<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'iconstatus');
if (($_FILES['status_online']['size'] == 0) &&
        ($_FILES['status_busy']['size'] == 0) &&
        ($_FILES['status_away']['size'] == 0) &&
        ($_FILES['status_fangel']['size'] == 0) &&
        ($_FILES['status_bt']['size'] == 0) &&
        ($_FILES['status_skull']['size'] == 0) &&
        ($_FILES['status_baj']['size'] == 0) &&
        ($_FILES['status_birthday']['size'] == 0) &&
        ($_FILES['status_help']['size'] == 0) &&
        ($_FILES['status_za']['size'] == 0) &&
        ($_FILES['status_beauty']['size'] == 0) &&
        ($_FILES['status_ctcs']['size'] == 0) &&
        ($_FILES['status_tcs']['size'] == 0) &&
        ($_FILES['status_csgamer']['size'] == 0) &&
        ($_FILES['status_nh']['size'] == 0) &&
        ($_FILES['status_mokh']['size'] == 0) &&
        ($_FILES['status_pr']['size'] == 0) &&
        ($_FILES['status_money']['size'] == 0) &&
        ($_FILES['status_lat']['size'] == 0) &&
        ($_FILES['status_shm']['size'] == 0) &&
        ($_FILES['status_zm']['size'] == 0) &&
        ($_FILES['status_fm']['size'] == 0) &&
        ($_FILES['status_cool']['size'] == 0) &&
        ($_FILES['status_shy']['size'] == 0) &&
        ($_FILES['status_working']['size'] == 0) &&
        ($_FILES['status_sick']['size'] == 0) &&
        ($_FILES['status_angel']['size'] == 0) &&
        ($_FILES['status_cooking']['size'] == 0) &&
        ($_FILES['status_eating']['size'] == 0) &&
        ($_FILES['status_broken']['size'] == 0) &&
        ($_FILES['status_music']['size'] == 0) &&
        ($_FILES['status_chell']['size'] == 0) &&
        ($_FILES['status_cry']['size'] == 0) &&
        ($_FILES['status_sad']['size'] == 0) &&
        ($_FILES['status_happy']['size'] == 0) &&
        ($_FILES['status_angry']['size'] == 0) &&
        ($_FILES['status_sleep']['size'] == 0) &&
        ($_FILES['status_spider']['size'] == 0) &&
        ($_FILES['status_rammal']['size'] == 0) &&
        ($_FILES['status_ezraeil']['size'] == 0) &&
        ($_FILES['status_baby']['size'] == 0) &&
        ($_FILES['status_lovely']['size'] == 0) &&
        ($_FILES['status_jm']['size'] == 0) &&
        ($_FILES['status_bij']['size'] == 0) &&
        ($_FILES['status_controller']['size'] == 0) &&
        ($_FILES['status_telephone']['size'] == 0) &&
        ($_FILES['status_heart']['size'] == 0) &&
        ($_FILES['status_smil']['size'] == 0) &&
        ($_FILES['status_invisible']['size'] == 0) &&
        ($_FILES['status_personable']['size'] == 0)) {
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
if ($_FILES['status_online']['size'] > 0) {
    $link = "theme/images/status/status_online.png";
    move_uploaded_file($_FILES['status_online']['tmp_name'], $link);
}
if ($_FILES['status_busy']['size'] > 0) {
    $link = "theme/images/status/status_busy.png";
    move_uploaded_file($_FILES['status_busy']['tmp_name'], $link);
}
if ($_FILES['status_away']['size'] > 0) {
    $link = "theme/images/status/status_away.png";
    move_uploaded_file($_FILES['status_away']['tmp_name'], $link);
}
if ($_FILES['status_fangel']['size'] > 0) {
    $link = "theme/images/status/status_fangel.png";
    move_uploaded_file($_FILES['status_fangel']['tmp_name'], $link);
}
if ($_FILES['status_bt']['size'] > 0) {
    $link = "theme/images/status/status_bt.png";
    move_uploaded_file($_FILES['status_bt']['tmp_name'], $link);
}
if ($_FILES['status_skull']['size'] > 0) {
    $link = "theme/images/status/status_skull.png";
    move_uploaded_file($_FILES['status_skull']['tmp_name'], $link);
}
if ($_FILES['status_baj']['size'] > 0) {
    $link = "theme/images/status/status_baj.png";
    move_uploaded_file($_FILES['status_baj']['tmp_name'], $link);
}
if ($_FILES['status_personable']['size'] > 0) {
    $link = "theme/images/status/status_personable.png";
    move_uploaded_file($_FILES['status_personable']['tmp_name'], $link);
}
if ($_FILES['status_birthday']['size'] > 0) {
    $link = "theme/images/status/status_birthday.png";
    move_uploaded_file($_FILES['status_birthday']['tmp_name'], $link);
}
if ($_FILES['status_help']['size'] > 0) {
    $link = "theme/images/status/status_help.png";
    move_uploaded_file($_FILES['status_help']['tmp_name'], $link);
}
if ($_FILES['status_za']['size'] > 0) {
    $link = "theme/images/status/status_za.png";
    move_uploaded_file($_FILES['status_za']['tmp_name'], $link);
}
if ($_FILES['status_beauty']['size'] > 0) {
    $link = "theme/images/status/status_beauty.png";
    move_uploaded_file($_FILES['status_beauty']['tmp_name'], $link);
}
if ($_FILES['status_ctcs']['size'] > 0) {
    $link = "theme/images/status/status_ctcs.png";
    move_uploaded_file($_FILES['status_ctcs']['tmp_name'], $link);
}
if ($_FILES['status_tcs']['size'] > 0) {
    $link = "theme/images/status/status_tcs.png";
    move_uploaded_file($_FILES['status_tcs']['tmp_name'], $link);
}
if ($_FILES['status_csgamer']['size'] > 0) {
    $link = "theme/images/status/status_csgamer.png";
    move_uploaded_file($_FILES['status_csgamer']['tmp_name'], $link);
}
if ($_FILES['status_nh']['size'] > 0) {
    $link = "theme/images/status/status_nh.png";
    move_uploaded_file($_FILES['status_nh']['tmp_name'], $link);
}
if ($_FILES['status_mokh']['size'] > 0) {
    $link = "theme/images/status/status_mokh.png";
    move_uploaded_file($_FILES['status_mokh']['tmp_name'], $link);
}
if ($_FILES['status_pr']['size'] > 0) {
    $link = "theme/images/status/status_pr.png";
    move_uploaded_file($_FILES['status_pr']['tmp_name'], $link);
}
if ($_FILES['status_money']['size'] > 0) {
    $link = "theme/images/status/status_money.png";
    move_uploaded_file($_FILES['status_money']['tmp_name'], $link);
}
if ($_FILES['status_lat']['size'] > 0) {
    $link = "theme/images/status/status_lat.png";
    move_uploaded_file($_FILES['status_lat']['tmp_name'], $link);
}
if ($_FILES['status_shm']['size'] > 0) {
    $link = "theme/images/status/status_shm.png";
    move_uploaded_file($_FILES['status_shm']['tmp_name'], $link);
}
if ($_FILES['status_fm']['size'] > 0) {
    $link = "theme/images/status/status_fm.png";
    move_uploaded_file($_FILES['status_fm']['tmp_name'], $link);
}
if ($_FILES['status_cool']['size'] > 0) {
    $link = "theme/images/status/status_cool.png";
    move_uploaded_file($_FILES['status_cool']['tmp_name'], $link);
}
if ($_FILES['status_shy']['size'] > 0) {
    $link = "theme/images/status/status_shy.png";
    move_uploaded_file($_FILES['status_shy']['tmp_name'], $link);
}
if ($_FILES['status_working']['size'] > 0) {
    $link = "theme/images/status/status_working.png";
    move_uploaded_file($_FILES['status_working']['tmp_name'], $link);
}
if ($_FILES['status_sick']['size'] > 0) {
    $link = "theme/images/status/status_sick.png";
    move_uploaded_file($_FILES['status_sick']['tmp_name'], $link);
}
if ($_FILES['status_angel']['size'] > 0) {
    $link = "theme/images/status/status_angel.png";
    move_uploaded_file($_FILES['status_angel']['tmp_name'], $link);
}
if ($_FILES['status_cooking']['size'] > 0) {
    $link = "theme/images/status/status_cooking.png";
    move_uploaded_file($_FILES['status_cooking']['tmp_name'], $link);
}
if ($_FILES['status_eating']['size'] > 0) {
    $link = "theme/images/status/status_eating.png";
    move_uploaded_file($_FILES['status_eating']['tmp_name'], $link);
}
if ($_FILES['status_broken']['size'] > 0) {
    $link = "theme/images/status/status_broken.png";
    move_uploaded_file($_FILES['status_broken']['tmp_name'], $link);
}
if ($_FILES['status_music']['size'] > 0) {
    $link = "theme/images/status/status_music.png";
    move_uploaded_file($_FILES['status_music']['tmp_name'], $link);
}
if ($_FILES['status_chell']['size'] > 0) {
    $link = "theme/images/status/status_chell.png";
    move_uploaded_file($_FILES['status_chell']['tmp_name'], $link);
}
if ($_FILES['status_cry']['size'] > 0) {
    $link = "theme/images/status/status_cry.png";
    move_uploaded_file($_FILES['status_cry']['tmp_name'], $link);
}
if ($_FILES['status_sad']['size'] > 0) {
    $link = "theme/images/status/status_sad.png";
    move_uploaded_file($_FILES['status_sad']['tmp_name'], $link);
}
if ($_FILES['status_happy']['size'] > 0) {
    $link = "theme/images/status/status_happy.png";
    move_uploaded_file($_FILES['status_happy']['tmp_name'], $link);
}
if ($_FILES['status_angry']['size'] > 0) {
    $link = "theme/images/status/status_angry.png";
    move_uploaded_file($_FILES['status_angry']['tmp_name'], $link);
}
if ($_FILES['status_sleep']['size'] > 0) {
    $link = "theme/images/status/status_sleep.png";
    move_uploaded_file($_FILES['status_sleep']['tmp_name'], $link);
}
if ($_FILES['status_spider']['size'] > 0) {
    $link = "theme/images/status/status_spider.png";
    move_uploaded_file($_FILES['status_spider']['tmp_name'], $link);
}
if ($_FILES['status_rammal']['size'] > 0) {
    $link = "theme/images/status/status_rammal.png";
    move_uploaded_file($_FILES['status_rammal']['tmp_name'], $link);
}
if ($_FILES['status_ezraeil']['size'] > 0) {
    $link = "theme/images/status/status_ezraeil.png";
    move_uploaded_file($_FILES['status_ezraeil']['tmp_name'], $link);
}
if ($_FILES['status_baby']['size'] > 0) {
    $link = "theme/images/status/status_baby.png";
    move_uploaded_file($_FILES['status_baby']['tmp_name'], $link);
}
if ($_FILES['status_lovely']['size'] > 0) {
    $link = "theme/images/status/status_lovely.png";
    move_uploaded_file($_FILES['status_lovely']['tmp_name'], $link);
}
if ($_FILES['status_jm']['size'] > 0) {
    $link = "theme/images/status/status_jm.png";
    move_uploaded_file($_FILES['status_jm']['tmp_name'], $link);
}
if ($_FILES['status_bij']['size'] > 0) {
    $link = "theme/images/status/status_bij.png";
    move_uploaded_file($_FILES['status_bij']['tmp_name'], $link);
}
if ($_FILES['status_controller']['size'] > 0) {
    $link = "theme/images/status/status_controller.png";
    move_uploaded_file($_FILES['status_controller']['tmp_name'], $link);
}
if ($_FILES['status_telephone']['size'] > 0) {
    $link = "theme/images/status/status_telephone.png";
    move_uploaded_file($_FILES['status_telephone']['tmp_name'], $link);
}
if ($_FILES['status_heart']['size'] > 0) {
    $link = "theme/images/status/status_heart.png";
    move_uploaded_file($_FILES['status_heart']['tmp_name'], $link);
}
if ($_FILES['status_smil']['size'] > 0) {
    $link = "theme/images/status/status_smil.png";
    move_uploaded_file($_FILES['status_smil']['tmp_name'], $link);
}
if ($_FILES['status_invisible']['size'] > 0) {
    $link = "theme/images/status/status_invisible.png";
    move_uploaded_file($_FILES['status_invisible']['tmp_name'], $link);
}
echo "ok";
?>