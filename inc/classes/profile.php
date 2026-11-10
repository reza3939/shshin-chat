<?php

class Profile {

    static function CheckActiveMe() {
        global $sql;
        $sql->where("id", session('id'));
        $checkmeActive = $sql->getValue('profiles', 'active');
        if ($checkmeActive == '0') {
            self::ErrorMsg('پروفایل شما غیرفعال شده است. اجازه دیدن پروفایل کاربران را ندارید');
        }
    }

    static function ErrorMsg($text) {
        $mytext = $text ? $text : false;
        include('theme/microblog/profile.notfound.php');
        exit();
    }

    static function Cover($cover) {
        return is_file('theme/images/covers/' . $cover) ? '/theme/images/covers/' . $cover : '/theme/microblog/images/cover.jpg';
    }

    static function UserInMyBlackList($id) {
        global $sql;
        $myid = session('id');
        $sql->where("id", $myid);
        $get = $sql->getOne('users', array('blacklist'));
        $blacklist = json_decode((string) $get['blacklist'], true);
        $blacklist = array_unique((array) $blacklist);
	$blacklist = is_array($blacklist)? array_values($blacklist): array();
        if(is_array($blacklist)) {
        return in_array($id, $blacklist) ? true : false;
        }
    }

    static function MeInBlackList($blacklist) {
        $user_blacklist = json_decode((string) $blacklist, true);
        $user_blacklist = is_array($user_blacklist)? array_values($user_blacklist): array();
        if(is_array($user_blacklist)) {
        return in_array(session('id'), $user_blacklist) ? true : false;
        }
    }

    static function MeInFollower($ProfileFollowers) {
        return in_array(session('id'), (array) $ProfileFollowers) ? true : false;
    }

    static function Emoticons() {
        global $sql;
        echo '{';
        foreach($sql->get('smilies', null, array('img', 'code')) as $row){
            echo '"' . $row['code'] . '": "/theme/images/smilies/' . $row['img'] . '",';
        }
        echo '}';
    }

    static function IsMyFriend($array) {
        return in_array(session('id'), (array) $array) ? true : false;
    }

    static function ShowResizedAvatar($id, $size = '100x100') {
        return '/avatars/' . $id . '/' . $size;
    }

