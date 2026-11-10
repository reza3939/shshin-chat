<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'settingthemes');
/************* THEMES SETTINGS***********************/
if(isset($_POST['chat_fal_theme'])){
    $newvalue = safe::string($_POST['chat_fal_theme']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_fal_theme'");
}
if(isset($_POST['chat_love_theme'])){
    $newvalue = safe::string($_POST['chat_love_theme']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_love_theme'");
}
if(isset($_POST['chat_game_theme'])){
    $newvalue = safe::string($_POST['chat_game_theme']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_game_theme'");
}
if(isset($_POST['chat_game_file'])){
    $newvalue = safe::string($_POST['chat_game_file']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_game_file'");
}
if(isset($_POST['chat_users_theme'])){
    $newvalue = safe::string($_POST['chat_users_theme']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_users_theme'");
}
if(isset($_POST['chat_profile_theme'])){
    $newvalue = safe::string($_POST['chat_profile_theme']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_profile_theme'");
}
if(isset($_POST['move_images'])){
    $newvalue = safe::string($_POST['move_images']);
    db::update('options', "`value`='$newvalue'", "`name`='move_images'");
}
if(isset($_POST['rooms_hover'])){
    $newvalue = safe::string($_POST['rooms_hover']);
    db::update('options', "`value`='$newvalue'", "`name`='rooms_hover'");
}
if(isset($_POST['chat_history_theme'])){
    $newvalue = safe::string($_POST['chat_history_theme']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_history_theme'");
}
if(isset($_POST['chat_contact_theme'])){
    $newvalue = safe::string($_POST['chat_contact_theme']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_contact_theme'");
}
if(isset($_POST['chat_blog_theme'])){
    $newvalue = safe::string($_POST['chat_blog_theme']);
    db::update('options', "`value`='$newvalue'", "`name`='chat_blog_theme'");
}
if(isset($_POST['chat_close'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_close'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_close'");
}
if(isset($_POST['chat_users_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_users_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_users_enable'");
}
if(isset($_POST['chat_love_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_love_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_love_enable'");
}
if(isset($_POST['chat_history_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_history_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_history_enable'");
}
if(isset($_POST['chat_game_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_game_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_game_enable'");
}
if(isset($_POST['chat_fal_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_fal_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_fal_enable'");
}
if(isset($_POST['chat_browsers_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_browsers_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_browsers_enable'");
}
if(isset($_POST['contact'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='contact'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='contact'");
}
if(isset($_POST['chat_blog_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_blog_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_blog_enable'");
}
if(isset($_POST['chat_profile_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_profile_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_profile_enable'");
}
if(isset($_POST['hides_shows_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='hides_shows_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='hides_shows_enable'");
}
if(isset($_POST['move_images_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='move_images_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='move_images_enable'");
}
if(isset($_POST['rooms_hover_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='rooms_hover_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='rooms_hover_enable'");
}
if(isset($_POST['chat_blog_enable'])){
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='chat_blog_enable'");
}else{
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='chat_blog_enable'");
}
if(isset($_POST['chat_theme'])){
    $newvalue = safe::filename($_POST['chat_theme']);
    if(substr($newvalue, 0, 5) != 'chat_theme'){
        if(is_dir('theme/'.$newvalue)){
            db::update('options', "`value`='$newvalue'", "`name`='chat_theme'");
            db::update('options', "`value`='theme/$newvalue/'", "`name`='rootdirmanager'");
        }
    }
    
}
if(isset($_POST['admintheme'])){
    $newvalue = safe::filename($_POST['admintheme']);
    if(is_dir('theme/'.$newvalue)){
        db::update('options', "`value`='$newvalue'", "`name`='admintheme'");
    }
}
chatroom::reloadconfig();
chatroom::addlog('9', "تنظیمات حرفه ای قالب چت روم را تغییر داد");
echo('ok');
?>