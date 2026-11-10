<?php

class Users {

    static function setOnline($time = null, $lastcheck = null, $inputs = null) {
        if ($time == null) {
            $time = $_SERVER['REQUEST_TIME'];
        } else {
            $time = "'$time'";
        }
        if ($lastcheck != null) {
            $lastcheck = ", `lastcheck`='$lastcheck'";
        }
        if ($inputs != null) {
            $inputs = json_encode($inputs, JSON_UNESCAPED_UNICODE);
            $inputs = ", `inputs`='$inputs'";
        }
        db::update('onlines', "`time`=$time, `ip`='" . ip() . "'$lastcheck $inputs", "`id`='" . session('id') . "'");
        db::close();
    }

    static function addOnline($id, $username, $name, $gender, $type, $hide, $roomid, $roomname, $visualuser = false) {
        if ($visualuser == false) {
            $time = $_SERVER['REQUEST_TIME'];
            $ip=ip();
        } else {
            $time = "'0'";
            $ip=rand(1,99).'.'.rand(1,999).'.'.rand(1,999).'.'.rand(1,9);
        }
        if (db::num('onlines', "`id`='$id'") < 1) {
            db::insert('onlines', '`id`, `admin`, `username`, `name`, `gender`, `time`, `type`, `hide`, `roomid`, `roomname`, `ip`, `inputs`, `score`, `bank`', "'$id', '0', '$username', '$name', '$gender', $time, '$type', '$hide', '$roomid', '$roomname', '".$ip."', '', '0', '0'");
            self::Inputs($id, 'newuser');
        } else {
            db::update('onlines', "`time`=$time", "`id`='$id'");
        }
        db::close();
    }

    static function CheckBann() {
           global $sql;
		foreach ($sql->get('banns', null, array('ip','date')) as $row) {
            if (substr(ip(), 0, strlen($row['ip'])) == $row['ip'] && $row['date'] > time()) {
                   return true;
			   }
			 }
        return(db::num('banns', "`ip`='" . ip() . "'") > 0 ? true : false);
    }

    static function CheckProfile($id = null) {
        if ($id == null) {
            $id = session('id');
        }
        if (db::num('profiles', "`id`='$id'") == 0) {
            if ($user = db::get('users', "*", "`id`='$id'")) {
                db::insert('profiles', "`id`, `gender`, `birthdate`, `registerdate`, `ip`, `avatar`, `info`, `site`, `lastview`, `online`, `country`, `city`, `active`", "'$id', '{$user['gender']}', '0|1', UNIX_TIMESTAMP(), '{$user['ip']}', 'photo.png', '', '{$GLOBALS['site_url'][0]}', UNIX_TIMESTAMP(), '1', 'iran', '', '1'");
            }
        }
        db::close();
    }

    static function CheckId($id) {
        return(db::num('users', "`id`='$id'") > 0 ? true : false);
    }

    static function Checkrunning($name, $rename = false) {
        global $options;
        $column = $rename ? 'name' : 'username';
        return(db::num('onlines', "`$column`='$name'") or db::num('users', "`$column`='$name' and `type`!='{$options['defaultusertype']}'") ? true : false);
    }

    static function addUser($username, $name, $type, $gender, $email = '', $password = '', $mob = '') {
        db::insert('users', '`username`, `name`, `type`,`active`, `ip`, `gender`, `online`, `lastview`, `lastlogin`, `email`, `password` , `mobile`, `bank`, `report`, `inputs`, `file`, `blacklist`, `pending`, `cfpending`, `setting`, `typesetting`', "'$username', '$name', '$type', '1', '{$_SERVER["REMOTE_ADDR"]}', '$gender', '1', UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), '$email', '$password' , '$mob', '0', '0', '', '', '', '', '', '', ''");
        $user = db::$id;
        // db::insert('profiles', "`id`, `gender`, `birthdate`, `registerdate`, `ip`, `avatar`, `info`, `site`, `lastview`, `online`, `country`, `city`", "'$user', '$gender', '0|1', UNIX_TIMESTAMP(), '{$_SERVER["REMOTE_ADDR"]}', 'photo.png', '', '{$GLOBALS['site_url'][0]}', UNIX_TIMESTAMP(), '1', 'ایران', ''");
        db::close();
        return($user);
    }

    static function get($re, $id = '') {
        if ($id == '0') {
            return;
        }
        if ($id == '') {
            $id = session('id');
        }
        if ($re != '*') {
            $col = "`$re`";
        } else {
            $col = '*';
        }
        $result = db::get('users', $col, "`id`='$id'");
        db::close();
        return $result[0];
    }

