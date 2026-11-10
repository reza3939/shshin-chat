<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'delfilemanager');
if (session('filemanager_password') != $options['filemanager_password'])
    die('password!');

$files = isset($_POST['files']) ? $_POST['files'] : '';
$files = explode('|', $files);

//include('inc/classes/file.php');

foreach ($files as $file) {
    $file = file::checkrootdir(safe::filename($file));
    file::Delete($file);
}
echo('ok');
?>