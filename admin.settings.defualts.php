<?php
if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'defualtssettings');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');
$file = json_decode($options['perm_send_file'], true);
if(safe::number($_POST['psf_numdat'])!=''){
    $file['numdat'] = safe::number($_POST['psf_numdat']);
}else{
    $file['numdat'] = safe::number(0);
}

if(safe::number($_POST['psf_score'])!=''){
    $file['score'] = safe::number($_POST['psf_score']);
}else{
    $file['score'] = safe::number(0);
}

if(safe::number($_POST['psf_zscore'])!=''){
    $file['zscore'] = safe::number($_POST['psf_zscore']);
}else{
    $file['zscore'] = safe::number(0);
}

$newvalue = json_encode($file, JSON_UNESCAPED_UNICODE);
$sql->where("name", "perm_send_file");
$sql->update("options", array(
    'value' => $newvalue
));

if (isset($_POST['defaultcolor'])) {
    $newvalue = safe::hexColor($_POST['defaultcolor']);
    $newvalue = substr($newvalue, 1);
    $sql->where("name", "chat_defaultcolor");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['scoretosendscore'])) {
    $newvalue = safe::number($_POST['scoretosendscore']);
    $sql->where("name", "scoretosendscore");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['defaultfontsize'])) {
    $newvalue = safe::number($_POST['defaultfontsize']) . "px";
     $sql->where("name", "chat_defaultfontsize");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['defaultfontname'])) {
    $newvalue = safe::string($_POST['defaultfontname']);
    $sql->where("name", "chat_defaultfontname");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['add_bank'])) {
    $newvalue = safe::number($_POST['add_bank']);
    $sql->where("name", "add_bank");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['maxlengthmsg'])) {
    $newvalue = safe::number($_POST['maxlengthmsg']);
    $sql->where("name", "chat_maxlengthmsg");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}


if (isset($_POST['maxlengthpass'])) {
    $newvalue = safe::number($_POST['maxlengthpass']);
    $sql->where("name", "chat_maxlengthpass");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}

if (isset($_POST['allow_send_music'])) {
    $newvalue = 'true';
    $sql->where("name", "allow_send_music");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "allow_send_music");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['date_time'])) {
    $newvalue = 'true';
    $sql->where("name", "date_time");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "date_time");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['stm'])) {
    $newvalue = 'true';
    $sql->where("name", "stm");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "stm");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['kadr_myself'])) {
    $newvalue = 'true';
    $sql->where("name", "kadr_myself");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "kadr_myself");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['show_msgs'])) {
    $newvalue = 'true';
    $sql->where("name", "show_msgs");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "show_msgs");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['linkdooni'])) {
    $newvalue = 'true';
    $sql->where("name", "linkdooni");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "linkdooni");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['offmsgautoshow'])) {
    $newvalue = 'true';
    $sql->where("name", "offmsgautoshow");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "offmsgautoshow");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['msgnum_myself'])) {
    $newvalue = 'true';
    $sql->where("name", "msgnum_myself");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "msgnum_myself");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['reportBlock_user'])) {
    $newvalue = 'true';
    $sql->where("name", "reportBlock_user");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "reportBlock_user");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['allow_send_film'])) {
    $newvalue = 'true';
    $sql->where("name", "allow_send_film");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "allow_send_film");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}


if (isset($_POST['maxlengthname'])) {
    $newvalue = safe::number($_POST['maxlengthname']);
    $sql->where("name", "chat_maxlengthname");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['score_report'])) {
    $newvalue = safe::number($_POST['score_report']);
    $sql->where("name", "score_report");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}

