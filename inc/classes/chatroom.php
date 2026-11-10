<?php

class chatroom {

    static function theCapacity() {
        return (int) $GLOBALS['options']['chat_capacity'];
    }

    static function checkCapacity() {
        global $sql;
        $capacity = self::theCapacity();
          $sql->where("time", 0, '!='); 
          if($sql->getValue('onlines', 'count(*)') < $capacity){
            return false;
        }
        return true;
    }

    static function defaultcolor() {
        return $GLOBALS['options']['chat_defaultcolor'];
    }

    static function defaultfontname() {
        return $GLOBALS['options']['chat_defaultfontname'];
    }

    static function defaultfontsize() {
        return $GLOBALS['options']['chat_defaultfontsize'];
    }

    static function getNameRoom($room_id) {
        global $sql;
        if ($room_id == '') {
            return ('');
        }
        $sql->where("id", $room_id);
        return($sql->getValue('rooms', 'title'));
    }

    static function defaultRoom() {
        global $roomdefault;
        return($roomdefault);
    }

    static function checkroomid($id) {
        global $sql;
        $sql->where("id", $id);
        return $sql->has('rooms');
    }

    static function setDefualtRoom($roomid) {
        global $sql;
        $sql->where("name", 'chat_defaultroom');
        $sql->update('options', array(
            'value' => $roomid
        ));
        self::reloadconfig();
    }
    static function addSmily($img, $code, $id = null, $name = null , $priority = 1) {
        global $sql;
        if ($id == null) {
            $id = 'NULL';
        }
        if (empty($name)) {
            $name = $code;
        } else {
            $name = $name;
        }
        return $sql->insert('smilies', array(
            'id' => $id,
            'img' => $img,
            'code' => $code,
            'name' => $name,
            'priority' => $priority
        ));
    }
    static function delSmily($id, $file = null, $delFile = true) {
        global $sql;
        if ($delFile and is_file("theme/images/smilies/$file")) {
            unlink("theme/images/smilies/$file");
        }
        $sql->where("id", $id);
        $sql->delete('smilies');
    }

    static function createroom($title, $password = null, $wellcomemsg = null) {
        global $sql;
        if ($password == null) {
            $password = '';
        }
        return $sql->insert('rooms', array(
            'title' => $title,
            'password' => $password,
            'wellcomemsg' => $wellcomemsg
        ));
    }

    static function addbadword($word, $canlogin, $replace) {
        global $sql;
        $sql->insert('badwords', array(
            'word' => $word,
            'canlogin' => $canlogin,
            'replace' => $replace
        ));
        self::reloadbadwords();
    }

    static function reloadbadwords() {
        global $sql;
        if (is_writable('inc/badwords.ahy')) {
            $f = fopen('inc/badwords.ahy', 'w');
            $badwords = $sql->get('badwords', null, array('word', 'replace'));
            foreach ($badwords as $word) {
                fwrite($f, "{$word['word']}=>{$word['replace']}\n");
            }
            fclose($f);
        }
    }
  
    static function reloadautoanswer() {
        global $sql;
        $f = fopen('inc/autoanswer.ahy', 'w');
        $autoanswers = $sql->get('autoanswer', null, array('question', 'answer'));
        foreach ($autoanswers as $word) {
            fwrite($f, "{$word['question']}=>{$word['answer']}\n");
        }
        fclose($f);
    }

    static function recompile() {
        $classfile = file('inc/classes.simple.php');
        $classesFiles = array();
        foreach ($classfile as $line) {
            $line = explode("'", $line);
            if (isset($line[1])) {
                $classesFiles[] = $line[1];
            }
        }

        $w = "";
        $w .= '<?php' . "\n";
        foreach ($classesFiles as $classesFile) {
            $file = file($classesFile);
            foreach ($file as $key => $line) {
                if ($key == 0) {
                    continue;
                }
                if ($key == count($file) - 1) {
                    continue;
                }
                $w .= $line;
            }
        }
        $w .='?>';
        $f = fopen('inc/classes.php', 'w');
        fwrite($f, $w);
        fclose($f);
    }

