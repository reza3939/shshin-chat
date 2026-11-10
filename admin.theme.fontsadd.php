<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addfonts');
$nextid = $sql->where('table_name', db_prefix . 'chatfonts')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
$namefont = isset($_REQUEST['namefont']) ? safe::string($_REQUEST['namefont']) : '';
if ($sql->where('name', $namefont)->getValue('chatfonts', 'count(*)') > 0) {
    echo('repeatname');
    return;
}
if ($namefont == ''){
	echo('نام فونت را انتخاب نمایید .');
	return;
}

$msg = '';
/* ------------------eot-------------------- */
if (isset($_FILES['filefontseot'])) {
    $eot = $_FILES['filefontseot']['name'];
    $a = explode('.', $eot);
    if (strtolower($a[1]) != 'eot') {
        $msg = 'File is not a .eot';
    }
    $folder = 'theme/chatfont';
    $name = $nextid . ".eot";
    $filename = "$folder/$name";
    if (@move_uploaded_file($_FILES['filefontseot']['tmp_name'], $filename)) {
        $img = file_get_contents($filename);
        if (strpos((string) $img, '<?p') !== false) {
            unlink($filename);
            $msg = 'security';
        }
    } else {
        $msg = 'noup';
    }
} else {
    $msg = 'noelemrnr';
}

/* ------------------woff-------------------- */


if (isset($_FILES['filefontswoff'])) {
    $woff = $_FILES['filefontswoff']['name'];
    $a = explode('.', $woff);
    if (strtolower($a[1]) != 'woff') {
        $msg = 'File is not a .woff';
    }
    $folder = 'theme/chatfont';
    $name = $nextid . ".woff";
    $filename = "$folder/$name";
    if (@move_uploaded_file($_FILES['filefontswoff']['tmp_name'], $filename)) {
        $img = file_get_contents($filename);
        if (strpos((string) $img, '<?p') !== false) {
            unlink($filename);
            $msg = 'security';
        }
    } else {
        $msg = 'noup';
    }
} else {
    $msg = 'noelemrnr';
}

/* ------------------ttf-------------------- */
if (isset($_FILES['filefontsttf'])) {
    $ttf = $_FILES['filefontsttf']['name'];
    $a = explode('.', $ttf);
    if (strtolower($a[1]) != 'ttf') {
        $msg = 'File is not a .ttf';
    }
    $folder = 'theme/chatfont';
    $name = $nextid . ".ttf";
    $filename = "$folder/$name";
    if (@move_uploaded_file($_FILES['filefontsttf']['tmp_name'], $filename)) {
        $img = file_get_contents($filename);
        if (strpos((string) $img, '<?p') !== false) {
            unlink($filename);
            $msg = 'security';
        }
    } else {
        $msg = 'noup';
    }
} else {
    $msg = 'noelemrnr';
}
if ($msg == '') {
$sql->insert("chatfonts", array(
    'name' => $namefont
));
    echo('ok');
} else {
    echo($msg);
}
?>