<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'specialactions');
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
 $tel = json_decode($options['teloptions'], true);
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}

$action = isset($_REQUEST['action']) ? safe::string($_REQUEST['action']) : '';
if ($action == 'delmsgs') {

    $t = time() - 5;
	$sql->where("date", $t, '<')->delete('message');
	$sql->where("date", $t, '<')->delete('message_archive');

if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "تاریخچه را حذف کرد");
}

   $text = "تاریخچه را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delguestime') {
    $time = isset($_REQUEST['time']) ? safe::number($_REQUEST['time']) : '';
    if ($time < 691201 and $time > 29) {
		$sql->where("type", 1);
		$sql->where("lastlogin", time() - $time * 60, '<');
		foreach ($sql->get('users', null, array('id')) as $row) {
			$sql->where("user", $row['id'])->delete('banns');
			$sql->where("user", $row['id'])->delete('logs');
			$sql->where("user", $row['id'])->orWhere("to", $row['id'])->delete('message');
			$sql->where("user", $row['id'])->orWhere("to", $row['id'])->delete('message_archive');
			$sql->where("id", $row['id'])->delete('profiles');
			$sql->where("userid", $row['id'])->delete('profile_posts');
			$sql->where("id", $row['id'])->delete('users');
        }



    
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
        chatroom::addlog('9', "تمامی کاربران مهمان $time به قبل را حذف کرد.");
}
 $text = "تمامی کاربران مهمان $time به قبل را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
        echo('ok');
    }
} elseif ($action == 'alertonlines') {

    $text = isset($_REQUEST['textalert']) ? safe::string($_REQUEST['textalert']) : '';
    if ($text != '') {
		$sql->where("time", 0, '!=');
		foreach ($sql->get('onlines', null, array('id', 'inputs')) as $row) {
            $inputs = json_decode($row['inputs'], true);
            $inputs['alert'] = $text;
            Users::Inputs($row['id'], $inputs);
        }
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
      chatroom::addlog('9', "به تمام کاربران آنلاین این متن را  اخطار داد: $text");
}
    $text = "به تمام کاربران آنلاین این متن را  اخطار داد: $text\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
        echo('ok');
    }
} elseif ($action == 'alertadmins') {

    $text = isset($_REQUEST['textalert1']) ? safe::string($_REQUEST['textalert1']) : '';
    if ($text != '') {
		$sql->where("time", 0, '!=');
		$sql->where("admin", 0, '!=');
		foreach ($sql->get('onlines', null, array('id', 'inputs')) as $row) {
            $inputs = json_decode($row['inputs'], true);
            $inputs['alert'] = "ارسال کننده: " . session('name') . " || درجه: " . $usertype[session('type')]['title'] . "  || " . $text;
            Users::Inputs($row['id'], $inputs);
        }


if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
        chatroom::addlog('9', "به تمام مدیران و ناظرین آنلاین این متن را  اخطار داد: $text");
}
 $text = "به تمام مدیران و ناظرین آنلاین این متن را  اخطار داد: $text\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
        echo('ok');
    }
} elseif ($action == 'deloldmsgs') {
    $t = time() - 18000;
	$sql->where("date", $t, '<')->delete('message');
	$sql->where("date", $t, '<')->delete('message_archive');

    
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "پیام های قدیمی تاریخچه را حذف کرد");
}
$text = "پیام های قدیمی تاریخچه را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delofflinemessage') {
	$sql->delete('offline_message');        
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "تمام پیام های آفلاین را حذف کرد");
}
    $text = "تمام پیام های آفلاین را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }

    echo('ok');
} elseif ($action == 'delguests') {
    chatroom::delguests();
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "کاربران اضافی را حذف نمود!");
}
  $text = "کاربران اضافی را حذف نمود!\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }

    echo('ok');
} elseif ($action == 'delusers') {

	$sql->where("user", session('id'), '!=')->delete('adminpanel');
	$sql->delete('banns');
	$sql->where("to", session('id'), '!=')->delete('letters');
	$sql->delete('message');
	$sql->delete('message_archive');
	$sql->where("id", session('id'), '!=')->delete('onlines');
	$sql->where("id", session('id'), '!=')->delete('profiles');
	$sql->where("userid", session('id'), '!=')->delete('profile_posts');
	$sql->where("id", session('id'), '!=')->delete('users');
	$sql->where("id", session('id'), '!=')->delete('register');
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "تمامی کاربران و اطلاعاتشان را حذف کرد");
}
  $text = "تمامی کاربران و اطلاعاتشان را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }

    echo('ok');
} 
elseif ($action == 'activeprofs') {
	$sql->where("active", 0)->update('profiles', array(
		'active' => 1
	));

if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "تمامی پروفایل های غیرفعال را فعال کرد");
}
   $text = "تمامی پروفایل های غیرفعال را فعال کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
}