    static function getOnlines($re, $id = '') {
        if ($id == '0') {
            return;
        }
        if ($id == '') {
            $id = session('id');
        }
        if ($re != '*') {
            $col = "`$re`";
        } else {
            $col = '*';
        }
        $result = db::get('onlines', $col, "`id`='$id'");
        return $result;
    }

    static function getByName($re, $name = '') {
        if ($name == '0') {
            return;
        }
        if ($re != '*') {
            $col = "`$re`";
        } else {
            $col = '*';
        }
        $result = db::get('users', $col, "`username`='$name'");
        db::close();
        return $result[0];
    }

    static function bann($id, $date, $reason) {
        db::delete('banns', "`user`='$id'");
        $user = db::get('users', '`name`,`ip`', "`id`='$id'");
        $ip = $user['ip'];
        $name = $user['name'];
        db::insert('banns', '`ip`, `date`, `to`, `author`, `user`, `reason`', "'$ip', UNIX_TIMESTAMP(), '$date', '" . session('id') . "', '$id', '$reason'");
        $inputs = self::Inputs($id);
        $inputs['benned'] = '1';
        self::Inputs($id, $inputs);
        db::update('users', "`active`='0',`online`='0'", "`id`='$id'");
        db::update('profiles', "`active`='0'", "`id`='$id'");
        chatroom::addlog('8', "کاربر " . $name . " را تا " . jdate::start('Y/m/d H:i:s', $date) . " اخراج نمود");
		 $text = "کاربر " . $name . " را تا " . jdate::start('Y/m/d H:i:s', $date) . " اخراج نمود\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
       if($tel['bannlog'] == 'Sure'){
             tlg($text,'chat');
                 }
        db::close();
    }

    static function setIP($id) {
        db::update('users', "`ip`='{$_SERVER["REMOTE_ADDR"]}', `lastlogin`= '" . $_SERVER['REQUEST_TIME'] . "', `online`='1'", "`id`='$id'");
        db::close();
    }

    static function hide($id) {
        db::update('onlines', "`hide`='1'", "`id`='$id'");
        db::close();
    }

    static function show($id) {
        db::update('onlines', "`hide`='0'", "`id`='$id'");
        db::close();
    }

    static function AdminsType($type = null) {
        global $usertype;
        $types = array();
        foreach ($usertype as $val) {
            if ($val['admin'] != '0') {
                $types[] = $val['id'];
            }
        }

        if ($type != null) {
            foreach ($types as $t) {
                if ($type == $t) {
                    return true;
                }
            }
            return false;
        } else {
            return $types;
        }
    }

    static function is_admin($type) {
        global $usertype;
        $types = array();
        foreach ($usertype as $val) {
            if ($val['admin'] != '0') {
                $types[] = $val['id'];
            }
        }

        foreach ($types as $t) {
            if ($type == $t) {
                return true;
            }
        }
        return false;
    }

    static function is_type($type) {
        global $usertype;
        return isset($usertype[$type]);
    }

    static function guestType($type = null) {
        global $usertype;
        $types = array();
        foreach ($usertype as $val) {
            if ($val['guest'] == 1) {
                $types[] = $val['id'];
            }
        }
        if ($type != null) {
            foreach ($types as $t) {
                if ($type == $t) {
                    return true;
                }
            }
            return false;
        } else {
            return $types;
        }
    }

    static function Offline($id) {
        global $options;
        if ($online = db::get('onlines', '`name`, `type`, `time`, `inputs`, `score`, `bank`', "`id`='$id'")) {
            if ($online['time'] != 0) {
                $user = db::get('users', "`score`, `bank`, `lastlogin`, `onlinetime`, `type`", "`id`='$id'");
                if ($options['getscoretype'] == 'login') {
                    global $pscores;
                    $onlinetime = $online['time'] - $user['lastlogin'];
                    $score = round($onlinetime / $pscores);
                    $score += $user['score'];
                    if ($options['update_bank'] == "true") {
                        $bank = round($onlinetime / ($options['time_bank'] * 60));
                        $bank += $user['bank'];
                    } else {
                        $bank = $user['bank'];
                    }
                    $onlinetime += $user['onlinetime'];
                    $type = self::changetype($user['type'], $score);
                } elseif ($options['getscoretype'] == 'ajax') {
                    $score = (int) $online['score'];
                    $bank = (int) $online['bank'];
                    $onlinetime = $online['time'] - $user['lastlogin'];
                    $onlinetime += $user['onlinetime'];
                    $type = self::changetype($online['type'], (int) $score);
                }
                db::update('users', "`onlinetime` = '$onlinetime', `online`='0', `lastview`='" . $online['time'] . "', `score`='$score', `bank`='$bank', `type`='$type'", "`id`='$id'");
                db::delete('onlines', "`id`='$id'");
                Message::AddMasageSYS($online['name'] . " از چت روم خارج شد.", '-1');
                chatroom::addlog('2', $online['name'] . " از چت روم خارج شد.", $id);
            }
        }
        db::close();
    }

