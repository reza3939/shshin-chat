<?php
class Message {
	static function removeEmoji($text) {
    $clean_text = "";
    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
    $clean_text = preg_replace($regexEmoticons, '', $text);
    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clean_text = preg_replace($regexSymbols, '', $clean_text);
    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
    $clean_text = preg_replace($regexTransport, '', $clean_text);
    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
    $clean_text = preg_replace($regexMisc, '', $clean_text);
    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
    $clean_text = preg_replace($regexDingbats, '', $clean_text);
    return $clean_text;
}
    static function intelligently($text,$wehre = null) {
		global $options;
		if($wehre == "badname" && $options['intelligently_badname'] == "true"){
        $array = array("/", "\/", "*", "^", "&", "%", '$', 'Ù‘', '?', 'ØŸ', '.', 'Ù€', 'Ù‹', 'ÙŒ', 'Ù', 'ØŒ', 'Ø›', ']', '[', '}', '{', 'ÙŽ', 'Ù', 'Ù', 'Ù', 'Û€', 'Â«', 'Â»', 'Ø©', 'Ø¤', 'Ø¥', 'Ø¥', 'Ø£', 'Ø¡', 'Ø¦', '>', '<', '+', 'â˜º', 'â˜»', 'â™¥', 'â™¦', 'â™£', 'â™ ', 'â€¢', 'â—˜', 'â—‹', 'â—™', 'â™‚', 'â™€', 'â™ª', 'â™«', 'â˜¼', 'â–º', 'â—„', 'â†•', 'â€¼', 'Â¶', 'Â§', 'â–¬', 'â†¨', 'â†‘', 'â†“', 'â†’', 'â†', 'âˆŸ', 'â†”', 'â–²', 'â–¼', '!', '#', '$', '%', '&', '"', '*','Ã—','Ã·','+', '-', '.', '/', ':', ';', '<', '=', '>', '?', '@', '[', ']', '^', '_', '`', '{', '|', '}', '~', 'âŒ‚', 'Â€', 'â€¼', 'Ã©', 'Ã¢', 'Â„', 'Ã ', 'Â†', 'Ã§', 'Ãª', 'Ã«', 'Ã¨', 'Ã¯', 'Ã®', 'Â', 'ÂŽ', 'Â', 'Â', 'Ù‘', 'Ù’', 'Ã´', 'Â¤', 'Ù€', 'Ã»', 'Ã¹', 'Â«', 'Â»', 'â–‘', 'â–’', 'â–“', 'â”‚', 'â”¤', 'â•¡', 'â•¢', 'â•–', 'â••', 'â•£', 'â•‘', 'â•—', 'â•', 'â•œ', 'â•›', 'â” ,â””', 'â”´', 'â”¬', 'â”œ', 'â”€', 'â”¼', 'â•ž', 'â•Ÿ', 'â•š', 'â•”', 'â•©', 'â•¦', 'â• ', 'â•', 'â•¬', 'â•§', 'â•¨', 'â•¤', 'â•¥', 'â•™', 'â•˜', 'â•’', 'â•“', 'â•«', 'â•ª', 'â”˜', 'â”Œ', 'â–ˆ', 'â–„', 'â–Œ', 'â–', 'â–€', 'Âµ', 'â‰¡', 'Ù‹', 'ÙŒ', 'Ù', 'ÙŽ', 'Ù', 'Ù', 'â‰ˆ', 'Â°', 'âˆ™', 'Â·', 'âˆš', 'â– ', "Û±", "Û²", "Û³", "Û´", "Ûµ", "Û¶", "Û·", "Û¸", "Û¹", "Û°", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
		}else{
        $array = array("/", "\/", "*", "^", "&", "%", '$', 'Ù‘', '?', 'ØŸ', '.', 'Ù€', 'Ù‹', 'ÙŒ', 'Ù', 'ØŒ', 'Ø›', ']', '[', '}', '{', 'ÙŽ', 'Ù', 'Ù', 'Ù', 'Û€', 'Â«', 'Â»', 'Ø©', 'Ø¤', 'Ø¥', 'Ø¥', 'Ø£', 'Ø¡', 'Ø¦', '>', '<', '+', 'â˜º', 'â˜»', 'â™¥', 'â™¦', 'â™£', 'â™ ', 'â€¢', 'â—˜', 'â—‹', 'â—™', 'â™‚', 'â™€', 'â™ª', 'â™«', 'â˜¼', 'â–º', 'â—„', 'â†•', 'â€¼', 'Â¶', 'Â§', 'â–¬', 'â†¨', 'â†‘', 'â†“', 'â†’', 'â†', 'âˆŸ', 'â†”', 'â–²', 'â–¼', '!', '#', '$', '%', '&', '"', '*','Ã—','Ã·','+', '-', '.', '/', ':', ';', '<', '=', '>', '?', '@', '[', ']', '^', '_', '`', '{', '|', '}', '~', 'âŒ‚', 'Â€', 'â€¼', 'Ã©', 'Ã¢', 'Â„', 'Ã ', 'Â†', 'Ã§', 'Ãª', 'Ã«', 'Ã¨', 'Ã¯', 'Ã®', 'Â', 'ÂŽ', 'Â', 'Â', 'Ù‘', 'Ù’', 'Ã´', 'Â¤', 'Ù€', 'Ã»', 'Ã¹', 'Â«', 'Â»', 'â–‘', 'â–’', 'â–“', 'â”‚', 'â”¤', 'â•¡', 'â•¢', 'â•–', 'â••', 'â•£', 'â•‘', 'â•—', 'â•', 'â•œ', 'â•›', 'â” ,â””', 'â”´', 'â”¬', 'â”œ', 'â”€', 'â”¼', 'â•ž', 'â•Ÿ', 'â•š', 'â•”', 'â•©', 'â•¦', 'â• ', 'â•', 'â•¬', 'â•§', 'â•¨', 'â•¤', 'â•¥', 'â•™', 'â•˜', 'â•’', 'â•“', 'â•«', 'â•ª', 'â”˜', 'â”Œ', 'â–ˆ', 'â–„', 'â–Œ', 'â–', 'â–€', 'Âµ', 'â‰¡', 'Ù‹', 'ÙŒ', 'Ù', 'ÙŽ', 'Ù', 'Ù', 'â‰ˆ', 'Â°', 'âˆ™', 'Â·', 'âˆš', 'â– ', "Û±", "Û²", "Û³", "Û´", "Ûµ", "Û¶", "Û·", "Û¸", "Û¹", "Û°");
		}
        $text = str_replace($array, "", str_replace($array, "", str_replace($array, "", str_replace($array, "", str_replace($array, "", str_replace($array, "", $text))))));
        $text = str_replace(array(" ", "  ", "   "), " ", $text);
  if($options['intelligently_badname'] != "true"){
    $additionals = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "Ø¢", "Ø¨", "Ù¾", "Øª", "Øª", "Ø«", "Ø¬", "Ú†", "Ø­", "Ø®", "Ø¯", "Ø°", "Ø±", "Ú˜", "Ø³", "Ø´", "Øµ", "Ø¶", "Ø·", "Ø¸", "Ø¹", "Øº", "Ù", "Ù‚", "Ú©", "Ú¯", "Ù„", "Ù…", "Ù†", "Ùˆ", "Ù‡", "ÛŒ", "Ø§", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "Û±", "Û²", "Û³", "Û´", "Ûµ", "Û¶", "Û·", "Û¸", "Û¹", "Û°");
        foreach ($additionals as $additional) {
            $text = str_replace($additional, $additional, $text, $len);
            if ($len > 1) {
                $repeat_word = "";
                for ($i = 0;$i < $len;$i++) {
                    $repeat_word.= $additional;
                }
                $text = str_replace($repeat_word, $additional, $text);
            }
        }
      }
        return $text;
    }
static function fa_num_to_en($string) {
    $persian1 = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $persian2 = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $num = range(0, 9);
    $string=str_replace($persian1, $num, $string);
    return str_replace($persian2, $num, $string);
}
    static function add($to, $text, $room, $into) {
        global $sql;
        if ($to != '-1') {
            $room = '-1';
        }
        if ($text !== "{BUZZ}") {
            if (session('italic') == 'italic' && $text !== '{BUZZ}') {
                $text = '<i>' . $text . '</i>';
            }
            if (session('bold') == 'bold' && $text !== '{BUZZ}') {
                $text = '<b>' . $text . '</b>';
            }
        }
        return $sql->insert('message', array('user' => session('id'), 'username' => session('name'), 'color' => session('color'), 'fontname' => session('fontname'), 'fontsize' => session('fontsize'), 'room' => $room, 'text' => $text, 'date' => time(), 'to' => $to, 'into' => $into, 'type' => session('admin')));
    }
    static function AddMasageSYS($text, $room, $to = '-1') {
        global $sql;
        global $systemname;
        global $systemcolor;
        global $systeminto;
        global $defualtfontname;
        global $defualtfontsize;
        $sql->insert('message', array('user' => - 1, 'username' => $systemname, 'color' => $systemcolor, 'fontname' => $defualtfontname, 'fontsize' => $defualtfontsize, 'room' => $room, 'text' => $text, 'date' => time(), 'to' => $to, 'into' => $systeminto, 'type' => 0));
    }
    static function clearHistory() {
        global $historytime, $sql;
        $sql->where("date", time() - $historytime, '<')->delete('message_archive');
        $sql->where("date", time() - $historytime, '<')->delete('logs');
        $sql->where("date", time() - $historytime, '<')->delete('message');
        $sql->where("date", time() - $historytime, '<')->delete('offline_message');
    }
    static function badwords($texts, $into) {
        global $sql;
		global $options;
        include ('inc/badwords.php');
		if($options['intelligently_text'] == 'true'){
        $text = self::fa_num_to_en($texts);
        $text = self::intelligently($texts);
        $check = self::intelligently($texts);
		}else{
        $text = $texts;
        $check = $texts;
		}
        switch ($into) {
            case ('main'):
                $where = 'general';
            break;
            case ('pm'):
                $where = 'private';
            break;
            case ('profile'):
                $where = 'profile';
			break;
			case ('offlinemsg'):
			    $where = 'offlinemsg';
            break;
            default:$where = null;
        }
        foreach ($badwords as $badword) {
           if($where != null){
            if ($badword[$where] != '1') continue;
           }
            $text = str_replace(array("\n", "\r", $badword['word']), array('', '', str_replace(array("\r", "\n"), '', $badword['replace'])), $text);
        }
        return ($text == $check) ? $texts : $text;
    }
    static function Archive() {
        global $sql;
        $prefix = MysqliDb::$prefix;
        $sql->mysqli()->query("INSERT {$prefix}message_archive SELECT * FROM {$prefix}message WHERE `date` < (UNIX_TIMESTAMP() - 900)");
        $sql->where('date', time() - 900, '<')->delete('message');
    }
    static function autoAnswer($text) {
        $answers = file('inc/autoanswer.ahy');
        if (empty($answers)) {
            return $text;
        }
        foreach ($answers as & $answer) {
            $explode = explode('=>', $answer);
            $explode[1] = trim($explode[1]);
            if ($text == $explode[0]) {
                $explode[1] = explode(',', $explode[1]);
                shuffle($explode[1]);
                return ($explode[1][0]);
            }
        }
        return '';
    }
    static function badname_Checker($name, $id, $gender, $type) {
        global $sql;
	global $options;
        global $systemname;
        global $systemcolor;
        global $systeminto;
        global $defualtfontname;
        global $defualtfontsize;
        $detect = false;
        $detect_name = 'چت';
        include ('inc/badnames.php');
         if( $options['intelligently_badname'] == 'true' ){
            $names = self::intelligently($name);
          } else { 
            $names = $name;
         }

	foreach ($badnames as $badname) {
         if ($badname['tablighat'] != '1') continue;
			if (strstr($names, $badname['word'])) {
                $detect = true;
                $detect_name = $badname['word']; 

				$replace = $badname['replace'];
				$autoRename = $badname['autorename']; 
                break;
            }
        }
        if ($detect) {
          global $options;
            $allow_admins = json_decode($options['useroptions'], true);
            $gender = $gender == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
            $color = "#FF1B00";
            $textColor = session('color') == '000000' || !session('color') ? 'red' : '#' . session('color');
			if($autoRename == '1'){
                              if( $options['myword_badname'] == 'true' ){
			         $newname = str_replace(array("\n", "\r", $detect_name), array('', '', str_replace(array("\r", "\n"), '', $replace)), $names);
                                } else { 
                                 $newname = 'User.'.rand(1,999999);
                              }
			Users::rename($id, $newname);	
			$tr = '<tr><td><b>تغییر نام خودکار به:</b></td><td><b><font color=' . $textColor . '>' . $newname . '</font></b></td></tr>';
			}
            $note = '<table cellpadding="3" dir="rtl" border="1" align="center">
			<tr><td><img style="cursor:pointer;" src="' . theme::url('theme/images/chat/chat.wand.png') . '" onclick=changeUserEvent("adminu_' . $id . '")><b>کاربر:</b></td><td><b><font color=' . $color . '>' . $name . '</font></b><img src="' . $gender . '"></td></tr>
							<tr><td><b>نام:</b></td><td><b><font color=' . $textColor . '>' . $name . '</font></b></td></tr>
							<tr><td><b>فیلتر:</b></td><td><b><font color=' . $textColor . '>' . $detect_name . '</font></b></td></tr>
							'.$tr.'
						</table><hr>';
            $query = $sql->where('admin', "0", '!=')->get('onlines', null, array('id', 'type', 'roomid'));
            foreach ($query as $row) {
                if ($row['roomid'] == '1') {
                    $row['roomid'] = '-1';
                }
                if (in_array($row['type'], (array) $allow_admins['send_robo2private_admins'])) {
                    $sql->insert('message', array('user' => '-1', 'username' => 'SYSTEM [ <b><font color=red>ورود نام کاربری فیلتر شده</font></b> ]', 'color' => $textColor, 'fontname' => $defualtfontname, 'fontsize' => $defualtfontsize, 'room' => $row['roomid'], 'text' => $note, 'date' => $_SERVER['REQUEST_TIME'], 'to' => $row['id'], 'into' => 'pm', 'type' => '0'));
                }
            }
        }
    }
    static function Tabligh_Checker($text, $sender, $reciver, $cf,$where=null) {
        global $sql;
        global $systemname;
        global $systemcolor;
        global $systeminto;
        global $defualtfontname;
        global $defualtfontsize;
		global $options;
        $detect = false;
        $detect_word = 'چت';
		if($options['intelligently_text'] == 'true'){
        $text = self::intelligently($text);
		}
        include ('inc/badwords.php');
		foreach ($badwords as $badword) {
            if ($badword['tablighat'] != '1') continue;
		if (strstr($text, $badword['word'])) {
                $text = str_replace(array("\n", "\r", $badword['word']), array('', '', str_replace(array("\r", "\n"), '', $badword['replace'])), $text);
                $detect = true;
                $detect_word = $badword['word'];
                break;
            }
        }
        if ($detect) {
            global $usertype;
           
            $allow_admins = json_decode($options['useroptions'], true);
            $sender_name = $sender;
            $reciver_name = $reciver;
            if ($cf != 'pm' && $cf != 'main') {
                $reciver_full = 'اتاق کنفرانس ' . $reciver_name['name'];
            } else {
                $reciver_full = $reciver_name['name'];
            }
            $type_sender = $usertype[$sender_name['type']]['icon'];
            $type_reciver = $usertype[$reciver_name['type']]['icon'];
            $sex_sender = $sender_name['gender'] == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
            $sex_reciver = $reciver_name['gender'] == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
            $sender_color = $usertype[$sender_name['type']]['color'];
            $reciver_color = $usertype[$reciver_name['type']]['color'];
            $textColor = session('color') == '000000' || !session('color') ? 'red' : '#' . session('color');
            $note = '<table cellpadding="3" dir="rtl" border="1" align="center">
							<tr><td><img style="cursor:pointer;" src="' . theme::url('theme/images/chat/chat.wand.png') . '" onclick=changeUserEvent("adminu_' . $sender_name['id'] . '")><b>ارسال کننده:</b></td><td><b><a href=javascript:void(0) onclick=changeUserEvent("privatwin_' . $sender_name['id'] . '")><font color=' . $sender_color . '>' . $sender_name['name'] . '</font></a></b> <img src="/' . $type_sender . '"><img src="' . $sex_sender . '"></td></tr>
							<tr><td><img style="cursor:pointer;" src="' . theme::url('theme/images/chat/chat.wand.png') . '" onclick=changeUserEvent("adminu_' . $reciver_name['id'] . '")><b>گیرنده:</b></td><td><b><a href=javascript:void(0) onclick=changeUserEvent("privatwin_' . $reciver_name['id'] . '")><font color=' . $reciver_color . '>' . $reciver_full . '</font></a></b> <img src="/' . $type_reciver . '"><img src="' . $sex_reciver . '"></td></tr>
							<tr><td><b>متن:</b></td><td><b><font color=' . $textColor . '>' . $text . '</font></b></td></tr>
							<tr><td><b>فیلتر:</b></td><td><b><font color=' . $textColor . '>' . $detect_word . '</font></b></td></tr>
						</table><hr>';
            $sql->where("admin", '0', '!=');
            foreach ($sql->get('onlines', null, array('id', 'type', 'roomid')) as $row) {
                if ($row['roomid'] == '1') {
                    $row['roomid'] = '-1';
                }
 if (in_array($row['type'], (array) $allow_admins['send_robo2private_admins'])) {
             
                $sql->insert('message', array('user' => - 1, 'username' => 'SYSTEM [ <b><font color=red>پلیس مخفی</font></b> ]', 'color' => 'defaultcolor()', 'fontname' => $defualtfontname, 'fontsize' => $defualtfontsize, 'room' => $row['roomid'], 'text' => $note, 'date' => $_SERVER['REQUEST_TIME'], 'to' => $row['id'], 'into' => 'pm', 'type' => session('admin')));
            }
        } 
        }
    }
static function Offlinemsg_Checker($text, $sender, $reciver, $cf) {
        global $sql;
        global $systemname;
        global $systemcolor;
        global $systeminto;
        global $defualtfontname;
        global $defualtfontsize;
		global $options;
        $detect = false;
        $detect_word = 'چت';
		if($options['intelligently_text'] == 'true'){
        $text = self::intelligently($text);
		}
        include ('inc/badwords.php');
		foreach ($badwords as $badword) {
            if ($badword['offlinemsg'] != '1') continue;
            if ($badword['tablighat'] == '1'){
			if (strstr($text, $badword['word'])) {
                $detect = true;
                $detect_word = $badword['word'];
                break;
            }
           }
        }
        if ($detect) {
            global $usertype;
           
            $allow_admins = json_decode($options['useroptions'], true);
            $sender_name = $sender;
            $reciver_name = $reciver;
            $type_sender = $usertype[$sender_name['type']]['icon'];
            $type_reciver = $usertype[$reciver_name['type']]['icon'];
            $sex_sender = $sender_name['gender'] == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
            $sex_reciver = $reciver_name['gender'] == '2' ? theme::url('theme/images/chat/chat.user_comment_w.png') : theme::url('theme/images/chat/chat.user_comment_m.png');
            $sender_color = $usertype[$sender_name['type']]['color'];
            $reciver_color = $usertype[$reciver_name['type']]['color'];
            $textColor = session('color') == '000000' || !session('color') ? 'red' : '#' . session('color');
            $note = '<table cellpadding="3" dir="rtl" border="1" align="center">
							<tr><td><img style="cursor:pointer;" src="' . theme::url('theme/images/chat/chat.wand.png') . '" onclick=changeUserEvent("adminu_' . $sender_name['id'] . '")><b>ارسال کننده:</b></td><td><b><a href=javascript:void(0) onclick=changeUserEvent("privatwin_' . $sender_name['id'] . '")><font color=' . $sender_color . '>' . $sender_name['name'] . '</font></a></b> <img src="/' . $type_sender . '"><img src="' . $sex_sender . '"></td></tr>
							<tr><td><img style="cursor:pointer;" src="' . theme::url('theme/images/chat/chat.wand.png') . '" onclick=changeUserEvent("adminu_' . $reciver_name['id'] . '")><b>گیرنده:</b></td><td><b><a href=javascript:void(0) onclick=changeUserEvent("privatwin_' . $reciver_name['id'] . '")><font color=' . $reciver_color . '>' . $reciver_name['name'] . '</font></a></b> <img src="/' . $type_reciver . '"><img src="' . $sex_reciver . '"></td></tr>
							<tr><td><b>متن:</b></td><td><b><font color=' . $textColor . '>' . $text . '</font></b></td></tr>
							<tr><td><b>فیلتر:</b></td><td><b><font color=' . $textColor . '>' . $detect_word . '</font></b></td></tr>
						</table><hr>';
            $sql->where("admin", '0', '!=');
            foreach ($sql->get('onlines', null, array('id', 'type', 'roomid')) as $row) {
                if ($row['roomid'] == '1') {
                    $row['roomid'] = '-1';
                }
                if (in_array($row['type'], (array) $allow_admins['send_robo2private_admins'])) {
                $sql->insert('message', array('user' => - 1, 'username' => 'SYSTEM [ <b><font color=red>پلیس پیام افلاین</font></b> ]', 'color' => 'defaultcolor()', 'fontname' => $defualtfontname, 'fontsize' => $defualtfontsize, 'room' => $row['roomid'], 'text' => $note, 'date' => $_SERVER['REQUEST_TIME'], 'to' => $row['id'], 'into' => 'pm', 'type' => session('admin')));
            }
        }
    }
 }
 static function Profile_Checker($text) {
        global $sql;
        global $systemname;
        global $systemcolor;
        global $systeminto;
        global $defualtfontname;
        global $defualtfontsize;
		global $options;
        $detect = false;
        $detect_word = 'چت';
		if($options['intelligently_text'] == 'true'){
        $text = self::intelligently($text);
		}
        include ('inc/badwords.php');
		foreach ($badwords as $badword) {

            if ($badword['profile'] != '1') continue;
            if ($badword['tablighat'] == '1'){
			if (strstr($text, $badword['word'])) {
                $detect = true;
                $detect_word = $badword['word'];
                break;
            }
          }            
        }
        if ($detect) {
              return "مورد دار است";
          }
    }