elseif ($action == 'deldactived') {
	$users = array_column($sql->where("active", 0)->get('users', null, array('id')), 'id');
	if ($users) {
		$sql->where("user", $users, 'in')->delete('adminpanel');
		$sql->where("user", $users, 'in')->delete('banns');
		$sql->where("user", $users, 'in')->delete('logs');
		$sql->where("user", $users, 'in')->orWhere("to", $users, 'in')->delete('message');
		$sql->where("user", $users, 'in')->orWhere("to", $users, 'in')->delete('message_archive');
		$sql->where("id", $users, 'in')->delete('profiles');
		$sql->where("userid", $users, 'in')->delete('profile_posts');
		$sql->where("id", $users, 'in')->delete('users');
		$sql->where("user", $users, 'in')->delete('register');
		$sql->where("to", $users, 'in')->delete('letters');
		$sql->where("id", $users, 'in')->delete('onlines');

    
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
        chatroom::addlog('9', "تمامی کاربران غیرفعال و  اطلاعاتشان را حذف کرد");

}
 
}
   $text = "تمامی کاربران غیرفعال و اطلاعاتشان را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'activedactived') {
	$sql->where("active", 0)->update('users', array(
		'active' => 1
	));
    
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "تمامی کاربران غیرفعال را فعال کرد");
}
   $text = "تمامی کاربران غیرفعال را فعال کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
 
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'scoreplus') {
	$allowType = array('all');
	foreach ($usertype as $at) {
		$allowType[] = $at['id'];
	}
	$scoreplus = safe::number($_REQUEST['scorepp']);
	$np = $_REQUEST['pOrn'];
	$sType = $_REQUEST['sType'] != 'all' ? safe::number($_REQUEST['sType']) : 'all';
	if ($sType != 'all') {
		foreach ($usertype as $ok) {
			if ($ok['id'] == $sType) {
				$sTitle = $ok['title'];
			}
		}
		$txtp = "به گروه کاربری {$sTitle} {$scoreplus} امتیاز اضافه کرد";
		$txtn = "از گروه کاربری {$sTitle} {$scoreplus} امتیاز کم کرد";
	} else {
		$txtp = "به تمامی کاربران {$scoreplus} امتیاز اضافه کرد";
		$txtn = "از تمامی کاربران {$scoreplus} امتیاز کم کرد";
	}
	if (is_numeric($scoreplus) && in_array($sType, $allowType)) {
		switch ($np) {
			case 'p':
				if ($sType != 'all') {
					$sql->where("type", $sTYpe);
				}
				$sql->update("users", array(
					'score' => $sql->inc($scoreplus)
				));
				if ($sType != 'all') {
					$sql->where("type", $sTYpe);
				}
				$sql->update("onlines", array(
					'score' => $sql->inc($scoreplus)
				));
				chatroom::addlog('9', $txtp);
				echo 'okp';
				break;
			case 'n':
				if ($sType != 'all') {
					$sql->where("type", $sTYpe);
				}
				$sql->update("users", array(
					'score' => $sql->dec($scoreplus)
				));
				if ($sType != 'all') {
					$sql->where("type", $sTYpe);
				}
				$sql->update("onlines", array(
					'score' => $sql->dec($scoreplus)
				));
				chatroom::addlog('9', $txtn);
				echo 'okn';
				break;
		}
	} else {
		echo 'لطفا امتیاز را به درستی وارد نمایید.';
	}
} elseif ($action == 'refreshusers') {
	$sql->where("time", 0, '!=');
	foreach ($sql->get('onlines', null, array('id', 'inputs')) as $row) {
        $inputs = json_decode($row['inputs'], true);
        $inputs['refresh'] = '1';
        Users::Inputs($row['id'], $inputs);
    }

if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
     chatroom::addlog('9', "تمامی کاربران آنلاین را رفرش کرد");
}
   $text = "تمامی کاربران آنلاین را رفرش کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }

    echo('ok');
} elseif ($action == 'refreshadmins') {
	$sql->where("time", 0, '!=');
	$sql->where("admin", 0, '!=');
	foreach ($sql->get('onlines', null, array('id', 'inputs')) as $row) {
        $inputs = json_decode($row['inputs'], true);
        $inputs['refresh'] = '1';
        Users::Inputs($row['id'], $inputs);
    }
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
    chatroom::addlog('9', "تمامی مدیران و ناظرین آنلاین را رفرش کرد");
}
   $text = "تمامی مدیران و ناظرین آنلاین را رفرش کر\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }


    echo('ok');
} elseif ($action == 'delsmilies') {
	foreach ($sql->get('smilies', null, array('id', 'img')) as $row) {
        if (is_file("theme/images/smilies/{$row['img']}")) {
            unlink("theme/images/smilies/{$row['img']}");
        }
		$sql->where("id", $row['id'])->delete('smilies');
    }
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
   chatroom::addlog('9', "تمامی شکلک هارا حذف کرد");
}
   $text = "تمامی شکلک هارا حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'reloadsmilies') {
    chatroom::reloadsmiles();

    
