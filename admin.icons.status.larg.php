<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'theme');
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
        ($_FILES['status_najar']['size'] == 0) &&
        ($_FILES['status_baby']['size'] == 0) &&
        ($_FILES['status_nagash']['size'] == 0) &&
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
    $link = "theme/images/status/status_online_larg.png";
    move_uploaded_file($_FILES['status_online']['tmp_name'], $link);
}
if ($_FILES['status_busy']['size'] > 0) {
    $link = "theme/images/status/status_busy_larg.png";
    move_uploaded_file($_FILES['status_busy']['tmp_name'], $link);
}
if ($_FILES['status_away']['size'] > 0) {
    $link = "theme/images/status/status_away_larg.png";
    move_uploaded_file($_FILES['status_away']['tmp_name'], $link);
}
if ($_FILES['status_fangel']['size'] > 0) {
    $link = "theme/images/status/status_fangel_larg.png";
    move_uploaded_file($_FILES['status_fangel']['tmp_name'], $link);
}
if ($_FILES['status_bt']['size'] > 0) {
    $link = "theme/images/status/status_bt_larg.png";
    move_uploaded_file($_FILES['status_bt']['tmp_name'], $link);
}
if ($_FILES['status_skull']['size'] > 0) {
    $link = "theme/images/status/status_skull_larg.png";
    move_uploaded_file($_FILES['status_skull']['tmp_name'], $link);
}
if ($_FILES['status_baj']['size'] > 0) {
    $link = "theme/images/status/status_baj_larg.png";
    move_uploaded_file($_FILES['status_baj']['tmp_name'], $link);
}
if ($_FILES['status_personable']['size'] > 0) {
    $link = "theme/images/status/status_personable_larg.png";
    move_uploaded_file($_FILES['status_personable']['tmp_name'], $link);
}
if ($_FILES['status_birthday']['size'] > 0) {
    $link = "theme/images/status/status_birthday_larg.png";
    move_uploaded_file($_FILES['status_birthday']['tmp_name'], $link);
}
if ($_FILES['status_help']['size'] > 0) {
    $link = "theme/images/status/status_help_larg.png";
    move_uploaded_file($_FILES['status_help']['tmp_name'], $link);
}
if ($_FILES['status_za']['size'] > 0) {
    $link = "theme/images/status/status_za_larg.png";
    move_uploaded_file($_FILES['status_za']['tmp_name'], $link);
}
if ($_FILES['status_beauty']['size'] > 0) {
    $link = "theme/images/status/status_beauty_larg.png";
    move_uploaded_file($_FILES['status_beauty']['tmp_name'], $link);
}
if ($_FILES['status_ctcs']['size'] > 0) {
    $link = "theme/images/status/status_ctcs_larg.png";
    move_uploaded_file($_FILES['status_ctcs']['tmp_name'], $link);
}
if ($_FILES['status_tcs']['size'] > 0) {
    $link = "theme/images/status/status_tcs_larg.png";
    move_uploaded_file($_FILES['status_tcs']['tmp_name'], $link);
}
if ($_FILES['status_csgamer']['size'] > 0) {
    $link = "theme/images/status/status_csgamer_larg.png";
    move_uploaded_file($_FILES['status_csgamer']['tmp_name'], $link);
}
if ($_FILES['status_nh']['size'] > 0) {
    $link = "theme/images/status/status_nh_larg.png";
    move_uploaded_file($_FILES['status_nh']['tmp_name'], $link);
}
if ($_FILES['status_mokh']['size'] > 0) {
    $link = "theme/images/status/status_mokh_larg.png";
    move_uploaded_file($_FILES['status_mokh']['tmp_name'], $link);
}
if ($_FILES['status_pr']['size'] > 0) {
    $link = "theme/images/status/status_pr_larg.png";
    move_uploaded_file($_FILES['status_pr']['tmp_name'], $link);
}
if ($_FILES['status_money']['size'] > 0) {
    $link = "theme/images/status/status_money_larg.png";
    move_uploaded_file($_FILES['status_money']['tmp_name'], $link);
}
if ($_FILES['status_lat']['size'] > 0) {
    $link = "theme/images/status/status_lat_larg.png";
    move_uploaded_file($_FILES['status_lat']['tmp_name'], $link);
}
if ($_FILES['status_shm']['size'] > 0) {
    $link = "theme/images/status/status_shm_larg.png";
    move_uploaded_file($_FILES['status_shm']['tmp_name'], $link);
}
if ($_FILES['status_fm']['size'] > 0) {
    $link = "theme/images/status/status_fm_larg.png";
    move_uploaded_file($_FILES['status_fm']['tmp_name'], $link);
}
if ($_FILES['status_cool']['size'] > 0) {
    $link = "theme/images/status/status_cool_larg.png";
    move_uploaded_file($_FILES['status_cool']['tmp_name'], $link);
}
if ($_FILES['status_shy']['size'] > 0) {
    $link = "theme/images/status/status_shy_larg.png";
    move_uploaded_file($_FILES['status_shy']['tmp_name'], $link);
}
if ($_FILES['status_zm']['size'] > 0) {
    $link = "theme/images/status/status_zm_larg.png";
    move_uploaded_file($_FILES['status_zm']['tmp_name'], $link);
}
if ($_FILES['status_working']['size'] > 0) {
    $link = "theme/images/status/status_working_larg.png";
    move_uploaded_file($_FILES['status_working']['tmp_name'], $link);
}
if ($_FILES['status_sick']['size'] > 0) {
    $link = "theme/images/status/status_sick_larg.png";
    move_uploaded_file($_FILES['status_sick']['tmp_name'], $link);
}
if ($_FILES['status_angel']['size'] > 0) {
    $link = "theme/images/status/status_angel_larg.png";
    move_uploaded_file($_FILES['status_angel']['tmp_name'], $link);
}
if ($_FILES['status_cooking']['size'] > 0) {
    $link = "theme/images/status/status_cooking_larg.png";
    move_uploaded_file($_FILES['status_cooking']['tmp_name'], $link);
}
if ($_FILES['status_eating']['size'] > 0) {
    $link = "theme/images/status/status_eating_larg.png";
    move_uploaded_file($_FILES['status_eating']['tmp_name'], $link);
}
if ($_FILES['status_broken']['size'] > 0) {
    $link = "theme/images/status/status_broken_larg.png";
    move_uploaded_file($_FILES['status_broken']['tmp_name'], $link);
}
if ($_FILES['status_music']['size'] > 0) {
    $link = "theme/images/status/status_music_larg.png";
    move_uploaded_file($_FILES['status_music']['tmp_name'], $link);
}
if ($_FILES['status_chell']['size'] > 0) {
    $link = "theme/images/status/status_chell_larg.png";
    move_uploaded_file($_FILES['status_chell']['tmp_name'], $link);
}
if ($_FILES['status_cry']['size'] > 0) {
    $link = "theme/images/status/status_cry_larg.png";
    move_uploaded_file($_FILES['status_cry']['tmp_name'], $link);
}
if ($_FILES['status_sad']['size'] > 0) {
    $link = "theme/images/status/status_sad_larg.png";
    move_uploaded_file($_FILES['status_sad']['tmp_name'], $link);
}
if ($_FILES['status_happy']['size'] > 0) {
    $link = "theme/images/status/status_happy_larg.png";
    move_uploaded_file($_FILES['status_happy']['tmp_name'], $link);
}
if ($_FILES['status_angry']['size'] > 0) {
    $link = "theme/images/status/status_angry_larg.png";
    move_uploaded_file($_FILES['status_angry']['tmp_name'], $link);
}
if ($_FILES['status_sleep']['size'] > 0) {
    $link = "theme/images/status/status_sleep_larg.png";
    move_uploaded_file($_FILES['status_sleep']['tmp_name'], $link);
}
if ($_FILES['status_spider']['size'] > 0) {
    $link = "theme/images/status/status_spider_larg.png";
    move_uploaded_file($_FILES['status_spider']['tmp_name'], $link);
}
if ($_FILES['status_rammal']['size'] > 0) {
    $link = "theme/images/status/status_rammal_larg.png";
    move_uploaded_file($_FILES['status_rammal']['tmp_name'], $link);
}
if ($_FILES['status_ezraeil']['size'] > 0) {
    $link = "theme/images/status/status_ezraeil_larg.png";
    move_uploaded_file($_FILES['status_ezraeil']['tmp_name'], $link);
}
if ($_FILES['status_najar']['size'] > 0) {
    $link = "theme/images/status/status_najar_larg.png";
    move_uploaded_file($_FILES['status_najar']['tmp_name'], $link);
}
if ($_FILES['status_baby']['size'] > 0) {
    $link = "theme/images/status/status_baby_larg.png";
    move_uploaded_file($_FILES['status_baby']['tmp_name'], $link);
}
if ($_FILES['status_nagash']['size'] > 0) {
    $link = "theme/images/status/status_nagash_larg.png";
    move_uploaded_file($_FILES['status_nagash']['tmp_name'], $link);
}
if ($_FILES['status_lovely']['size'] > 0) {
    $link = "theme/images/status/status_lovely_larg.png";
    move_uploaded_file($_FILES['status_lovely']['tmp_name'], $link);
}
if ($_FILES['status_jm']['size'] > 0) {
    $link = "theme/images/status/status_jm_larg.png";
    move_uploaded_file($_FILES['status_jm']['tmp_name'], $link);
}
if ($_FILES['status_bij']['size'] > 0) {
    $link = "theme/images/status/status_bij_larg.png";
    move_uploaded_file($_FILES['status_bij']['tmp_name'], $link);
}
if ($_FILES['status_controller']['size'] > 0) {
    $link = "theme/images/status/status_controller_larg.png";
    move_uploaded_file($_FILES['status_controller']['tmp_name'], $link);
}
if ($_FILES['status_telephone']['size'] > 0) {
    $link = "theme/images/status/status_telephone_larg.png";
    move_uploaded_file($_FILES['status_telephone']['tmp_name'], $link);
}
if ($_FILES['status_heart']['size'] > 0) {
    $link = "theme/images/status/status_heart_larg.png";
    move_uploaded_file($_FILES['status_heart']['tmp_name'], $link);
}
if ($_FILES['status_smil']['size'] > 0) {
    $link = "theme/images/status/status_smil_larg.png";
    move_uploaded_file($_FILES['status_smil']['tmp_name'], $link);
}
if ($_FILES['status_invisible']['size'] > 0) {
    $link = "theme/images/status/status_invisible_larg.png";
    move_uploaded_file($_FILES['status_invisible']['tmp_name'], $link);
}
echo "ok";
?>