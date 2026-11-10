<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addbadwords');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}
include ('inc/badwords.php');

$error = false;
foreach ($badwords as $badword) {
    if ($badword['word']){ 
	     $error = true;
		 break;
	}
}
if ($error) {
    echo ("no");
    return;
}

$ids = str_shuffle(rand(1,99999));
$file = file_get_contents('inc/badwords.php');
$f = fopen('inc/badwords.php', 'w');

$output  = "<?php\n";
$output .= str_replace(array('<?php','?>',"\n"),"",$file);
$output .= "
\$badwords['05776'] = array('id' => '05776', 'word' => 'چت', 'replace' => '*****', 'general' => '1', 'private' => '1', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['7913'] = array('id' => '7913', 'word' => 'روم', 'replace' => '*****', 'general' => '1', 'private' => '1', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['52254'] = array('id' => '52254', 'word' => 'chat', 'replace' => '*****', 'general' => '1', 'private' => '1', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['52853'] = array('id' => '52853', 'word' => 'room', 'replace' => '*****', 'general' => '1', 'private' => '1', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['34596'] = array('id' => '34596', 'word' => 'gap', 'replace' => '*****', 'general' => '1', 'private' => '1', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['40303'] = array('id' => '40303', 'word' => 'www', 'replace' => '****', 'general' => '1', 'private' => '1', 'profile' => '0','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['51046'] = array('id' => '51046', 'word' => 'com', 'replace' => '****', 'general' => '1', 'private' => '1', 'profile' => '0','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['94902'] = array('id' => '94902', 'word' => 'ir', 'replace' => '****', 'general' => '1', 'private' => '1', 'profile' => '0','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['34408'] = array('id' => '34408', 'word' => 'net', 'replace' => '****', 'general' => '1', 'private' => '1', 'profile' => '0','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['57832'] = array('id' => '57832', 'word' => 'tk', 'replace' => '****', 'general' => '1', 'private' => '1', 'profile' => '0','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['67837'] = array('id' => '67837', 'word' => 'ml', 'replace' => '****', 'general' => '1', 'private' => '1', 'profile' => '0','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['8452'] = array('id' => '8452', 'word' => 'cf', 'replace' => '****', 'general' => '1', 'private' => '1', 'profile' => '0','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '1');
\$badwords['312204'] = array('id' => '31204', 'word' => 'کیر', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['31204'] = array('id' => '31204', 'word' => 'kir', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['878'] = array('id' => '878', 'word' => 'کون', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['8758'] = array('id' => '878', 'word' => 'koon', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['975341'] = array('id' => '97531', 'word' => 'کث', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['97531'] = array('id' => '97531', 'word' => 'کوس', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['975311'] = array('id' => '97531', 'word' => 'kos', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['58040'] = array('id' => '5800', 'word' => 'جنده', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['5800'] = array('id' => '5800', 'word' => 'jend', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['71646'] = array('id' => '71646', 'word' => 'گاید', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['715646'] = array('id' => '71646', 'word' => 'gai', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['716746'] = array('id' => '71646', 'word' => 'gaid', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['716496'] = array('id' => '71646', 'word' => 'gayi', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['716436'] = array('id' => '71646', 'word' => 'gaei', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['74827'] = array('id' => '74827', 'word' => 'کص', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['365141'] = array('id' => '36511', 'word' => 'مادرتو', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['36511'] = array('id' => '36511', 'word' => 'madaret', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['176969'] = array('id' => '17699', 'word' => 'خواهرتو', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['17699'] = array('id' => '17699', 'word' => 'khahareto', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['8509'] = array('id' => '8509', 'word' => 'خوارتو', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['52665'] = array('id' => '52665', 'word' => 'خواهر جنده', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['65386'] = array('id' => '65386', 'word' => 'خوار جنده', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['14980'] = array('id' => '14980', 'word' => 'مادر جنده', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['38197'] = array('id' => '38197', 'word' => 'کسکش', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['23052'] = array('id' => '23052', 'word' => 'کصکش', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['69959'] = array('id' => '69959', 'word' => 'کوص', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['43406'] = array('id' => '43406', 'word' => 'قحبه', 'replace' => '****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['67000'] = array('id' => '67000', 'word' => 'سکس', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['17753'] = array('id' => '17753', 'word' => 'sex', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['30838'] = array('id' => '30838', 'word' => 'گی', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['82463'] = array('id' => '82463', 'word' => 'gay', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['53798'] = array('id' => '53798', 'word' => 'les', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['37268'] = array('id' => '37268', 'word' => 'لز', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '1','silent' => '1', 'offlinemsg' => '1', 'tablighat' => '0');
\$badwords['76790'] = array('id' => '76790', 'word' => '901', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['27585'] = array('id' => '27585', 'word' => '902', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['06637'] = array('id' => '06637', 'word' => '903', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['72247'] = array('id' => '72247', 'word' => '910', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['09144'] = array('id' => '09144', 'word' => '911', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['26856'] = array('id' => '26856', 'word' => '912', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['73501'] = array('id' => '73501', 'word' => '913', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['05739'] = array('id' => '05739', 'word' => '914', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['16472'] = array('id' => '16472', 'word' => '915', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['52088'] = array('id' => '52088', 'word' => '916', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['61169'] = array('id' => '61169', 'word' => '917', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['13468'] = array('id' => '13468', 'word' => '918', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['51064'] = array('id' => '51064', 'word' => '919', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['75179'] = array('id' => '75179', 'word' => '920', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['71849'] = array('id' => '71849', 'word' => '921', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['80551'] = array('id' => '80551', 'word' => '922', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['43321'] = array('id' => '43321', 'word' => '923', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['68014'] = array('id' => '68014', 'word' => '924', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['64547'] = array('id' => '64547', 'word' => '925', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['57583'] = array('id' => '57583', 'word' => '926', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['61399'] = array('id' => '61399', 'word' => '930', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['76953'] = array('id' => '76953', 'word' => '931', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['59656'] = array('id' => '59656', 'word' => '932', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['24370'] = array('id' => '24370', 'word' => '933', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['31981'] = array('id' => '31981', 'word' => '934', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['72990'] = array('id' => '72990', 'word' => '935', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['45653'] = array('id' => '45653', 'word' => '936', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['38693'] = array('id' => '38693', 'word' => '937', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['58394'] = array('id' => '58394', 'word' => '938', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['13436'] = array('id' => '13436', 'word' => '939', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['64816'] = array('id' => '64816', 'word' => '940', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['85616'] = array('id' => '85616', 'word' => '941', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\$badwords['41051'] = array('id' => '41051', 'word' => '942', 'replace' => '*****', 'general' => '1', 'private' => '0', 'profile' => '0','silent' => '1', 'offlinemsg' => '0', 'tablighat' => '0');
\n";
$output .= '?>';
fwrite($f, $output);
fclose($f);

echo('ok');
?>