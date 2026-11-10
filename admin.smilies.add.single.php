<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addsmily');
$msg = "";
if (isset($_FILES['filesmily'])) {
    $type = $_FILES['filesmily']['type'];
    $file = basename($_FILES['filesmily']['name']);
    $ext = substr($file, strrpos($file, '.') + 1);
    $allowedExts = array("jpg", "gif", 'jpeg', 'png');
    if ($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/gif' || !in_array($ext, $allowedExts)) {
        $msg = 'type';
    } else {
        switch ($type) {
            case('image/png'):$format = 'png';
                break;
            case('image/jpeg'):$format = 'jpg';
                break;
            case('image/gif'):$format = 'gif';
                break;
        }
          $format = 'gif';
        $folder = 'theme/images/smilies';



              
        $namecode = isset($_REQUEST['name']) ? safe::string($_REQUEST['name']) : '';
	if ($sql->where('name', $namecode)->getValue('smilies', 'count(*)') > 0) {
            echo('repeatname');
            return;
        }
	$nextid = $sql->where('table_name', db_prefix . 'smilies')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
        $name = "({$options['prefixsmlies']}$nextid" . ").$format";
        $filename = "$folder/$name";
$tel = json_decode($options['teloptions'], true);
  $text = " افزودن شکلک تکی\n";
$text .='نام ویژه: '.$namecode."\n";
$text .= "ادرس شکلک : ".url()."/".$filename."\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendsmilieslog'] == 'Sure'){
             tlg($text,'chat');
                 }
        if (move_uploaded_file($_FILES['filesmily']['tmp_name'], $filename)) {
            $img = file_get_contents($filename);
            if (strpos((string) $img, '<?php') !== false) {
                unlink($filename);
                $msg = 'security';
            } else {

                $priority = isset($_POST['priority']) ? safe::number($_REQUEST['priority']) : 1;
                chatroom::addSmily($name, "({$options['prefixsmlies']}{$nextid})", $nextid, $namecode, $priority);
                $msg = 'ok';
            }
        } else {
            $msg = 'noup';
        }
    }
} else {
    $msg = 'noelemrnr';
}

echo("$msg");
?>