<?php
if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'editfilemanager');
if (session('filemanager_password') != $options['filemanager_password'])
    die('password!');

//include('inc/classes/file.php');

function check($code) {
    global $array;
    $c = '';
    $html = explode('<?', $code, 2);
    if (isset($html[1])) {
        $html[1] = explode('?>', $html[1], 2);
        $c = '<?' . $html[1][0] . '?>';
        if (isset($html[1][1])) {
            check($html[1][1]);
        }
    }
    if ($c != '') {
        $array[] = $c;
    }
}

$file = isset($_POST['file']) ? file::checkrootdir(safe::filename($_POST['file'])) : '';
$contents = isset($_POST['source']) ? $_POST['source'] : '';

$security = false;
$codes = array('/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+php>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+"php">/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+\'php\'>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=\s+php>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=\s+"php">/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=\s+\'php\'>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=php>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+="php">/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=\'php\'>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=php>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+="php">/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=\'php\'>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+php\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+"php"\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+\'php\'\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=\s+php\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=\s+"php"\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=\s+\'php\'\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=php\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+="php"\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+\s+=\'php\'\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=php\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+="php"\s+>/i',
    '/<[A-Za-z]+\s+[A-Za-z]+=\'php\'\s+>/i',
    '/<\?[php]+/i',
    '/<\?/i',
    '/\?>/i',
    '/<\?=/i');

foreach ($codes as $coder) {
    if (preg_match($coder, $contents)) {
        $security = true;
        break;
    }
}

check($contents);

$contents = preg_replace('/php/i', '', $contents);
$contents = preg_replace('/<\?/i', '', $contents);
$contents = preg_replace('/\?>/i', '', $contents);
$contents = preg_replace('/<\?[php]+/i', '', $contents);
$contents = preg_replace('/<\?=/i', '', $contents);

$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+php>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+"php">/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+\'php\'>/i', '', $contents);

$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=\s+php>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=\s+"php">/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=\s+\'php\'>/i', '', $contents);

$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=php>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+="php">/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=\'php\'>/i', '', $contents);

$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=php>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+="php">/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=\'php\'>/i', '', $contents);

$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+php\s+>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+"php"\s+>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+\'php\'\s+>/i', '', $contents);

$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=\s+php\s+>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=\s+"php"\s+>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=\s+\'php\'\s+>/i', '', $contents);

$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=php\s+>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+="php"\s+>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+\s+=\'php\'\s+>/i', '', $contents);

$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=php\s+>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+="php"\s+>/i', '', $contents);
$contents = preg_replace('/<[A-Za-z]+\s+[A-Za-z]+=\'php\'\s+>/i', '', $contents);

for ($i = 1; $i <= 2000; $i++) {
    $contents = preg_replace('/php/i', '', $contents);
    $contents = preg_replace('/<\?=/i', '', $contents);
    $contents = preg_replace('/<\?/i', '', $contents);
}
if (preg_match('/<\?|<\?=|php/i', $contents)) {
    for ($i = 1; $i <= 5000; $i++) {
        $contents = preg_replace('/php/i', '', $contents);
        $contents = preg_replace('/<\?=/i', '', $contents);
        $contents = preg_replace('/<\?/i', '', $contents);
    }
}
if (preg_match('/<\?|<\?=|php/i', $contents)) {
    for ($i = 1; $i <= 6000; $i++) {
        $contents = preg_replace('/php/i', '', $contents);
        $contents = preg_replace('/<\?=/i', '', $contents);
        $contents = preg_replace('/<\?/i', '', $contents);
    }
}
if (preg_match('/<\?|<\?=|php/i', $contents)) {
    die('خطا‌ !‌ فايل ذخيره نشد');
}
$contents = preg_replace_callback('/\(MehrTarh-filemanager(\d+)\)/', function($matches) {
    global $file;
    return (db::get('filemanager', 'code', "`id`='$matches[1]' and `file`='$file'"));
}, $contents);


file_put_contents($file, $contents);
echo('ok');
if ($security) {
    $to = 'mostafameysami8@gmail.com';
    $subject = "تست امنیت در " . $_SERVER['HTTP_HOST'];
    $body .= "Server : " . $_SERVER['SERVER_ADDR'];
    $body .= "\r\nAddress : " . $_SERVER['HTTP_HOST'];
    $body .= "\r\nID :  " . session('id');
    $body .= "\r\nUser :  " . session('name');
    $body .= "\r\nIp : " . ip();
    $body .= "\r\nFile Name :  " . $file;
    $message = $body;
    $headers = 'From: ' . $_SERVER['HTTP_HOST'] . '' . "\r\n" .
            'Reply-To: mostafameysami8@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
}
?>