    static function changetype($type, $score) {

        if (!self::guestType($type) and ! self::AdminsType($type)) {
            global $usertype;
            global $options;
            $types = array();
            foreach ($usertype as $val) {
                if ($val['guest'] == 1) {
                    continue;
                }
                if ($val['admin'] == '1') {
                    continue;
                }
                if ($options['automod'] == 'false' and $val['admin'] != '0') {
                    continue;
                }
                $types[$val['id']] = (int) $val['score'];
            }
            arsort($types);

            foreach ($types as $id => $scoree) {
                if ($score > $scoree) {
                    $type = $id;
                    break;
                }
            }
        }
        return $type;
    }

    static function Checkregister($id) {
        $type = db::get('users', 'type', "`id`='$id'");
        db::close();
        return(self::guestType($type) ? false : true);
    }

    static function lowestlevelregister() {
        global $usertype;
        $types = array();
        foreach ($usertype as $val) {
            if ($val['guest'] == 1) {
                continue;
            }
            if ($val['admin'] != '0') {
                continue;
            }
            $types[$val['id']] = (int) $val['score'];
        }
        asort($types);

        foreach ($types as $key => $val) {
            $val = $usertype[$key];
            if ($val['admin'] == '0' and $val['guest'] == '0' and $val['score'] == '0') {
                return($key);
            }
        }
    }

    static function CheckAdmin($id) {
        $type = db::get('users', 'type', "`id`='$id'");
        db::close();
        return(self::AdminsType($type) ? true : false);
    }

    static function rename($id, $newname) {
        if (!session('id')) {
            die();
        }
        // $carrentName = db::get('users', 'name', "`id`='$id'");
        db::update('users', "`name`='$newname'", "`id`='$id'");
        db::update('onlines', "`name`='$newname'", "`id`='$id'");
        $inputs = self::Inputs($id);
        $inputs['alert'] = 'نام شما توسط یکی از مدیران یا ناظرین عوض شد';
        self::Inputs($id, $inputs);
        //Message::AddMasageSYS("$carrentName نام خود را به $newname تغیر داد", '-1');
        db::close();
    }

