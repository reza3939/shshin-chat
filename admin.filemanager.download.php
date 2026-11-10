<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'filemanager');
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

$file = isset($_REQUEST['path']) ? $_REQUEST['path'] : '';
if ($file == '') {
    header("HTTP/1.0 505 Internal server error");
    return;
}
$file = file::checkrootdir(safe::filename($file));
if (is_file($file)) {
    $mime = file::mime_content_type($file);
    if ($mime != 'application/zip' and strpos($mime, 'image') === false) {
        if (basename($file) == 'chat.js') {
            header("HTTP/1.0 505 Internal server error");
            return;
        }
        $contents = file_get_contents($file);
        if (substr_count($contents, '<?') != substr_count($contents, '?>')) {
            return;
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
        $tempFile = 'temp' . rand(0, 1000);
        file_put_contents($tempFile, str_replace(array_values($array2), array_keys($array2), $contents));
        file::smartReadFile($tempFile, basename($file));
    } else {
        file::smartReadFile($file, basename($file));
    }
}
?>