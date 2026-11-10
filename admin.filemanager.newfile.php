<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'newfilemanager');
if (session('filemanager_password') != $options['filemanager_password'])
    die('password!');

//include('inc/classes/file.php');
$file = isset($_POST['file']) ? safe::filename($_POST['file']) : '';
$dir = isset($_POST['dir']) ? safe::filename($_POST['dir']) : '';
if (substr($dir, strlen($dir) - 1) != '/')
    $dir .= '/';
$filename = file::checkrootdir($dir . $file);
if (is_file($filename)) {
    echo('repeat');
} else {
    file_put_contents($filename, "");
    echo('ok');
}
?>