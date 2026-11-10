<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addsmily');
$msg = "";
if (isset($_FILES['file'])) {
    $type = $_FILES['file']['type'];
    $file = basename($_FILES['file']['name']);
    $ext = substr($file, strrpos($file, '.') + 1);
	$allowedExts = array("jpg", "gif",'jpeg','png');
	if(!in_array($ext, $allowedExts)){
	      exit('type');
	}
            $FORMAT = 'gif';
            $folder = 'theme/images/smilies';
            $namecode = '';
	    $nextid = $sql->where('table_name', db_prefix . 'smilies')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
            $name = "({$options['prefixsmlies']}$nextid".").$FORMAT";
            $filename = "$folder/$name";
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
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
        } elseif ($format == 'zip') {
            $logs = array();
            //include('inc/classes/file.php');
            $folder = 'temp' . rand(1, 5000);
            if (!is_dir($folder))
                mkdir($folder, 0777);
            $unzipfolder = $folder . '/' . rand(0, 1000);
            $filename = $unzipfolder . '.zip';

            if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
                $logs[] = 'uploaded';
                file::unzip($filename, $unzipfolder);
                $logs[] = 'unziped';
                if (is_dir($unzipfolder)) {
                    $files = file::listDirectory($unzipfolder, false, true);
	            $nextid = $sql->where('table_name', db_prefix . 'smilies')->where('table_schema', db_name)->getValue('information_schema.tables', 'AUTO_INCREMENT');
                    $priority = 1;
                    $namecode = '';
                    $logs[] = 'nexedid';
                    foreach ($files as $file) {
                        $infoFile = pathinfo($file);
                        if (isset($infoFile['extension']) and in_array($infoFile['extension'], array('gif', 'jpg', 'png'))) {
                            $img = file_get_contents($file);
                            $logs[] = 'read contents';
                            if (strpos((string) $img, '<?php') !== false && strpos((string) $img, '<script language="php"') !== false || strpos((string) $img, "<script language='php'>") !== false) {
                                unlink($file);
                                $logs[] = 'seacurity';
                            } else {
                                $filenewname = "({$options['prefixsmlies']}{$nextid}).{$infoFile['extension']}";
                                $logs[] = 'newname:' . $filenewname;
                                rename($file, "theme/images/smilies/$filenewname");
                                $logs[] = 'renamed fom :' . $file;
                                chatroom::addSmily($filenewname, "({$options['prefixsmlies']}{$nextid})", $nextid, $namecode, $priority);
                                $nextid++;
                            }
                        }
                    }
                    file::Delete($unzipfolder);
                    $logs[] = 'delete:' . $unzipfolder;
                }
                unlink($filename);
                $logs[] = 'delete:' . $filename;
            }
             file::Delete($unzipfolder);
            $logs[] = 'delete:' . $unzipfolder;

} else {
    $msg = 'noelemrnr';
}
echo("$msg");
?>