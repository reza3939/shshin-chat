<?php
check_session();

include('inc/classes/profile.php');
include('inc/classes/bbcode.php');

if(!chatroom::checkPermission('viewprofile') || Users::guestType(session('type'))){
  Profile::ErrorMsg('این قسمت برای گروه کاربری شما غیرفعال شده است');
}

if(session('admin') != '1'){
	Profile::CheckActiveMe();
}

$user_id = giu('el2');
$giu3 = false;
$edit = false;
if(giu('el3')){
	$giu3 = safe::number(giu('el3'));
}
if(giu('el4')){
	header::Go(url('profile/'.$user_id));
}
if(!$user_id){
    if(session('id'))
        $user_id = session('id');
    else{
        include('notfound.php');
        exit();
    }
}else{
	if($user_id == 'edit'){
		$user_id = session('id');
		$edit  = true;
	}else{
		$user_id = safe::number($user_id);
		$edit = false;
	}
}
$sql->join('users u', 'u.id=p.id', 'LEFT');
$sql->join('onlines o', 'o.id=p.id', 'LEFT');
$sql->join('profile_counts pc', 'pc.userid=p.id', 'LEFT');
$sql->where("p.id", $user_id);
if($profile = $sql->getOne('profiles p', array(
        'o.hide',
	'p.*',
	'pc.posts AS cposts',
	'u.lastview',
	'u.name',
	'u.friends',
	'u.blacklist',
	'u.type',
	'o.id as online',
))){							
	if($profile['active'] == '0' && session('admin') != '1'){
		Profile::ErrorMsg('این پروفایل توسط مدیریت غیرفعال شده است');
	}
	if(Profile::MeInBlackList($profile['blacklist']) && $profile['id'] != session('id')){
		Profile::ErrorMsg('این کابر با شما قطع ارتباط کرده است');
	}
	if(Profile::MeInBlackList($profile['blacklist']) && $profile['id'] != session('id')){
		Profile::ErrorMsg('این کابر با شما قطع ارتباط کرده است');
	}

	$MySessionId = session('id');
	$hide = $profile['hide'];
	$user_settings = json_decode($profile['settings'], true);

	$jsonFriends = isset($profile['friends']) ? json_decode($profile['friends'], true) : array();
        if (is_array($jsonFriends) and !in_array(session('id'),$jsonFriends) and $user_settings['showprofile'] == 'friends' and $profile['id'] != session('id') and !Users::AdminsType(session('type'))) {
		Profile::ErrorMsg('این پروفایل فقط برای دوستان کاربر قابل مشاهده میباشد');
	}

	$_ProfileFriends = json_decode((string) $profile['friends'],true);
	$ProfileFriends = is_array($_ProfileFriends)? array_values($_ProfileFriends): array();
	
	$ProfileLastViewUsers = json_decode((string) $profile['views'],true);
	$ProfileLastViewUsers = is_array($ProfileLastViewUsers)? array_values($ProfileLastViewUsers): array();
	
	$ProfileFollowers = json_decode((string) $profile['followers'],true);
	$ProfileFollowers = (isset($ProfileFollowers['users']) and is_array($ProfileFollowers['users']))? array_values($ProfileFollowers['users']): array();
	
	$follow_posts = json_decode((string) $profile['followers'], true);
	$friends_followers = array_unique(array_merge(isset($user_settings['sfollowp']) && $user_settings['sfollowp'] == '1' ? ((isset($follow_posts['me']) and is_array($follow_posts['me'])) ? $follow_posts['me'] : array()) : array(),
									isset($user_settings['sfriendp']) && $user_settings['sfriendp'] == '1' ? $ProfileFriends : array()));
	
	$_follow_posts = count($friends_followers) != '0' ? implode(',',$friends_followers) : false;
	
	$follow_posts = '';
	$follow_posts_num = '';
	
	if(!$giu3){
		$follow_posts = $_follow_posts && $profile['id'] == $MySessionId ? " OR p.`userid` IN($_follow_posts)" : '';
		$follow_posts_num = $_follow_posts && $profile['id'] == $MySessionId ? " OR `userid` IN($_follow_posts)" : '';
	}
	
	$_ShowLastView = false;
	$_ShowFollowers = false;
	$_ShowFriends = false;
	$_ShowInfos = false;
	
	if(Profile::UserSetting($user_settings['lastview'], $_ProfileFriends) || !isset($user_settings['lastview']) || $profile['id'] == $MySessionId){
			if(count($ProfileLastViewUsers) != '0')$_ShowLastView = true;
	}
	if(Profile::UserSetting($user_settings['follower'], $_ProfileFriends) || !isset($user_settings['follower']) || $profile['id'] == $MySessionId){
			if(count($ProfileFollowers) != '0')$_ShowFollowers = true;
	}
	if(Profile::UserSetting($user_settings['friends'], $_ProfileFriends) || !isset($user_settings['friends']) || $profile['id'] == $MySessionId){
			if(count($ProfileFriends) != '0')$_ShowFriends = true;
	}
	if(Profile::UserSetting($user_settings['info'], $_ProfileFriends) || !isset($user_settings['info']) || $profile['id'] == $MySessionId){
			$_ShowInfos = true;
	}

	
    switch($profile['gender']){
        case('1'):$gender = "پسر";break;
        case('2'):$gender = "دختر";break;
    }
	
    $user['registerDate'] = jdate::start("l d F Y", $profile['registerdate']);
    $user['lastAcivity'] = jdate::start("l d F Y", $profile['lastview']);
    $user['lastAcivityTime'] = date("H:i", $profile['lastview']);
    $user['birthDate'] = explode('|', $profile['birthdate']);
    if($user['birthDate'][0] == '0'){
        $birthDate = "???? ????";
    }else{
        switch($user['birthDate'][1]){
            case('1'):$birthDate = jdate::start("l d F Y",  $user['birthDate'][0]);break;
            case('2'):$birthDate = jdate::start("l d",$user['birthDate'][0]).'???';break;
            case('3'):$birthDate = jdate::start("F", $user['birthDate'][0]);break;
            case('4'):$birthDate = jdate::start("Y",  $user['birthDate'][0]);break;
            case('5'):$birthDate = jdate::start("l d F", $user['birthDate'][0]);break;
            case('6'):$birthDate = jdate::start("l d Y", $user['birthDate'][0]);break;
            case('7'):$birthDate = jdate::start("F Y", $user['birthDate'][0]);break;
        }
    }

	$online = $profile['online'] ? 'online' : 'offline';
	$mymusic = (array) json_decode((string) $profile['music'],true);
	$music_title = isset($mymusic['music_title']) ? $mymusic['music_title'] : '';
	$mymusic['music_title'] = (mb_strlen($music_title, 'UTF-8') > 33) ? mb_substr($music_title, 0, 33, 'UTF-8').'...' : $music_title;
	
	if(!$edit){
		$ldavatar = Profile::LDUserCount($profile, 'lduavatar');
		$ldinfo = Profile::LDUserCount($profile, 'lduinfo');
		$ldcover = Profile::LDUserCount($profile, 'lducover');
		$ldmusic = Profile::LDUserCount($profile, 'ldumusic');
		$commentsAvatar = count((array) json_decode($profile['cavatar']));
		$commentsInfo = count((array) json_decode($profile['cinfo']));
		$commentsCover = count((array) json_decode($profile['ccover']));
		$commentsMusic = count((array) json_decode($profile['cmusic']));
		$CountDownlodedMusic = count((array) json_decode($profile['dmusic']));
		$myavatar_sendcomment = Profile::ShowResizedAvatar('me');
		$ProfileUserInMyBlackList = Profile::UserInMyBlackList($profile['id']);
		
		$total_groups = '';
		if(!$giu3 && $follow_posts_num != ''){
			$sql->where("userid", $profile['id']);
			$total_records = $sql->getValue('profile_posts', 'count(*)');
			$total_groups = ceil($total_records/4);

		}elseif(!$giu3){
			$total_records = $profile['cposts'];
			$total_groups = ceil($total_records/4);
		}
		
		if($MySessionId != '3232257' && $MySessionId != $profile['id'] && $hide == 0)Profile::AddLastView($ProfileLastViewUsers, $profile['id']);
		$MyCover = Profile::Cover($profile['cover']);
		
		include("theme/microblog/profile.php");
	}else{
		include("theme/microblog/profile.edit.php");
	}
}else{
    include('notfound.php');
    exit();
}

?>