if (isset($_POST['num_smileuser'])) {
    $newvalue = safe::number($_POST['num_smileuser']);
    $sql->where("name", "num_smileuser");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['systemname'])) {
    $newvalue = safe::string($_POST['systemname']);
    $sql->where("name", "chat_systemname");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['systemcolor'])) {
    $newvalue = safe::hexColor($_POST['systemcolor']);
    $newvalue = substr($newvalue, 1);
    $sql->where("name", "chat_systemcolor");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['reportBlock_user_num'])) {
    $newvalue = safe::number($_POST['reportBlock_user_num']);
    $sql->where("name", "reportBlock_user_num");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['reportBlock_user_time'])) {
    $newvalue = safe::number($_POST['reportBlock_user_time']);
    $sql->where("name", "reportBlock_user_time");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['report_score'])) {
    $newvalue = safe::number($_POST['report_score']);
    $sql->where("name", "report_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['systeminto'])) {
    $newvalue = safe::string($_POST['systeminto']);
    if (!in_array($newvalue, array('main', 'pm')))
        $newvalue = 'main';
    $sql->where("name", "chat_systeminto");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['repeat_robo_bann'])) {
    $newvalue = safe::number($_POST['repeat_robo_bann']);
    $sql->where("name", "repeat_robo_bann");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['historytime'])) {

    $newvalue = safe::number($_POST['historytime']);
    $sql->where("name", "chat_historytime");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['winsize'])) {
    $newvalue = safe::string($_POST['winsize']);
    $newvalue = str_replace('x', '*', $newvalue);
    $sql->where("name", "winsize");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}

