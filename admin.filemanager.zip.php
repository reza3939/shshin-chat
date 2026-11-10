<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'filemanager');
if (session('filemanager_password') != $options['filemanager_password'])
    die('password!');

$files = isset($_POST['files']) ? $_POST['files'] : '';
$files = explode('|', $files);

$name = isset($_POST['name']) ? safe::filename($_POST['name']) : 'temp' . rand(0, 1000);
$dir = isset($_POST['dir']) ? safe::filename($_POST['dir']) : '';
if (substr($dir, strlen($dir) - 1) != '/')
    $dir .= '/';

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

$zip = new ZipArchive();
$res = $zip->open($dir . $name, ZIPARCHIVE::CREATE);
if ($res === TRUE) {
    $filesToCheck = array();


    foreach ($files as $file) {
        $file = file::checkrootdir(safe::filename($file));
        if (is_dir($file)) {
            $filesToCheck = array_merge($filesToCheck, file::listDirectory($file));
        } elseif (is_file($file)) {
            $filesToCheck[] = $file;
        }
    }
    $tempDir = 'temp' . rand(0, 1000) . '/';
    if (is_dir($tempDir))
        mkdir($tempDir);
    foreach ($filesToCheck as $fileToCheck) {
        $dirname = dirname($fileToCheck);
        file::mkdir_r($tempDir . $dirname);
        if (is_file($fileToCheck))
            copy($fileToCheck, $tempDir . $fileToCheck);
    }

    foreach ($filesToCheck as $fileToCheck) {
        if (is_file($fileToCheck)) {
            $mime = file::mime_content_type($fileToCheck);
            if ($mime == 'application/zip' or strpos($mime, 'image') !== false) {
                continue;
            }
            if (basename($fileToCheck) == 'chat.js') {
                unlink($fileToCheck);
                continue;
            }
            $contents = file_get_contents($fileToCheck);
            if (substr_count($contents, '<?') != substr_count($contents, '?>')) {
                continue;
            }
            $array = array();
            $array2 = array();
            check($contents);
            foreach ($array as $key => $c) {
                if ($coId = db::get('filemanager', 'id', "`code`='" . addslashes($c) . "'")) {
                    $array2['(MehrTarh-filemanager' . $coId . ')'] = $c;
                } else {
                    db::insert('filemanager', '`file`, `code`', "'" . $file . "', '" . addslashes($c) . "'");
                    $array2['(MehrTarh-filemanager' . db::$id . ')'] = $c;
                }
            }
            file_put_contents($tempDir . $fileToCheck, str_replace(array_values($array2), array_keys($array2), $contents));
        }
    }
    $filesToAdd = file::listDirectory($tempDir);
    foreach ($filesToAdd as $fileToAdd) {
        if (is_file($fileToAdd)) {
            $zip->addFile($fileToAdd, substr($fileToAdd, strlen($tempDir)));
        }
    }

    if ($zip->close())
        echo('ok');

    file::Delete($tempDir);
}
?>