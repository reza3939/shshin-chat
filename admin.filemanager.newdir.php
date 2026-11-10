<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'newdirfilemanager');
if (session('filemanager_password') != $options['filemanager_password'])
    die('password!');

include_once('inc/classes/file.php');
$name = isset($_POST['name']) ? safe::filename($_POST['name']) : '';
$dir = isset($_POST['dir']) ? safe::filename($_POST['dir']) : '';
if (substr($dir, strlen($dir) - 1) != '/')
    $dir .= '/';
if (is_dir(file::checkrootdir($dir . $name))) {
    echo('repeat');
} else {
    mkdir(file::checkrootdir($dir . $name));
    echo('ok');
}
?>