if ($hide['hide'] == '1' and session("admin") == 1) {
} elseif ($hide['hide'] == '0' and session("admin") != 0) {
 chatroom::addlog('9', "شکلک هارا بارگذاری کرد");
 }
   $text = "شکلک هارا بارگذاری کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
   
    echo('ok');
} elseif ($action == 'delbadwords') {
$id = '79154533';
include('inc/badwords.php');
$output = "<?php\n";
foreach ($badwords as $badword) {
    if ($badword['id'] != $id) {
        $word = $badword['word'];
        continue;
    }
    $output .= "\$badwords['{$badword['id']}'] = array('id' => '{$badword['id']}', 'word' => '{$badword['word']}', 'replace' => '{$badword['replace']}', 'general' => '{$badword['general']}', 'private' => '{$badword['private']}', 'profile' => '{$badword['profile']}','silent' => '{$badword['silent']}', 'offlinemsg' => '{$badword['offlinemsg']}', 'tablighat' => '{$badword['tablighat']}');\n";
}
$output .= '?>';
$f = fopen('inc/badwords.php', 'w');
fwrite($f, $output);
fclose($f);

    if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
 chatroom::addlog('9', "تمامی کلمات زشت را حذف کرد");
}
   $text = "تمامی کلمات زشت را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
   
    echo('ok');

} elseif ($action == 'delbadnames') {
$id = '791545335';
include ('inc/badnames.php');
$output = "<?php\n";
foreach ($badnames as $badname) {
    if ($badname['id'] != $id) {
        $word = $badname['word'];
        continue;
    }
    $output .= "\$badnames['{$badname['id']}'] = array('id' => '{$badname['id']}', 'word' => '{$badname['word']}','replace' => '{$badname['replace']}','canlogin' => '{$badname['canlogin']}', 'tablighat' => '{$badname['tablighat']}','autorename'=>'{$badname['autorename']}');\n";
}
$output .= '?>';
$f = fopen('inc/badnames.php', 'w');
fwrite($f, $output);
fclose($f);

    if ($hide['hide'] == '1' and session("admin")==1){
} elseif ($hide['hide'] == '0' and session("admin")!=0){
 chatroom::addlog('9', "تمامی نام های کاربری زشت را حذف کرد");
}
   $text = "تمامی نام های کاربری زشت را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
   
    echo('ok');
} elseif ($action == 'deloldvisit') {
    chatroom::clearVisits();

if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
 chatroom::addlog('9', "ریز آمار های قدیمی را حذف کرد");
 }
   $text = "ریز آمار های قدیمی را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
   
    echo('ok');
} elseif ($action == 'delvisit') {
	$sql->delete('stats');

    if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){

    chatroom::addlog('9', "همه ریز آمار ها را حذف کرد");
   }
   $text = "همه ریز آمار ها را حذف کر\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }

    echo('ok');
} elseif ($action == 'deloldlogs') {
    chatroom::clearLogs();
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
 chatroom::addlog('9', "تراکنشات قدیمی را حذف کرد");

   }
   $text = "تراکنشات قدیمی را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delogs') {
	$sql->delete('logs');


