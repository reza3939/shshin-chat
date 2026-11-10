<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'editlinks');

$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';
$sql->where("id", $id);
if (!$sql->has('links')) {
    echo('id');
    return;
}


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

$active = 0;
if (isset($_POST['active']) and safe::string($_POST['active']) == 'true')
    $active = 1;

$sql->where("id", $id);
$sql->update('links', array(
    'title' => $title,
    'url' => $url,
    'active' => $active
));
$tel = json_decode($options['teloptions'], true);
    $text = "لینک :($url)رابا عنوان:($title)ویرایش کرد کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendlinkdonilog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>