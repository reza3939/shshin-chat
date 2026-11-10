<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'filemanager');
if (session('filemanager_password') != $options['filemanager_password'])
    die('password!');

//include('inc/classes/file.php');

$dir = isset($_POST['dir']) ? $_POST['dir'] : '';
if ($dir == '')
    $dir = $options['rootdirmanager'];
$dir = file::checkrootdir(safe::filename($dir));

$files = file::listDirectory($dir, true, false);

$output = array();
$folders = array();
if ($options['rootdirmanager'] != $dir) {
    $dirname = dirname($dir);
    $folders[] = array(
        'filename' => '(back To Parent listDirectory)',
        'size' => file::formatSizeUnits(filesize($dirname)),
        'mime' => file::mime_content_type($dirname),
        'permission' => getchmod($dirname),
        'lastchange' => jdate::start('Y/m/d H:i:s', filectime($dirname)),
        'type' => 'dir',
        'adress' => $dirname
    );
}

$f = array();

foreach ($files as $file) {
    $filetype = filetype($file);
    if ($filetype == 'dir') {
        $folders[] = array(
            'filename' => basename($file),
            'size' => file::formatSizeUnits(filesize($file)),
            'mime' => file::mime_content_type($file),
            'permission' => getchmod($file),
            'lastchange' => jdate::start('Y/m/d H:i:s', filectime($file)),
            'type' => $filetype,
            'adress' => $file
        );
    } else {
        $f[] = array(
            'filename' => basename($file),
            'size' => file::formatSizeUnits(filesize($file)),
            'mime' => file::mime_content_type($file),
            'permission' => getchmod($file),
            'lastchange' => jdate::start('Y/m/d H:i:s', filectime($file)),
            'type' => $filetype,
            'adress' => $file
        );
    }
}
$output = array_merge($folders, $f);
echo json_encode(array('files' => $output, 'thisdir' => $dir), JSON_UNESCAPED_UNICODE);
?>