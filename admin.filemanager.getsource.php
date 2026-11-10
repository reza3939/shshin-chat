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

$contents = file_get_contents($file);
if (substr_count($contents, '<?') != substr_count($contents, '?>')) {
    echo('cannot');
    return false;
}
$array = array();
$array2 = array();
check($contents);
foreach ($array as $key => $c) {
    db::insert('filemanager', '`file`, `code`', "'" . $file . "', '" . addslashes($c) . "'");
    $array2['(MehrTarh-filemanager' . db::$id . ')'] = $c;
}
echo(str_replace(array_values($array2), array_keys($array2), $contents));
?>