if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تمامی لاگ های کاربران را پاک کرد");
   }
   $text = "تمامی لاگ های کاربران را پاک کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    
    echo('ok');
} elseif ($action == 'deloldletters') {
    $t = time() - 172800;
    $sql->where("time", $t, '<')->delete('letters');

if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "نامه های قدیمی را حذف کرد");
}
   $text = "نامه های قدیمی را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delreadletters') {
	$sql->where("status", 1)->delete('letters');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "نامه های خوانده شده راحذف کرد");
}
   $text = "نامه های خوانده شده راحذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'deletters') {
	$sql->delete('letters', "`status` = '1'");
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "همه نامه ها را حذف کرد");
}
   $text = "همه نامه ها را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'allreadletters') {
	$sql->where("status", 0)->update('letters', array(
		'status' => 1
	));
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "همه نامه های خوانده نشده را به شکل خوانده شده در آورد");
}
   $text = "همه نامه های خوانده نشده را به شکل خوانده شده در آورد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delvisualusers') {
	$sql->where("time", 0)->delete('onlines');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "همه کاربران مجازی را حذف کرد");
}
   $text = "همه کاربران مجازی را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delipbanner') {
	$sql->where("user", null, 'is')->delete('banns');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "همه تحریم های آیپی را آزاد کرد");
}
   $text = "همه تحریم های آیپی را آزاد کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delbanns') {
	$sql->where("user", null, 'is not');
	foreach ($sql->get('banns', null, array('id', 'user')) as $row) {
		$sql->where("id", $row['user'])->update('users', array(
			'active' => 1
		));
		$sql->where("id", $row['user'])->update('profiles', array(
			'active' => 1
		));
		$sql->where("id", $row['id'])->delete('banns');
    }
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "همه اخراجیان را آزاد کرد");
}
   $text = "همه اخراجیان را آزاد کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delsilents') {
	foreach ($sql->get('silents') as $silent) {
		$sql->where("id", $silent['users']);
		$sql->orWhere("ip", $silent['ip']);
		foreach ($sql->get('onlines', null, array('id', 'inputs', 'username')) as $row) {
            $inputs = json_decode($row['inputs'], true);
            $inputs['silent'] = '0';
            $inputs['simg'] = '';
            $inputs['stext'] = '';
            Users::Inputs($row['id'], $inputs);
        }
		$sql->where("id", $silent['id'])->delete('silents');
    }
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "همه ساکت شدگان را آزاد کرد");
}
   $text = "همه ساکت شدگان را آزاد کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delmusices') {
	foreach ($sql->get('player', null, array('id', 'src')) as $row) {
        if (is_file($row['src']))
            unlink($row['src']);
		$sql->where("id", $row['id'])->delete('player');
    }
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "تمامی موزیک ها را حذف کرد");
}
   $text = "تمامی موزیک ها را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
}elseif ($action == 'reloadmusices') {
    chatroom::reloadmusic();
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "موزیک ها را بارگذاری کرد");
}
   $text = "موزیک ها را بارگذاری کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'delinks') {
	$sql->delete('links');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "همه لینک ها را حذف کرد");
}
   $text = "همه لینک ها را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'deldeactivelinks') {
	$sql->where("active", 0)->delete('links');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "لینک های غیرفعال را حذف کرد");
}
   $text = "لینک های غیرفعال را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');

} elseif ($action == 'checkdb') {
	$result = $sql->where("SCHEMA_NAME", db_name)->getOne('`information_schema`.`SCHEMATA`', array('DEFAULT_COLLATION_NAME'));
	if ($result['DEFAULT_COLLATION_NAME'] != 'utf8_persian_ci') {
		$sql->query("ALTER DATABASE DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci");
	}

if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "دیتابیس را مورد بررسی قرار داد");
}
   $text = "دیتابیس را مورد بررسی قرار داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'checktlbs') {
    $enginemysql = array(
        'adminpanel' => 'MyISAM',
        'badwords' => 'MyISAM',
        'banns' => 'MyISAM',
        'filemanager' => 'MyISAM',
        'ipbans' => 'MyISAM',
        'letters' => 'MyISAM',
        'links' => 'MyISAM',
        'logs' => 'MyISAM',
        'message' => 'InnoDB',
        'message_archive' => 'InnoDB',
        'onlines' => 'InnoDB',
        'options' => 'MyISAM',
        'player' => 'MyISAM',
        'profiles' => 'MyISAM',
        'rooms' => 'MyISAM',
        'smilies' => 'MyISAM',
        'stats' => 'MyISAM',
        'stats_num' => 'MyISAM',
        'users' => 'InnoDB',
        'silents' => 'MyISAM'
    );
    $query = db::query("show tables");
    while ($row = mysqli_fetch_array($query)) {
        $query2 = db::query("CHECK TABLE `$row[0]`");
        while ($row2 = mysqli_fetch_array($query2)) {
            if ($row2['Msg_text'] != 'OK') {
                $tables_ok = false;
                $temp = db::query("REPAIR TABLE `$row[0]`");
                $temp = mysqli_fetch_array($temp);
                if ($row2['Msg_text'] != 'OK') {
                    $healthy = false;
                }
                mysqli_free_result($temp);
            } else {
                $query3 = db::query("SELECT * FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA`='" . db_name . "' and `TABLE_NAME` ='$row[0]'");
                $result = mysqli_fetch_array($query3);
                if ($result['TABLE_COLLATION'] != 'utf8_persian_ci') {
                    $tables_ok = false;
                    db::query("ALTER TABLE $row[0] DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci");
                }
                $temp = db_prefix;
                $temp = substr($row[0], strlen($temp));
                if (!isset($enginemysql[$temp]))
                    $enginemysql[$temp] = $options['enginemysql'];
                if (strtolower($result['ENGINE']) != strtolower($enginemysql[$temp])) {
                    $tables_ok = false;
                    db::query("ALTER TABLE `$row[0]` ENGINE = {$enginemysql[$temp]}");
                }
                mysqli_free_result($query3);
            }
        }
        mysqli_free_result($query2);
    }
    mysqli_free_result($query);
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "جداول دیتابیس را مورد بررسی قرار داد");
}
   $text = "جداول دیتابیس را مورد بررسی قرار داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'reloadconfig') {
    chatroom::reloadconfig();
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "فایل تنظیمات را بازنویسی کرد");
}
   $text = "فایل تنظیمات را بازنویسی کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'pays') {
	$sql->delete('pays');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "پرداخت ها را حذف کرد");
}
   $text = "پرداخت ها را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
 
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'failedpays') {
	$sql->where("status", 0)->delete('pays');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "پرداخت ها را حذف کرد");
}
   $text = "پرداخت ها را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'oldpays') {
    $t = time() - 86400;
	$sql->where("date", $t, '<')->delete('pays');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "پرداخت ها را حذف کرد");
}
   $text = "پرداخت ها را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'oldmehman') {
     $t = time() - 259200;
        $sql->where("type", 1);
	$sql->where("lastlogin", $t, '<')->delete('users');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "تمام مهمانان از ابتدا تا سه روز اخیر را حذف کرد");
}
   $text = "تمام مهمانان از ابتدا تا سه روز اخیر را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
}elseif ($action == 'oldozv') {
     $t = time() - 259200;
        $sql->where("type", 2);
	$sql->where("lastlogin", $t, '<')->delete('users');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
  chatroom::addlog('9', "تمام عضو ها از ابتدا تا سه روز اخیر را حذف کرد");
}
   $text = "تمام عضو ها از ابتدا تا سه روز اخیر را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'oldvije') {
     $t = time() - 259200;
        $sql->where("type", 3);
	$sql->where("lastlogin", $t, '<')->delete('users');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
  chatroom::addlog('9', "تمام ویژه ها از ابتدا تا سه روز اخیر را حذف کرد");
}
   $text = "تمام ویژه ها از ابتدا تا سه روز اخیر را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} 