if (isset($_POST['timemsgpv'])) {
    $newvalue = 'true';
    $sql->where("name", "timemsgpv");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "timemsgpv");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['automod'])) {
    $newvalue = 'true';
    $sql->where("name", "automod");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "automod");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['thumbavatar'])) {
    $newvalue = 'true';
    $sql->where("name", "thumbavatar");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "thumbavatar");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if (isset($_POST['send_activity2private_admins'])) {
    $newvalue = 'true';
    $sql->where("name", "send_activity2private_admins");
    $sql->update("options", array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "send_activity2private_admins");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['noekhrajer'])){
     $newvalue = 'true';
    $sql->where("name", "noekhrajer");
    $sql->update("options", array(
    'value' => $newvalue
    ));    

}else{
    $newvalue = 'false';
    $sql->where("name", "noekhrajer");
    $sql->update("options", array(
    'value' => $newvalue
    ));  
}
if(isset($_POST['ekhrajername'])){
    $newvalue = safe::string($_POST['ekhrajername']);      
    $sql->where("name", "ekhrajername");
    $sql->update("options", array(
    'value' => $newvalue
    ));

}
if(isset($_POST['nodalil'])){
     $newvalue = 'true';
    $sql->where("name", "nodalil");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}else{
    $newvalue = 'false';
    $sql->where("name", "nodalil");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if(isset($_POST['dalil'])){
    $newvalue = safe::string($_POST['dalil']);      
    $sql->where("name", "dalil");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if(isset($_POST['avatarOnline'])){
    $newvalue = safe::string($_POST['avatarOnline']);
    $newvalue = str_replace('x', '*', $newvalue);
	if($options['avatarOnline'] != $newvalue){
    $options['avatarOnline'] = explode('*', $options['avatarOnline']);
    list($width, $height) = $options['avatarOnline'];
      
    $options['avatarOnline'] = explode('*', $newvalue);
    list($width, $height) = $options['avatarOnline'];
    }   
    $sql->where("name", "avatarOnline");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['thumbavatarSize'])){
    $newvalue = safe::string($_POST['thumbavatarSize']);
    $newvalue = str_replace('x', '*', $newvalue);
	if($options['avataromomi'] != $newvalue){
    $options['avataromomi'] = explode('*', $options['avataromomi']);
    list($width, $height) = $options['avataromomi'];
      
    $options['avataromomi'] = explode('*', $newvalue);
    list($width, $height) = $options['avataromomi'];
    }   
    $sql->where("name", "avataromomi");
    $sql->update("options", array(
        'value' => $newvalue
    ));
}
if(isset($_POST['thumbavatarSize'])){
    $newvalue = safe::string($_POST['thumbavatarSize']);
    $newvalue = str_replace('x', '*', $newvalue);
    $sql->where("name", "thumbavatarSize");
    $sql->update("options", array(
    'value' => $newvalue
    ));
	if($options['thumbavatarSize'] != $newvalue){
    $options['thumbavatarSize'] = explode('*', $options['thumbavatarSize']);
    list($width, $height) = $options['thumbavatarSize'];
    $dir = "{$options['avatar_dir']}/$width-$height/";
    if(is_dir($dir)){
    	//include('inc/classes/file.php');
    	file::Delete($dir);
    }
    
    $options['thumbavatarSize'] = explode('*', $newvalue);
    list($width, $height) = $options['thumbavatarSize'];

    
    $dir = "{$options['avatar_dir']}/$width-$height/";
  
    if(!is_dir($dir))mkdir($dir);
    chatroom::reloadAvatars();
    
    
  //  include('inc/classes/ImageResizer.php');
    $avatars = listDirectory($options['avatar_dir'], false, false);
	
	if(!is_file($options['avatar_dir']."/no_avatar_female.jpg")){
		 copy("theme/images/default/no_avatar_female.jpg", "{$options['avatar_dir']}/no_avatar_female.jpg");
	}
	if(!is_file($options['avatar_dir']."/no_avatar_male.png")){
		 copy("theme/images/default/no_avatar_male.png", "{$options['avatar_dir']}/no_avatar_male.png"); 
	}
	          
	$image = new ImageResizer();
    $image->load("{$options['avatar_dir']}/{$options['defaultavatar']}");
    $image->resize($width, $height);
    $image->save("{$options['avatar_dir']}/$width-$height/{$options['defaultavatar']}"); 

	$image = new ImageResizer();
    $image->load("{$options['avatar_dir']}/no_avatar_female.jpg");
    $image->resize($width, $height);
    $image->save("{$options['avatar_dir']}/$width-$height/femaledefualt.jpg");

	$image = new ImageResizer();
    $image->load("{$options['avatar_dir']}/no_avatar_male.png");
    $image->resize($width, $height);
    $image->save("{$options['avatar_dir']}/$width-$height/maledefualt.png");
    
    foreach($avatars as $avatar){
        $Format = $avatar;
        $Format = strtolower(substr(strrchr($Format, "."), 1));
        $Format = str_replace("jpeg","jpg",$Format);
        if($Format != 'jpg' && $Format != 'png' && $Format != 'gif')continue;
        $basename = basename($avatar);
        if(!is_file("{$options['avatar_dir']}/$width-$height/$basename")){
            $image = new ImageResizer();
            $image->load($avatar);
            $image->resize($width, $height);
            $image->save("{$options['avatar_dir']}/$width-$height/$basename");
            $avatars_healthy = false;
        }
    }
    }
       
}
if (isset($_POST['getscoretype'])) {
    $newvalue = safe::string($_POST['getscoretype']);
    if (!in_array($newvalue, array('login', 'ajax'))) {
        $newvalue = 'ajax';
    }
    $sql->where("name", "getscoretype");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['defaultavatar'])) {
    $newvalue = safe::string($_POST['defaultavatar']);
    if (is_file($options['avatar_dir'] . '/' . $newvalue)) {
    $sql->where("name", "defaultavatar");
    $sql->update("options", array(
    'value' => $newvalue
    ));
    }
}
if (isset($_POST['registerbtn'])) {
    $newvalue = 'true';
    $sql->where("name", "registerbtn");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "registerbtn");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}