    static function reloadconfig() {
        db::update('options', "`value`='" . strtolower(substr(php_uname(), 0, 7)) . "'", "`name`='OServer'");
        $query = db::query("SELECT * FROM {prefix}options");
        $options = array();
        $optionss = '';
        while ($option = mysqli_fetch_array($query)) {
            $options[$option['name']] = $option['value'];
            $option['value'] = str_replace("'", "\'", (string) $option['value']);
            $optionss .= "\$options['{$option['name']}'] = '{$option['value']}';\n";
        }
        mysqli_free_result($query);
        unset($query, $option);

        $query = db::query("SELECT * FROM {prefix}usertypes ORDER BY `sort` ASC");
        $usertypes = '';
        while ($row = mysqli_fetch_array($query)) {

            if ($row['guest'] == '1') {
                $optionss .= "\$options['defaultusertype'] ='{$row['id']}';\n";
            }
            $usertypes .= "\$usertype['{$row['id']}'] = array('id' => '{$row['id']}', 'title' => '{$row['title']}', 'icon' => '{$row['icon']}', 'score' => '{$row['score']}', 'guest' => {$row['guest']}, 'loginhidden' => {$row['loginhidden']}, 'canlogin' => {$row['canlogin']}, 'admin' => '{$row['admin']}', 'color' => '{$row['color']}', 'taj' => '{$row['taj']}');\n";
        }
        mysqli_free_result($query);

        $site_url = '';
        $options['site_url'] = explode(',', $options['chat_site_url']);
        for ($x = 0; $x != count($options['site_url']); $x++) {
            if ($x > 0) {
                $site_url .=" ";
            }
            $site_url .= '$site_url[' . $x . '] = \'' . $options['site_url'][$x] . '\';';
        }

        $flags = array('{db_server}' => db_server,
            '{db_name}' => db_name,
            '{db_user}' => db_user,
            '{db_pass}' => db_pass,
            '{db_prefix}' => db_prefix,
            '{site_url}' => $site_url,
            '{site_title}' => $options['chat_site_title'],
            '{url_type}' => $options['url_type'],
            '{theme}' => $options['chat_theme'],
            '{pscores}' => $options['chat_pscores'],
            '{historytime}' => $options['chat_historytime'],
            '{strname}' => $options['chat_maxlengthname'],
            '{offlinetime}' => $options['chat_offlinetime'],
            '{systemname}' => $options['chat_systemname'],
            '{systemcolor}' => $options['chat_systemcolor'],
            '{systeminto}' => $options['chat_systeminto'],
            '{defualtcolor}' => $options['chat_defaultcolor'],
            '{defualtfontname}' => $options['chat_defaultfontname'],
            '{defualtfontsize}' => $options['chat_defaultfontsize'],
            '{ipformods}' => $options['chat_ipformods'],
            '{showiplogin}' => $options['chat_showiplogin'],
            '{numsgmain}' => $options['chat_numsgmain'],
            '{roomdefault}' => $options['chat_defaultroom'],
            '{sendmsguest}' => $options['chat_sendmsguest'],
            '{options}' => $optionss,
            '{usertypes}' => $usertypes
        );
        $configfile = file_get_contents('inc/config.simple.php');
        $configfile = str_replace(array_keys($flags), array_values($flags), $configfile);
        $f = fopen('inc/config.php', 'w');
        fwrite($f, $configfile);
        fclose($f);
        db::close();
    }

    static function addlog($type, $input = null, $user = null) {
        global $options, $sql;
        if ($user == null) {
            $user = session('id');
            if (!$user) {
                $user = '0';
            }
        }
        $send2admin = array(3, 4, 5, 7, 8);
        if ($options['send_activity2private_admins'] == 'true') {
            $send2admin[6] = 9;
        }
        if (in_array($type, $send2admin)) {
            self::send2admins($input, $user, $type);
        }
        return $sql->insert('logs', array(
            'ip' => $_SERVER["REMOTE_ADDR"],
            'date' => $_SERVER['REQUEST_TIME'],
            'user' => $user,
            'type' => $type,
            'input' => $input
        ));
    }

