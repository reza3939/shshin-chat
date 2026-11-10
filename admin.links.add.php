<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addlinks');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');


$title = isset($_POST['title']) ? safe::string($_POST['title']) : '';
if ($title == '') {
    echo('title');
    return;
}


$url = isset($_POST['url']) ? safe::url($_POST['url']) : '';
if ($url == '') {
    echo('url');
    return;
}


$active = isset($_POST['active']) and safe::string($_POST['active']) == 'true' ? '1' : '0';
$click = '1';

$sql->insert('links', array(
    'title' => $title,
    'url' => $url,
    'active' => $active,
    'click' => $click
));
$tel = json_decode($options['teloptions'], true);
    $text = "لینک :($url)رابا عنوان:($title)اضافه کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendlinkdonilog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>