if (isset($_POST['colorlistonline'])) {
    $newvalue = 'true';
    $sql->where("name", "colorlistonline");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "colorlistonline");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['autolinker'])) {
    $newvalue = 'true';
    $sql->where("name", "autolinker");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "autolinker");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['timemsg'])) {
    $newvalue = 'true';
    $sql->where("name", "timemsg");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "timemsg");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['repeatmsg'])) {
    $newvalue = safe::number($_POST['repeatmsg']);
    $sql->where("name", "repeatmsg");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['1ip2user'])) {
	$newvalue = 'true';
	$sql->where('name', '1ip2user')->update('options', array(
		'value' => $newvalue
	));
} else {
	$newvalue = 'false';
	$sql->where('name', '1ip2user')->update('options', array(
		'value' => $newvalue
	));
}
if (isset($_POST['ipfucker'])) {
    $newvalue = 'true';
    db::update('options', "`value`='$newvalue'", "`name`='ipfucker'");
} else {
    $newvalue = 'false';
    db::update('options', "`value`='$newvalue'", "`name`='ipfucker'");
}
if (isset($_POST['contact'])) {
    $newvalue = 'true';
    $sql->where("name", "contact");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "contact");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['blur'])) {
    $newvalue = 'true';
    $sql->where("name", "blur");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "blur");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['pw2_adminpanel'])) {
    $newvalue = '1';
    $sql->where("name", "pw2_adminpanel");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = '0';
    $sql->where("name", "pw2_adminpanel");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if(isset($_POST['advcreg'])){
    $newvalue = '1';
    db::update('options', "`value`='$newvalue'", "`name`='advcreg'");
}else{
    $newvalue = '0';
    db::update('options', "`value`='$newvalue'", "`name`='advcreg'");
}
if (isset($_POST['allow_image'])) {
    $newvalue = 'true';
    $sql->where("name", "allow_image");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "allow_image");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['allow_url'])) {
    $newvalue = 'true';
    $sql->where("name", "allow_url");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "allow_url");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['buyscore'])) {
    $newvalue = 'true';
    $sql->where("name", "buyscore");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "buyscore");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['update_bank'])) {
    $newvalue = 'true';
    $sql->where("name", "update_bank");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "update_bank");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['buy_user_score'])) {
    $newvalue = 'true';
    $sql->where("name", "buy_user_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "buy_user_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['image_score'])) {
    $newvalue = safe::number($_POST['image_score']);
    $sql->where("name", "image_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['url_score'])) {
    $newvalue = safe::number($_POST['url_score']);
    $sql->where("name", "url_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['addbank_reg'])) {
    $newvalue = safe::number($_POST['addbank_reg']);
    $sql->where("name", "addbank_reg");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if(isset($_POST['buyscore_code'])){
    $buyscore_code = safe::number($_POST['buyscore_code']);
	if($_POST['buyscore'] == true) $newvalue = $buyscore_code;
	if($_POST['in_mytarh'] == true) $newvalue = 'in_myrtarh';
	if(!$buyscore_code) $newvalue = 'in_mytarh';
    db::update('options', "`value`='$newvalue'", "`name`='buyscore_code'");
}else{
	$newvalue = 'in_mytarh';
	db::update('options', "`value`='$newvalue'", "`name`='buyscore_code'");
}
if (isset($_POST['time_bank'])) {
    $newvalue = safe::number($_POST['time_bank']);
    $sql->where("name", "time_bank");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['film_score'])) {
    $newvalue = safe::number($_POST['film_score']);
    $sql->where("name", "film_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['music_score'])) {
    $newvalue = safe::number($_POST['music_score']);
    $sql->where("name", "music_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['pay_score'])) {
    $newvalue = safe::number($_POST['pay_score']);
    $sql->where("name", "pay_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['pay_bank'])) {
    $newvalue = safe::number($_POST['pay_bank']);
    $sql->where("name", "pay_bank");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['box3'])) {
    $newvalue = 'true';
    $sql->where("name", "box3");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "box3");
    $sql->update("options", array(
    'value' => $newvalue
    ));

}
if (isset($_POST['chatnews'])) {
    $newvalue = 'true';
    $sql->where("name", "chatnews");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "chatnews");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['buyscore_status'])) {
    $newvalue = 'true';
    $sql->where("name", "buyscore_status");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "buyscore_status");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if(isset($_POST['buyscore_amount']) && safe::number($_POST['buyscore_amount']) >= 100){
    $newvalue = safe::number($_POST['buyscore_amount']);
    db::update('options', "`value`='$newvalue'", "`name`='buyscore_amount'");
}else{
    $newvalue = '100';
    db::update('options', "`value`='$newvalue'", "`name`='buyscore_amount'");
}
if (isset($_POST['allow_sendfile_in_private'])) {
    $newvalue = 'true';
    $sql->where("name", "allow_sendfile_in_private");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "allow_sendfile_in_private");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['report_user'])) {
    $newvalue = 'true';
    $sql->where("name", "report_user");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "report_user");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['tabligh_reporter'])) {
    $newvalue = '1';
    $sql->where("name", "tabligh_reporter");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = '0';
    $sql->where("name", "tabligh_reporter");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['robo_bann'])) {
    $newvalue = '1';
    $sql->where("name", "robo_bann");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = '0';
    $sql->where("name", "robo_bann");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['check_idle']) && !empty($_POST['check_idle']) && is_numeric($_POST['check_idle'])) {
    $newvalue = safe::number($_POST['check_idle']);
    $newvalue = str_replace('-', '', $newvalue);
    $newvalue = trim($newvalue);
    $sql->where("name", "check_idle");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = '3';
    $sql->where("name", "check_idle");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['ban_time_robo']) && !empty($_POST['ban_time_robo']) && is_numeric($_POST['ban_time_robo'])) {
    $newvalue = safe::number($_POST['ban_time_robo']);
    $newvalue = str_replace('-', '', $newvalue);
    $newvalue = trim($newvalue);
    $sql->where("name", "ban_time_robo");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = '1';
    $sql->where("name", "ban_time_robo");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['check_status_system_private'])) {
    $newvalue = 'true';
    $sql->where("name", "check_status_system_private");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "check_status_system_private");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['send_letters2private_admin'])) {
    $newvalue = 'true';
    $sql->where("name", "send_letters2private_admin");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "send_letters2private_admin");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['buy_type'])) {
    $newvalue = '1';
    $sql->where("name", "buy_type");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = '0';
    $sql->where("name", "buy_type");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['robo_cleaner'])) {
    $newvalue = '1';
    $sql->where("name", "robo_cleaner");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = '0';
    $sql->where("name", "robo_cleaner");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['show_idleTime_onlinelist'])) {
    $newvalue = 'true';
    $sql->where("name", "show_idleTime_onlinelist");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "show_idleTime_onlinelist");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['show_userOs'])) {
    $newvalue = 'true';
    $sql->where("name", "show_userOs");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "show_userOs");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['videochat'])) {
    $newvalue = 'true';
    $sql->where("name", "videochat");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "videochat");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['send_post_inprofile'])) {
    $newvalue = 'true';
    $sql->where("name", "send_post_inprofile");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "send_post_inprofile");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['send_comment_inprofile'])) {
    $newvalue = 'true';
     $sql->where("name", "send_comment_inprofile");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "send_comment_inprofile");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['ld_inprofile'])) {
    $newvalue = 'true';
    $sql->where("name", "ld_inprofile");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "ld_inprofile");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['security_question'])) {
    $newvalue = 'true';
    $sql->where("name", "security_question");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "security_question");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['ld_score']) && !empty($_POST['ld_score']) && is_numeric($_POST['ld_score'])) {
    $newvalue = safe::number($_POST['ld_score']);
    $newvalue = str_replace('-', '', $newvalue);
    $newvalue = trim($newvalue);
    $sql->where("name", "ld_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = '0';
    $sql->where("name", "ld_score");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['buy_room']) and $_POST['buy_room'] == 1) {
    $buy_room_score = safe::number($_POST['buy_room_score']);
    $buy_room_score_for_admin = safe::number($_POST['buy_room_score_for_admin']);
    $buy_room_score = str_replace('-', '', $buy_room_score);
    $buy_room_score_for_admin = str_replace('-', '', $buy_room_score_for_admin);
    $newvalue = array('buy_room' => 1, 'score' => $buy_room_score, 'score_for_admin' => $buy_room_score_for_admin);
    $newvalue = json_encode($newvalue);
    $sql->where("name", "buy_room");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $buy_room_score = safe::number($_POST['buy_room_score']);
    $buy_room_score_for_admin = safe::number($_POST['buy_room_score_for_admin']);
    $buy_room_score = str_replace('-', '', $buy_room_score);
    $buy_room_score_for_admin = str_replace('-', '', $buy_room_score_for_admin);
    $newvalue = array('buy_room' => 0, 'score' => $buy_room_score, 'score_for_admin' => $buy_room_score_for_admin);
    $newvalue = json_encode($newvalue);
    $sql->where("name", "buy_room");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}