    static function autosilent($text,$into) {
        global $sql;
        global $systemname;
        global $systemcolor;
        global $systeminto;
        global $defualtfontname;
        global $defualtfontsize;
        global $options;
        $detect = false;
        $ban_types = json_decode($options['useroptions'], true);
		if($options['intelligently_text'] == 'true'){
        $text = self::intelligently($text);
		}
		include ('inc/badwords.php');
		    switch ($into) {
            case ('main'):
                $where = 'general';
            break;
            case ('pm'):
                $where = 'private';
            break;
        }
		foreach ($badwords as $badword) {
            if ($badword['silent'] != '1' or $badword[$where] != '1') continue;
			if (strstr(mb_strtolower($text, "utf-8"), $badword['word'])) {
                $detect = true;
                break;
            }
        }
        if ($detect AND in_array(session('type'), (array) $ban_types['UsersForBann'])) {
            if (!session('robo_silent')) {
                session('robo_silent', '0');
            }
            $repeat = session('robo_silent');
            $repeat++;
            if ($repeat < $options['repeat_robo_silent']) {
                session('robo_silent', $repeat);
                $n = $options['repeat_robo_silent'] - $repeat;
                return "در متن ارسالی شما کلمه مورد دار شناسایی شد شما بیشتر از $n بار دیگر تکرار کنید توسط سیستم ساکت میشوید";
            } else {
                $time = ($options['silent_time_robo'] * 60) + time();
                $sec = $time * 60;
                $users = array();
                $sql->where("id", session('id'));
                foreach ($sql->get('onlines', null, array('id', 'inputs', 'name')) as $row) {
                    $row['inputs'] = json_decode($row['inputs'], true);
                    $row['inputs']['silent'] = '1';
                    $row['inputs']['simg'] = 'status_silent';
                    $row['inputs']['avatar'] = $row['inputs']['avatar'];
                    $row['inputs']['stext'] = $sec;
                    Users::Inputs($row['id'], $row['inputs']);
                    chatroom::addlog('5', "ساکت کردن کاربر \"{$row['name']}\" به مدت  " . safe::number($options['silent_time_robo']) . " توسط سیستم دقیقه");
                    $users[] = $row['id'];
                }
                $users = implode(',', $users);
                $sql->insert('silents', array('ip' => ip(), 'muter' => '54111241', 'time' => $time, 'users' => $users, 'where' => '1'));
                session('robo_silent', '0');
                return "شما توسط سیستم ساکت شدید";
            }
        } else {
            return 'null';
        }
    }
    static function robo_cleaner($text, $id) {
        global $sql;
        global $systemname;
        global $systemcolor;
        global $systeminto;
        global $defualtfontname;
        global $defualtfontsize;
        $detect = false;
        include ('inc/badwords.php');
		foreach ($badwords as $badword) {
            if ($badword['cleaner'] != '1') continue;
			if (strstr(mb_strtolower($text, "utf-8"), $badword['word'])) {
                $detect = true;
                break;
            }
        }
        if ($detect) {
            $data = array('action' => 'delete', 'msgid' => $id);
            $text = json_encode($data, JSON_UNESCAPED_UNICODE);
            $sql->insert('message', array('user' => '-1', 'username' => $systemname, 'color' => $systemcolor, 'fontname' => $defualtfontname, 'fontsize' => $defualtfontsize, 'room' => '-1', 'text' => $text, 'date' => $_SERVER['REQUEST_TIME'], 'to' => '-1', 'into' => 'deletmsg', 'type' => '0'));
        }
    }
    static function SendOfflineMessage($id, $to, $text) {
        global $sql;
		$text = self::badwords($text,'offlinemsg');
        $row = $sql->where('userid', $to)->where('sender_id', $id)->getOne('offline_message', array('count(*)', 'text'));
        if ($row['count'] > 0) {
            if (empty($row['text'])) {
                $row['text'].= $text;
            } else {
                $row['text'].= ',' . $text;
            }
            $sql->where('userid', $to)->where('sender_id', $id)->update('offline_message', array('text' => $row['text']));
        } else {
            $sql->insert('offline_message', array('id' => null, 'userid' => $to, 'text' => $text, 'sender_id' => $id, 'date' => time()));
        }
    }
}
?>