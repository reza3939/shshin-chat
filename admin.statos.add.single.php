<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addstatos');
$msg = "";
$nextid = $sql->where('table_name', db_prefix . 'statos')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
$text = isset($_REQUEST['text']) ? safe::string($_REQUEST['text']) : '';
if ($sql->where('text', $text)->getValue('statos', 'count(*)') > 0) {
echo('repeatname');
return;
}
if (isset($_FILES['filestatos'])) {
    $type = $_FILES['filestatos']['type'];
    if ($type != 'image/png') {
        $msg = 'type';
    } else {
        switch ($type) {
            case('image/png'):$format = 'png';
                break;
        }
        $ext = strtolower(pathinfo($_FILES['filestatos']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, array('png'))) {
            echo('type');
            exit;
        }
        $folder = 'theme/images/status';
        $name = "status_".$nextid . ".$format";
        $filename = "$folder/$name";
        if (@move_uploaded_file($_FILES['filestatos']['tmp_name'], $filename)) {
            $img = file_get_contents($filename);
            if (strpos((string) $img, '<?') !== false) {
                unlink($filename);
                $msg = 'security';
            } else {
                $sql->insert('statos', array(
                    'img' => $name,
                    'text' => $text
                ));
                $msg = 'ok';
            }
        }else {
            $msg = 'noup';
        }
    }
}  else {
    $msg = 'noelemrnr';
}
if (isset($_FILES['filestatoslarg'])) {
    $type = $_FILES['filestatoslarg']['type'];
    if ($type != 'image/png') {
        $msg = 'type';
    } else {
        switch ($type) {
            case('image/png'):$format = 'png';
                break;
        }
        $ext = strtolower(pathinfo($_FILES['filestatoslarg']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, array('png'))) {
            echo('type');
            exit;
        }
        $folder = 'theme/images/status';
        $namel = "status_".$nextid . "_larg". ".$format";
        $filenamel = "$folder/$namel";
        if (@move_uploaded_file($_FILES['filestatoslarg']['tmp_name'], $filenamel)) {
            $imgl = file_get_contents($filenamel);
            if (strpos((string) $imgl, '<?') !== false) {
                unlink($filenamel);
                $msg = 'security';
            } else {
                $msg = 'ok';
            }
        }else {
            $msg = 'noup';
        }
    }
} else {
    $msg = 'noelemrnr';
}
echo("$msg");
?>