    static function autoOffline() {
        global $offlinetime;
        $result = db::query("SELECT `id` FROM `{prefix}onlines` WHERE (`time` < (UNIX_TIMESTAMP()-$offlinetime)) and `time` != '0'");
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            self::Offline($row['id']);
        }
        mysqli_free_result($result);
        db::close();
    }

    static function refresh($id, $value) {
        if (!session('id')) {
            die();
        }
        $inputs = self::Inputs($id);
        $inputs['refresh'] = $value;
        self::Inputs($id, $inputs);
        if ($value != '0') {
            chatroom::addlog('4', "رفرش صفحه " . Users::get('name', $id));
        }
        db::close();
    }

    static function reload($id) {
        if (!session('id'))
            die();
        $inputs = self::Inputs($id);
        $inputs['refresh'] = '1';
        self::Inputs($id, $inputs);
        db::close();
    }

    static function warning($id, $value) {
        if (!session('id')) {
            die();
        }
        $inputs = self::Inputs($id);
        $inputs['alert'] = $value;
        self::Inputs($id, $inputs);
        if ($value != 'null') {
            chatroom::addlog('3', "(به:" . Users::get('name', $id) . ") $value");
        }
        db::close();
    }

    static function alert($id, $value) {
        if (!session('id'))
            die();
        $inputs = self::Inputs($id);
        $inputs['alert'] = $value;
        self::Inputs($id, $inputs);
        db::close();
    }

    static function exitt($id, $value, $checkSession = true) {
        if (!session('id') && $checkSession) {
            die();
        }
        //if(session('admin') == '0')return;
        $inputs = self::Inputs($id);
        $inputs['exit'] = $value;
        self::Inputs($id, $inputs);
        if ($value != '0') {
            chatroom::addlog('5', "بیرون کردن " . Users::get('name', $id));
        }
        db::close();
    }

    static function repass($id, $newpass) {
        if (!session('id')) {
            die();
        }
        db::update('users', "`password`='$newpass'", "`id`='$id'");
        chatroom::addlog('6', "تغییر کلمه عبور  " . Users::get('name', $id) . " به \"$newpass\"");
        db::close();
    }

    static function clear($id, $value) {
        if (!session('id')) {
            die();
        }
        $inputs = self::Inputs($id);
        $inputs['clear'] = $value;
        self::Inputs($id, $inputs);
        db::close();
    }

    static function GetType($type) {
        global $usertype;
        /*
          $title = '';
          foreach($usertype as $t){8
          if($t['id'] == $type){
          $title = $t['title'];
          break;
          }
          } */
        return $usertype[$type]['title'];
    }

    static function Inputs($user = null, $value = null) {
        $valuenew = array('refresh' => '0',
            'alert' => 'null',
            'exit' => 'false',
            'benned' => '0',
            'clear' => '0',
            'avatar' => '',
            'score' => 0,
            'bank' => 0,
            'lastsendtxt' => '',
            'lastsendnum' => 0,
            'lastcheckajax' => 0,
            'lastgetrank' => 0,
            'simg' => '',
            'stext' => '',
            'silent' => 0,
            'status_private' => 'pmme',
            'status_c2c' => 'reqme',
            'my_blacklist' => array(),
            'permission' => array()
            );
        if ($user == null) {
            $user = session('id');
        }
        if ($value == null) {
            $stored = json_decode(db::get('onlines', "inputs", "`id`='$user'"), true);
            return array_merge($valuenew, is_array($stored) ? $stored : array());
        } else {
            if (is_array($value)) {
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            } elseif ($value == 'newuser') {
                $avatar = db::get('profiles', "avatar", "`id`='$user'");
                $score = (int) db::get('users', "score", "`id`='$user'");
                $bank = (int) db::get('users', "bank", "`id`='$user'");
                $value = $valuenew;
                $value['avatar'] = $avatar;
                $value['score'] = (int) $score;
                $value['bank'] = (int) $bank;
                if (isset($GLOBALS['silent'])) {
                    $value['silent'] = $GLOBALS['silent'];
                }
                db::update('onlines', "`score`='$score', `bank`='$bank'", "`id`='$user'");
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            } elseif ($value == 'newvisualuser') {
                $avatar = 'photo.png';
                $score = 0;
                $bank = 0;
                $value = $valuenew;
                $value['avatar'] = $avatar;
                $value['score'] = (int) $score;
                $value['bank'] = (int) $bank;
                db::update('onlines', "`score`='$score', `bank`='$bank'", "`id`='$user'");
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            } elseif ($value == 'update') {
                $now = json_decode(db::get('onlines', "inputs", "`id`='$user'"), true);
                $now = is_array($now) ? $now : array();
                if (count((array) $now) != count($valuenew)) {
                    $avatar = db::get('profiles', "avatar", "`id`='$user'");
                    $score = (int) db::get('onlines', "score", "`id`='$user'");
                    $bank = (int) db::get('onlines', "bank", "`id`='$user'");
                    $value = array_merge($valuenew, $now);
                    $value['avatar'] = $avatar;
                    $value['score'] = (int) $score;
                    $value['bank'] = (int) $bank;
                    db::update('onlines', "`score`='$score', `bank`='$bank'", "`id`='$user'");
                    $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                } else {
                    $value = json_encode($now, JSON_UNESCAPED_UNICODE);
                }
            }
            db::update('onlines', "`inputs`='$value'", "`id`='$user'");
        }
    }

    static function is_online($id) {
        return(db::num('onlines', "`id`='$id'") > 0 ? true : false);
    }

    static function check_permission($perm) {
        $return = false;
        $get = db::get('adminpanel', '`permissions`', "`user`='" . session('id') . "'");
        if ($get[0] != 'all') {
            $explode = explode(',', $get[0]);
            foreach ($explode as $perms) {
                if ($perm == $perms) {
                    $return = true;
                    break;
                }
            }
        } elseif ($get[0] == 'all') {
            $return = true;
        } else {
            $return = false;
        }
        db::close();
        return $return;
    }

}

?>