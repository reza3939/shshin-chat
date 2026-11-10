<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addbadnames');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}

include ('inc/badnames.php');
$error = false;
foreach ($badnames as $badname) {
    if ($badname['word']){ 
	     $error = true;
		 break;
	}
}
if ($error) {
    echo ("no");
    return;
}

$ids = str_shuffle(rand(1,9999));
$file = file_get_contents('inc/badnames.php');
$f = fopen('inc/badnames.php', 'w');
$output  = "<?php\n";
$output .= str_replace(array('<?php','?>',"\n"),"",$file);
$output .= "
\$badnames['6786'] = array('id' => '6786', 'word' => 'چت','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['8757'] = array('id' => '8757', 'word' => 'روم','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['4842'] = array('id' => '4842', 'word' => 'chat','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['1513'] = array('id' => '1513', 'word' => 'room','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['7559'] = array('id' => '7559', 'word' => 'gap','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2591'] = array('id' => '2591', 'word' => 'www','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['7846'] = array('id' => '7846', 'word' => 'com','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6064'] = array('id' => '6064', 'word' => 'ir','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2780'] = array('id' => '2780', 'word' => 'net','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5892'] = array('id' => '5892', 'word' => 'tk','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9530'] = array('id' => '9530', 'word' => 'ml','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2294'] = array('id' => '2294', 'word' => 'cf','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['0500'] = array('id' => '0500', 'word' => 'kir','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['8498'] = array('id' => '8498', 'word' => 'کیر','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['3450'] = array('id' => '3450', 'word' => 'کون','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['3626'] = array('id' => '3626', 'word' => 'koon','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['3767'] = array('id' => '3767', 'word' => 'kos','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['0814'] = array('id' => '0814', 'word' => 'کوس','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['4276'] = array('id' => '4276', 'word' => 'کس','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6539'] = array('id' => '6539', 'word' => 'کص','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6292'] = array('id' => '6292', 'word' => 'کث','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9791'] = array('id' => '9791', 'word' => 'جنده','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['7896'] = array('id' => '7896', 'word' => 'گایید','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['8605'] = array('id' => '8605', 'word' => 'گاید','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['0524'] = array('id' => '0524', 'word' => 'gayid','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['7519'] = array('id' => '7519', 'word' => 'gaeid','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2149'] = array('id' => '2149', 'word' => 'gaid','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9913'] = array('id' => '9913', 'word' => 'gayd','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6385'] = array('id' => '6385', 'word' => 'مادرتو','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6581'] = array('id' => '6581', 'word' => 'خواهرتو','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5383'] = array('id' => '5383', 'word' => 'خوارتو','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['46'] = array('id' => '46', 'word' => 'ساک','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['1607'] = array('id' => '1607', 'word' => 'شارژ','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2771'] = array('id' => '2771', 'word' => 'مادر جنده','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2000'] = array('id' => '2000', 'word' => 'خواهر جنده','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['910'] = array('id' => '910', 'word' => 'خوار جنده','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['131'] = array('id' => '131', 'word' => 'گی','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5186'] = array('id' => '5186', 'word' => 'برده','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['3019'] = array('id' => '3019', 'word' => 'کلفت','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['8482'] = array('id' => '8482', 'word' => 'سانت','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5694'] = array('id' => '5694', 'word' => 'barde','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['3389'] = array('id' => '3389', 'word' => 'koloft','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6672'] = array('id' => '6672', 'word' => 'sant','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6773'] = array('id' => '6773', 'word' => 'gay','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6087'] = array('id' => '6087', 'word' => 'les','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5461'] = array('id' => '5461', 'word' => 'lez','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5039'] = array('id' => '5039', 'word' => 'لز','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6165'] = array('id' => '6165', 'word' => 'قحبه','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['4328'] = array('id' => '4328', 'word' => 'ghahbe','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9768'] = array('id' => '9768', 'word' => '901','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6347'] = array('id' => '6347', 'word' => '902','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5809'] = array('id' => '5809', 'word' => '903','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6083'] = array('id' => '6083', 'word' => '904','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['3841'] = array('id' => '3841', 'word' => '905','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['1773'] = array('id' => '1773', 'word' => '906','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['4886'] = array('id' => '4886', 'word' => '907','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['988'] = array('id' => '988', 'word' => '908','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['4162'] = array('id' => '4162', 'word' => '910','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['457'] = array('id' => '457', 'word' => '911','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5301'] = array('id' => '5301', 'word' => '912','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6264'] = array('id' => '6264', 'word' => '913','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6252'] = array('id' => '6252', 'word' => '914','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9667'] = array('id' => '9667', 'word' => '915','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9413'] = array('id' => '9413', 'word' => '916','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['3895'] = array('id' => '3895', 'word' => '917','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9857'] = array('id' => '9857', 'word' => '918','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['152'] = array('id' => '152', 'word' => '919','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2871'] = array('id' => '2871', 'word' => '920','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6924'] = array('id' => '6924', 'word' => '921','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2919'] = array('id' => '2919', 'word' => '922','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['0761'] = array('id' => '0761', 'word' => '923','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6396'] = array('id' => '6396', 'word' => '924','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['998'] = array('id' => '998', 'word' => '925','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9686'] = array('id' => '9686', 'word' => '926','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['8471'] = array('id' => '8471', 'word' => '927','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['0465'] = array('id' => '0465', 'word' => '930','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9373'] = array('id' => '9373', 'word' => '931','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['0225'] = array('id' => '0225', 'word' => '932','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['2992'] = array('id' => '2992', 'word' => '933','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['284'] = array('id' => '284', 'word' => '934','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['4297'] = array('id' => '4297', 'word' => '935','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['5076'] = array('id' => '5076', 'word' => '936','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9379'] = array('id' => '9379', 'word' => '937','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['0267'] = array('id' => '0267', 'word' => '938','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['988'] = array('id' => '988', 'word' => '939','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['119'] = array('id' => '119', 'word' => '940','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['6453'] = array('id' => '6453', 'word' => '941','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['4566'] = array('id' => '4566', 'word' => '942','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['8891'] = array('id' => '8891', 'word' => '943','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['9765'] = array('id' => '9765', 'word' => 'jend','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['3787'] = array('id' => '3787', 'word' => 'madareto','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['1622'] = array('id' => '1622', 'word' => 'sex','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\$badnames['7022'] = array('id' => '7022', 'word' => 'سکس','replace' => '****', 'canlogin' => '1', 'tablighat' => '1','autorename'=>'1');
\n";

$output .= '?>';
fwrite($f, $output);
fclose($f);

echo('ok');
?>