elseif ($action == 'delsendedimages') {
	foreach ($sql->get('sendedimages', null, array('filename')) as $link) {
        @unlink('theme/sendedimages/' . $link['filename']);
    }
	$sql->delete('sendedimages');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "تمامی فایل های ارسال شده در خصوصی را حذف کرد");
}
   $text = "تمامی فایل های ارسال شده در خصوصی را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
}elseif ($action == 'delusersreport') {
	foreach ($sql->get('report_users', null, array('user')) as $row) {
		$sql->where("id", $row['user'])->update('users', array(
			'report' => 0
		));
	}
	$sql->delete('report_users');
if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "تمامی کاربران ریپورت شده را آزاد کرد");
}
   $text = "تمامی کاربران ریپورت شده را آزاد کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
} elseif ($action == 'ld_delete_inprofile') {
	$sql->update('profiles', array(
		'like' => 0,
		'dislike' => 0,
		'likedusers' => '',
		'dislikedusers' => ''
	));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
   chatroom::addlog('9', "تمامی لایک ها و دیسلایک های کاربران در پروفایل را پاک کرد");
}
   $text = "تمامی لایک ها و دیسلایک های کاربران در پروفایل را پاک کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
 
    
    echo('ok');
} elseif ($action == 'reg_guests') {
	$sql->where("type", 1);
	$sql->where("time", 0, '!=');
	foreach ($sql->get('onlines') as $r) {
       $reg_guests_password = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
		$sql->insert("message", array(
			'user' => -1,
			'username' => $systemname,
			'color' => $systemcolor,
			'room' => $r['roomid'],
			'text' => "<text style=direction:rtl;>با سلام . رمز شما <b>" . $reg_guests_password . "</b> می باشد لطفا رمز خود را یادداشت کنید و صفحه خود را <a href=javascript:document.location.reload();><font color=green><b>رفرش</b></font></a> کنید</text>",
			'date' => time(),
			'to' => $r['id'],
			'into' => 'pm',
			'type' => session('admin')
		));
		$sql->where("id", $r['id'])->update('users', array(
			'password' => md5($reg_guests_password),
			'type' => Users::lowestlevelregister()
		));
		$sql->where("id", $r['id'])->update('onlines', array(
			'type' => Users::lowestlevelregister()
		));
}

if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9',"همه ی کاربران  مهمان انلاین را عضو کرد" );
}

   $text = "همه ی کاربران  مهمان انلاین را عضو کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }

    echo('ok');
}elseif ($action == 'reg_guestsAll') {
	$sql->where("type", 1);
	foreach ($sql->get('onlines') as $r) {
       $reg_guests_password = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
		$sql->insert("message", array(
			'user' => -1,
			'username' => $systemname,
			'color' => $systemcolor,
			'room' => $r['roomid'],
			'text' => "<text style=direction:rtl;>با سلام . رمز شما <b>" . $reg_guests_password . "</b> می باشد لطفا رمز خود را یادداشت کنید و صفحه خود را <a href=javascript:document.location.reload();><font color=green><b>رفرش</b></font></a> کنید</text>",
			'date' => time(),
			'to' => $r['id'],
			'into' => 'pm',
			'type' => session('admin')
		));
		$sql->where("id", $r['id'])->update('users', array(
			'password' => md5($reg_guests_password),
			'type' => Users::lowestlevelregister()
		));
		$sql->where("id", $r['id'])->update('onlines', array(
			'type' => Users::lowestlevelregister()
		));
	}

if ($hide['hide'] == '1' and session("admin")==1){   
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9',"همه ی کاربران  مهمان انلاین را عضو کرد" );
}

   $text = "همه ی کاربران  مهمان انلاین را عضو کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }

    echo('ok');
}elseif ($action == 'delroommsg') {
    $where = isset($_REQUEST['where']) ? safe::number($_REQUEST['where']) : '';
    $sql->where('room',$where)->delete('message');
    $sql->where('room',$where)->delete('message_archive');

if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
  chatroom::addlog('9', "پیام اتاق شماره  {$where} را حذف کرد");
}
   $text = "پیام اتاق شماره  $where را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
  
    echo('ok');
}elseif ($action == 'delheader') {
  $header = json_decode($options['thememanager'],true);
    $delheader = isset($_POST['where']) ? safe::string($_POST['where']) : '';
	if($delheader == 'header'){
    unlink($header['chat'][$delheader]['src']);
    $header['chat'][$delheader]['src'] = '';
	}else{
	unlink($header[$delheader]['header']['src']);
    $header[$delheader]['header']['src'] = '';
	}
	$sql->where("name", "thememanager")->update('options', array(
		'value' => json_encode($header, JSON_UNESCAPED_UNICODE)
	));
if ($hide['hide'] == '1' and session("admin")==1){ 
}elseif ($hide['hide'] == '0' and session("admin")!=0){
      chatroom::addlog('9', "فایل مربوط به سربرگ {$delheader} را حذف کرد ");
}
  

    chatroom::reloadconfig();
 $text = "فایل مربوط به سربرگ {$delheader} را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendspecialactionslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo("فایل مربوط به سربرگ {$delheader} را حذف کرد ");
}
?>