if(isset($_POST['mod_protect']) and $_POST['mod_protect'] == 1){
	$mod_protect_pw = safe::string($_POST['mod_protect_pw']);
	$newvalue = array('status' => 1 , 'pw' =>  $mod_protect_pw);
	$newvalue = json_encode($newvalue);
    $sql->where("name", "mod_protect");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}else{
		$mod_protect_pw = safe::string($_POST['mod_protect_pw']);
	$newvalue = array('status' => 0 , 'pw' =>  $mod_protect_pw);
	$newvalue = json_encode($newvalue);
    $sql->where("name", "mod_protect");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}

if (isset($_POST['capacity_cf_admins']) and isset($_POST['capacity_cf_users'])) {
    $capacity_cf_admins = safe::number($_POST['capacity_cf_admins']);
    $capacity_cf_users = safe::number($_POST['capacity_cf_users']);
    $newvalue = array('admins' => $capacity_cf_admins, 'users' => $capacity_cf_users);
    $newvalue = json_encode($newvalue);
    $sql->where("name", "capacity_cf");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = array('admins' => 10, 'users' => 5);
    $newvalue = json_encode($newvalue);
    $sql->where("name", "capacity_cf");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['showubrowseronlist'])) {
    $newvalue = 'true';
    $sql->where("name", "showubrowseronlist");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "showubrowseronlist");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['showPlayer'])) {
    $newvalue = 'true';
    $sql->where("name", "showPlayer");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "showPlayer");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['mobiledetect'])) {
    $newvalue = 'true';
    $sql->where("name", "mobiledetect");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "mobiledetect");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['roomstyle'])) {
    $newvalue = 'true';
    $sql->where("name", "roomstyle");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "roomstyle");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['enablechatfont'])) {
    $newvalue = 'true';
    $sql->where("name", "enablechatfont");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "enablechatfont");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['shoavataronlist'])) {
    $newvalue = 'true';
    $sql->where("name", "shoavataronlist");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "shoavataronlist");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['titleefect'])) {
    $newvalue = 'true';
    $sql->where("name", "titleefect");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "titleefect");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['allowchat'])) {
    $newvalue = 'true';
    $sql->where("name", "allowchat");
    $sql->update("options", array(
    'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", "allowchat");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['fontlist'])) {
    $newvalue = safe::string($_POST['fontlist']);
    $sql->where("name", "fontlist");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
if (isset($_POST['bann_defualttime'])) {
    $newvalue = safe::number($_POST['bann_defualttime']);
    $sql->where("name", "bann_defualttime");
    $sql->update("options", array(
    'value' => $newvalue
    ));
}
chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تنظیمات پیشفرض ها را تغییر داد");
}
  $tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات پیشفرض ها را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['sendsettinglog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>