    static function send2admins($text, $user, $type) {
        global $usertype;
        global $options;
        global $sql;

        $logs = $type == 9 ? Users::check_permission('logs') : true;
        $allow_admins = json_decode($options['useroptions'], true);

        $mod_info = array('gender' => session('gender'), 'type' => session('type'), 'name' => session('name'));

        $modcolor = $usertype[$mod_info['type']]['color'];

        $reason = '';
        if ($type == '8') {
            $sql->where("author", $user);
            $sql->orderBy('id', 'desc');
            $reason = $sql->getValue('banns','reason');
        }
        $textColor = session('color') == '000000' || !session('color') ? 'red' : '#' . session('color');
        $modsex = $mod_info['gender'] == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
        $note = '<table cellpadding="3" dir="rtl" border="1" align="center">
			<tr><td><b>کاربر:</b></td><td><b><a href=javascript:void(0) onclick=changeUserEvent("privatwin_' . $user . '")><font color=' . $modcolor . '>' . $mod_info['name'] . '</font></a></b></td></tr>
			<tr><td><b>درجه:</b></td><td><img src="/' . $usertype[$mod_info['type']]['icon'] . '"><img src="' . $modsex . '"></td></tr>
			<tr><td><b>عملکرد:</b></td><td><b><font style="direction:rtl;" color=' . $textColor . '>' . $text . '</font></b></td></tr>' . ($type == '8' ? ('<tr><td><b>دلیل:</b></td><td><b><font color=' . $textColor . '>' . $reason . '</font></b></td></tr>') : '') . '
			<tr><td><b>اتاق:</b></td><td><b><font color=' . $textColor . '>' . session('roomname') . '</font></b></td></tr>
			</table><hr>';
        $sql->where('admin', 0, '!=');
        foreach($sql->get('onlines', null, array('id', 'type', 'roomid')) as $row){
            if ($row['roomid'] == '1') {
                $row['roomid'] = '-1';
            }
            if (in_array($row['type'], (array) $allow_admins['send_log2private_admins']) && $logs) {
                $sql->insert('message', array(
                    'user' => -1,
                    'username' => 'SYSTEM [ <b><font color=red>عملکرد مدیران</font></b> ]',
                    'color' => '000000',
                    'fontname' => session('fontname'),
                    'fontsize' => session('fontsize'),
                    'room' => $row['roomid'],
                    'text' => $note,
                    'date' => $_SERVER['REQUEST_TIME'],
                    'to' => $row['id'],
                    'into' => 'pm',
                    'type' => 0
                ));
            }
        }
    }

    static function delguests() {
        global $sql;
        $sql->where('type', 1);
        $sql->where('lastlogin', time() - 604800, '<');
        
        foreach($sql->get('users', null,array('id')) as $row){
            $sql->where('user', $row['id'])->delete('banns');
            $sql->where('user', $row['id'])->delete('logs');
            $sql->where('user', $row['id'])->orWhere('to', $row['id'])->delete('message');
            $sql->where('id', $row['id'])->delete('profiles');
            $sql->where('id', $row['id'])->delete('users');
        }
        self::reloadAvatars();
    }

    static function reloadsmiles() {
		global $sql;
		$dir = "theme/images/smilies/";
		$x = $sql->where('table_name', db_prefix . 'smilies')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
		$sql->delete('smilies');
        $smiles = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    $type = filetype($dir . $file);
                    if ($type == 'file') {
                        $type = pathinfo($dir . $file);
                        $type['extension'] = strtolower($type['extension']);
                        if ($type['extension'] != 'gif') {
                            continue;
                        }
                        $filename = "(s$x).{$type['extension']}";
                        rename($dir . $file, $dir . $filename);
                        $smiles[] = array('id' => $x, 'img' => $filename, 'code' => "(s$x)");
                        $x++;
                    }
                }
                closedir($dh);
            }
        }
        foreach ($smiles as $smile) {
            chatroom::addSmily($smile['img'], $smile['code'], $smile['id']);
        }
    }

    static function reloadmusic() {
		global $sql;
		$dir = "theme/music/";
		$x = $sql->where('table_name', db_prefix . 'player')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
		$sql->delete('player');
        $musices = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    $type = filetype($dir . $file);
                    if ($type == 'file') {
                        $type = pathinfo($dir . $file);
                        $type['extension'] = strtolower($type['extension']);
                        if ($type['extension'] != 'mp3' and $type['extension'] != 'mp2' and $type['extension'] != 'amr' and $type['extension'] != 'ogg' and $type['extension'] != 'wma') {
                            continue;
                        }
                        $filename = "(music$x).{$type['extension']}";
                        rename($dir . $file, $dir . $filename);
                        $musices[] = array('id' => $x, 'filename' => $filename, 'src' => "theme/music/$filename");
                        $x++;
                    }
                }
                closedir($dh);
            }
        }
        foreach ($musices as $music) {
            self::addmusic($music['filename'], $music['src'], $music['id']);
        }
    }

    static function addmusic($title, $src, $id = null, $priority = 1) {
        global $sql;
        if ($id == null) {
            $id = "NULL";
        } else {
            $id = "'$id'";
        }
        $sql->insert('player', array(
            'id' => $id,
            'title' => $title,
            'src' => $src,
            'priority' => $priority
        ));
    }

    static function reloadAvatars() {
        global $options, $sql;
        $avatars = $sql->getValue('profiles', 'avatar', null);
        $avatars = array_unique($avatars);
        $dir = $options['avatar_dir'];
        if (substr($dir, strlen($dir) - 1) != '/') {
            $dir .= '/';
        }
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    $type = filetype($dir . $file);
                    if ($type == 'file') {
                        if (!in_array($file, $avatars)) {
                            unlink($dir . $file);
                        }
                    }
                }
                closedir($dh);
            }
        }
    }

    static function clearVisits() {
        global $sql;
        $sql->where("time", time() - 604800);
        $sql->delete('stats');
    }

    static function clearLogs() {
        global $sql;
        $sql->where("date", time() - 604800);
        $sql->delete('logs');
    }

    static function checkWWW() {
        // هاست، www را به بدون-www ریدایرکت می‌کند؛ اجبار اسکریپت به www با آن در تضاد است و حلقه ریدایرکت می‌سازد
        return;
    }
