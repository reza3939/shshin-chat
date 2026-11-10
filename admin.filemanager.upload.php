<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'newfilemanager');

if (session('filemanager_password') != $options['filemanager_password'])
    die('password!');

//include('inc/classes/file.php');

function checkCode($contents, $preg) {
    foreach ($preg as $preg_pattern) {
        if (preg_match($preg_pattern, $contents)) {
            return true;
        }
    }
    return false;
}

$error = "";
if (isset($_FILES['file_filemanager'])) {
    $dir = isset($_POST['dir']) ? safe::filename($_POST['dir']) : '';
    if ($dir == '') {
        $dir = $options['rootdirmanager'];
    }
    $ext = strtolower(file::get_ext($_FILES['file_filemanager']['name']));
    if (empty($ext)) {
        $ext = strtolower(pathinfo($_FILES['file_filemanager']['name'], PATHINFO_EXTENSION));
    }
    $typefile = $_FILES['file_filemanager']['type'];
    $ext = '';
    if (in_array($typefile, array('image/png', 'image/jpeg', 'image/gif', 'audio/mpeg'))) {
        switch ($typefile) {
            case 'image/png':$ext = 'png';
                break;
            case 'image/jpeg':$ext = 'jpg';
                break;
            case 'image/gif':$ext = 'gif';
                break;
            case 'image/mpeg':$ext = 'mp3';
                break;
        }
    }
    $filename = "$dir/{$_FILES['file_filemanager']['name']}";
    if ($ext != '') {
        $file_name = str_replace(".{$ext}", '', basename($_FILES['file_filemanager']['name']));
        $filename = "$dir/{$file_name}.{$ext}";
    }
    $filename = file::checkrootdir($filename);
    if (move_uploaded_file($_FILES['file_filemanager']['tmp_name'], $filename)) {
        $preg = array(
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+php>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=\s+php>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=php>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=php>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+php\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=\s+php\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=php\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=php\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+"php">/',
            '/<[A-Za-z]+\s+[A-Za-z]+=\s+"php">/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+="php">/',
            '/<[A-Za-z]+\s+[A-Za-z]+="php">/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+"php"\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=\s+"php"\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+="php"\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+="php"\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+\'php\'>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=\s+\'php\'>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=\'php\'>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=\'php\'>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=\s+\'php\'\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=\s+\'php\'\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+\s+=\'php\'\s+>/',
            '/<[A-Za-z]+\s+[A-Za-z]+=\'php\'\s+>/',
            '/<\?.*\s*.*([pP][hH][pP])?.*(\?>)?/',
            '/<\?.*\s*.*([pP][hH][pP])?.*(\?>)?/m',
            '/<\?.*\s*.*([pP][hH][pP])?.*(\?>)?/i',
            '/<\?[php]+/i',
            '/<\?/i',
            '/\?>/i'
        );
        $text = strtolower(file_get_contents($filename));
        ;
        if ($ext == '') {
            $countPHP = 0;
            preg_match_all('/<script[^>]+>/i', $text, $textTags);
            for ($i = 0; $i < count($textTags[0]); $i++) {
                preg_match('/language="([^"]+)/i', $textTags[0][$i], $prop);
                preg_match("/language='([^']+)/i", $textTags[0][$i], $propa);
                if ((is_array($prop) && $prop[1] == 'php') || (is_array($propa) && $propa[1] == 'php')) {
                    $countPHP++;
                }
            }
            $text = (string) $text;
            if (strpos($text, '<?php') !== false) {
                unlink($filename);
                echo('security');
                return;
            } else if (strpos($text, '<?=') !== false) {
                unlink($filename);
                echo('security');
                return;
            } else if (strpos($text, '<?') !== false) {
                unlink($filename);
                echo('security');
                return;
            } else if ($countPHP != 0) {
                unlink($filename);
                echo('security');
                return;
            } else if (strpos($text, '<script language="php">') !== false) {
                unlink($filename);
                echo('security');
                return;
            } else if (strpos($text, "<script language='php'>") !== false) {
                unlink($filename);
                echo('security');
                return;
            } else if (checkCode($text, $preg)) {
                unlink($filename);
                echo('security');
                return;
            } else {
                $mime = strtolower(file::mime_content_type($filename));
                if (strpos($mime, 'text') !== false) {
                    if (strpos((string) $text, '<?') !== false || strpos($mime, 'application') !== false) {
                        unlink($filename);
                        echo('security');
                        return;
                    }
                }
                echo('ok');
                return;
            }
        } else {
            if (strpos($text, '<?php') !== false) {
                unlink($filename);
                echo('security');
                return;
            } else {
                $mime = strtolower(file::mime_content_type($filename));
                if (strpos($mime, 'text') !== false || strpos($mime, 'application') !== false) {
                    if (strpos($text, '<?') !== false) {
                        unlink($filename);
                        echo('security');
                        return;
                    }
                }
                echo('ok');
                return;
            }
        }
    } else {
        $error = 'noup';
    }
} else {
    $error = 'noelemrnr';
}
echo"{\n\terror: '$error'\n}";
?>