    static function ShowAvatarPostSender($file, $sex) {
        $path = 'theme/images/avatars/';
        return self::ShowResizedAvatar(is_file($path . '/' . $file) ? $file : ($sex == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg'));
    }

    static function ShowInfo($info) {
        if (mb_strlen($info, 'UTF-8') > 400) {
            return mb_substr($info, 0, 400, 'UTF-8') . '...';
        } else {
            return $info;
        }
    }

    static function AddLastView($array, $id) {
        global $sql;
        $json = ArrayUnsetValue($array, session('id'));
        $json[] = session('id');
        $json = array_unique($json);
        $json = array_values($json);
        $json = json_encode($json);
        $sql->where('id', $id);
        $sql->update('profiles', array(
            'views' => $json
        ));
    }

    static function ShowLastPosts($action = array()) {
        global $usertype, $options, $sql;
        $users = array();
        $x = 1;
        $sql->join('users u', 'u.id=p.userid', 'LEFT');
        $sql->join('profiles pr', 'pr.id=p.userid', 'LEFT');
        $sql->join('onlines o', 'o.id=p.userid', 'LEFT');
        $sql->orderBy('id', 'desc');
        foreach($sql->get('profile_posts p', 48, array(
            'p.*',
            'u.name',
            'u.type',
            'u.gender',
            'pr.avatar',
            'o.hide',
            'o.id as online'
        )) as $row){
            if (is_array($users) and in_array($row['userid'], $users)) {
                continue;
            }
            $avatar = self::ShowResizedAvatar(is_file('theme/images/avatars/' . $row['avatar']) ? $row['avatar'] : ($row['gender'] == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg'));
            $on = $row['hide'] == '0' ? 'on' : '';
            echo('<li class="list-group-item ' . $on . '" data-toggle="tooltip" data-placement="bottom" title="' . $row['name'] . ' - ' . $usertype[$row['type']]['title'] . '"><a target="_blank" href="/profile/' . $row['userid'] . '"><img src="' . $avatar . '"><span>' . $row['name'] . '</span></a></li>');
            $users[] = $row['userid'];
            if ($x == 12) {
                break;
            }
            $x++;
        }
        unset($users, $x);
    }

    static function LDUserCount($profile, $location) {
        $count = array();
        $ldavatar = (array) json_decode((string) $profile[$location], true);
        $count['likes'] = (isset($ldavatar['likedusers']) and is_array($ldavatar['likedusers'])) ? count($ldavatar['likedusers']) : 0;
        $count['dislikes'] = (isset($ldavatar['dislikedusers']) and is_array($ldavatar['dislikedusers'])) ? count($ldavatar['dislikedusers']) : 0;
        return $count;
    }

    static function ShowUsers($action) {
		global $usertype, $options, $sql;

        if (count($action) == '0') {
            return;
        }
        if (!empty($action)) {
            $action = array_slice($action, -12, 12);
            $implode = implode(',', $action);
            $query = db::query("SELECT o.`hide`,u.`name`,u.`id`,u.`type`,u.`gender`, p.`avatar`, o.`id` AS online FROM {prefix}users u LEFT JOIN {prefix}profiles p ON p.`id` = u.`id` LEFT JOIN {prefix}onlines o ON o.`id` = u.`id` WHERE u.`id` IN($implode) ORDER BY FIELD(u.`id`,$implode) DESC");
            while ($row = mysqli_fetch_array($query)) {
                $avatar = Profile::ShowResizedAvatar(is_file('theme/images/avatars/' . $row['avatar']) ? $row['avatar'] : ($row['gender'] == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg'));
                $on = $row['hide'] == '0' ? 'on' : '';
                echo('<li class="list-group-item ' . $on . '" data-toggle="tooltip" data-placement="bottom" title="' . $row['name'] . ' - ' . $usertype[$row['type']]['title'] . '"><a target="_blank" href="/profile/' . $row['id'] . '"><img src="' . $avatar . '"><span>' . $row['name'] . '</span></a></li>');
            }
            mysqli_free_result($query);
			/*$query = $sql->where('u.`id`', $action, 'in')->join('profiles as p', 'p.`id` = u.`id`', 'LEFT')->join('onlines as o', 'o.`id` = u.`id`', 'LEFT')->get('users as u', null, array('o.`hide`', 'u.`name`', 'u.`id`', 'u.`type`', 'u.`gender`', 'p.`avatar`', 'o.`id` as online'));
			foreach ($query as $row) {
				$avatar = Profile::ShowResizedAvatar(is_file('theme/images/avatars/' . $row['avatar']) ? $row['avatar'] : ($row['gender'] == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg'));
				$on = $row['hide'] == '0' ? 'on' : '';
				echo '<li class="list-group-item ' . $on . '" data-toggle="tooltip" data-placement="bottom" title="' . $row['name'] . ' - ' . $usertype[$row['type']]['title'] . '"><a target="_blank" href="/profile/' . $row['id'] . '"><img src="' . $avatar . '"><span>' . $row['name'] . '</span></a></li>';
			}*/
        }
    }

    static function Send2Friends($text) {
        global $usertype, $sql;

        $myid = session('id');
        $type = $usertype[session('type')]['icon'];
        $sex = session('gender') == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
        $color = $usertype[session('type')]['color'];
        $textColor = session('color') == '000000' || !session('color') ? 'red' : '#' . session('color');
        $profile = '<a href="/profile/' . $myid . '" target="_blank" title="پروفایل"><img src="' . theme::url("theme/images/chat/chat.pr.png") . '" /></a>';

        $note = '<table dir="rtl" cellpadding="3" border="1" align="center">
						<tr><td><b>کاربر:</b></td><td><b><a href=javascript:void(0) onclick=changeUserEvent("privatwin_' . $myid . '")><font color=' . $color . '>' . session('name') . '</font></a></b> <img src="/' . $type . '"><img src="' . $sex . '"></td></tr>
						<tr><td><b>آدرس پروفايل:</b></td><td>' . $profile . '</td></tr>
						<tr><td><b>متن:</b></td><td><b><font color=green>' . $text . '</font></b></td></tr>
					</table><hr>';

        $myfriends = Users::get('friends', $myid);
        $myfriends = json_decode($myfriends, true);

      if (count((array) $myfriends) == '0') {
            return;
        }
        $implode = implode(',', $myfriends);
        $sql->where("o.id", $myfriends,'in');
        $sql->join('profiles p', 'p.id=o.id', 'LEFT');
        foreach($sql->get('onlines o', null, array(
            'o.id',
            'o.roomid',
            'p.settings'
        )) as $row){
            $u_setting = json_decode($row['settings'], true);
            if ($u_setting['notification'] == '0') {
                continue;
            }
            $sql->insert('message', array(
                'user' => -1,
                'username' => '<center>SYSTEM [ <b><font color=red>گزارش پروفايل دوستان</font></b> ]</center>',
                'color' => '000000',
                'fontname' => session('fontname'),
                'fontsize' => session('fontsize'),
                'room' => $row['roomid'],
                'text' => $note,
                'date' => time(),
                'to' => $row['id'],
                'into' => 'pm',
                'type' => session('admin')
            ));
        }
    }

    static function SendMessage($id, $text, $textColor) {
        global $usertype, $sql;

        $type = $usertype[session('type')]['icon'];
        $sex = session('gender') == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
        $color = $usertype[session('type')]['color'];
        $profile = '<a href="/profile/' . session('id') . '" target="_blank" title="پروفایل"><img src="' . theme::url("theme/images/chat/chat.pr.png") . '" /></a>';

        $note = '<table cellpadding="3" dir="rtl" border="1" align="center">
					<tr><td><b>کاربر:</b></td><td><b><a href=javascript:void(0) onclick=changeUserEvent("privatwin_' . session('id') . '")><font color=' . $color . '>' . session('name') . '</font></a></b> <img src="/' . $type . '"><img src="' . $sex . '"></td></tr>
					<tr><td><b>متن:</b></td><td><b><font color=' . $textColor . '>' . $text . '</font></b></td></tr>
					<tr><td><b>آدرس پروفايل:</b></td><td>' . $profile . '</td></tr>
				</table><hr>';
        /*$note = array('username'=>session('name'),'action' => $text,'userid'=>session('id'));
		$note = json_encode($note, JSON_UNESCAPED_UNICODE);*/
        $sql->where('o.id', $id);
        $sql->join('profiles p', 'p.id=o.id', 'LEFT');
        $user_s = $sql->getOne('onlines o', array(
            'o.roomid',
            'p.settings'
        ));
        $u_setting = json_decode($user_s['settings'], true);
        if ($u_setting['notification'] == '1') {
            $sql->insert('message', array(
                'user' => -1,
                'username' => '<center>SYSTEMLKCM [ <b><font color=red>گزارش پروفایل شما</font></b> ]</center>',
                'color' => '000000',
                'fontname' => session('fontname'),
                'fontsize' => session('fontsize'),
                'room' => $user_s['roomid'],
                'text' => $note,
                'date' => time(),
                'to' => $id,
                'into' => 'pm',
                'type' => session('admin')
            ));
        }
    }

    static function Report2Admins($pid, $postid) {
        global $usertype, $sql;
        $myid = session('id');
        $type = $usertype[session('type')]['icon'];
        $sex = session('gender') == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
        $color = $usertype[session('type')]['color'];
        //	$textColor = session('color') == '000000' || !session('color') ? 'red' : '#'.session('color');
        $profile = '<a href="/profile/' . $pid . '/' . $postid . '" target="_blank" title="کلیک کنید"><img src="' . theme::url("theme/images/chat/chat.pr.png") . '" /></a>';
        $note = '<table dir="rtl" cellpadding="3" border="1" align="center">
					<tr><td><b>ارسال کننده گزارش:</b></td><td><b><a href=javascript:void(0) onclick=changeUserEvent("privatwin_' . $myid . '")><font color=' . $color . '>' . session('name') . '</font></a></b> <img src="/' . $type . '"><img src="' . $sex . '"></td></tr>
					<tr><td><b>آدرس مستقیم مطلب:</b></td><td>' . $profile . '</td></tr>
					<tr><td><b>متن:</b></td><td><b><font color=red>مطلب مورد نظر مورد دارد</font></b></td></tr>
				</table><hr>';
        $sql->where("admin", array(1,2,3,4,5,6), 'in');
        foreach($sql->get('onlines', null, array('id', 'type', 'roomid')) as $row){
            $sql->insert('message', array(
                'user' => -1,
                'username' => '<center>SYSTEM [ <b><font color=red>ارسال گزارش پروفایل</font></b> ]</center>',
                'color' => '000000',
                'fontname' => session('fontname'),
                'fontsize' => session('fontsize'),
                'room' => $row['roomid'],
                'text' => $note,
                'date' => time(),
                'to' => $row['id'],
                'into' => 'pm',
                'type' => session('admin')
            ));
        }
    }

    static function UserSetting($action, $friends) {
        switch ($action) {
            case 'friends':
                $bool = self::IsMyFriend($friends);
                break;
            case 'all':
                $bool = true;
                break;
            case 'nothing':
                $bool = false;
                break;
            default:
                $bool = false;
                break;
        }
        return $bool;
    }

}

?>