static function redirect(){
		global $options;
		$redirect_setting = json_decode($options['redirect_setting'], true);
		if($redirect_setting['active'] == 'true' && !empty($redirect_setting['url'])){
			$url_parse = parse_url($redirect_setting['url']);
			if(!preg_match('#http://#i', $url_parse['host'])){
				$url_parse['host'] = 'http://'.$url_parse['host'];
			}
			$rpc = str_replace(array('http://', 'https://'), '', $url_parse['host']);
			if($options['rejecttowww'] == 'true'){
				if(substr($rpc, 0, 4) != 'www.'){
					$url_parse['host'] = "http://www.".$rpc;
				}
			}
			if($_SERVER["HTTP_HOST"] != str_replace(array('http://', 'https://'), '', $url_parse['host'])){
				header("Location: ". $url_parse['host'], true, 301);
				ob_end_flush();
				exit();
			}
		}
	}
	static function redirect302(){
		global $options;
		$redirect_setting302 = json_decode($options['redirect_setting302'], true);
		if($redirect_setting302['active'] == 'true' && !empty($redirect_setting302['url'])){
			$url_parse = parse_url($redirect_setting302['url']);
			if(!preg_match('#http://#i', $url_parse['host'])){
				$url_parse['host'] = 'http://'.$url_parse['host'];
			}
			$rpc = str_replace(array('http://', 'https://'), '', $url_parse['host']);
			if($options['rejecttowww'] == 'true'){
				if(substr($rpc, 0, 4) != 'www.'){
					$url_parse['host'] = "http://www.".$rpc;
				}
			}
			if($_SERVER["HTTP_HOST"] != str_replace(array('http://', 'https://'), '', $url_parse['host'])){
				header("Location: ". $url_parse['host'], true, 302);
				ob_end_flush();
				exit();
			}
		}
}

    static function password_encode($password) {
        global $options;
        if ($options['passcoding'] == 'base64') {
            return(base64_encode($password));
        } elseif ($options['passcoding'] == 'md5') {
            return(md5($password));
        }
    }

    static function password_decode($password) {
        if (!safe::is_md5($password)) {
            return(base64_decode($password));
        } else {
            return '';
        }
    }

    static function checkPermission($permission, $type = null) {
        global $options;
        if ($type == null) {
            $type = session('type');
        }
        if (!$type) {
            $type = '1';
        }
        $useroptions = json_decode($options['useroptions'], true);
        if (isset($useroptions[$permission])) {
            if (in_array($type, $useroptions[$permission])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
static function expr(){
        global $options;
        $host = json_decode($options['host'], true);
        if((time() - $host['lastexpircheck']) > 86400){
            $host['lastexpircheck'] = time();
            $host['expirationUsing'] += 1;
	            if(($host['expirationUsing'] - $host['expiration']) > 5){
                db::update('options', "`value`='true'", "`name`='chat_close'");
                $params =  json_decode($options['chat_closeparam'], true);
                $params['msg'] = 'چت روم شما به علت تمدید نشدن تعطیل شد';
                $params['theme'] = 'close';
                $params['timetolunch'] = time() + 604800;
                $params = json_encode($params, JSON_UNESCAPED_UNICODE);
                db::update('options', "`value`='$params'", "`name`='chat_closeparam'");
            }
            $host = json_encode($host, JSON_UNESCAPED_UNICODE);
            db::update('options', "`value`='$host'", "`name`='host'");
            chatroom::reloadconfig();
			db::close();
        }
    }
}

?>