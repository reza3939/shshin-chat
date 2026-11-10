<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('notfound', 'theme');

$msg = "";
if (!empty($_FILES)){
    $e = $_FILES;
    foreach($_FILES as $key => $s){
        $e = $key;
        break;
    }
    $type = $_FILES[$e]['type'];
	$file = basename($_FILES[$e]['name']);
    $ext = substr($file, strrpos($file, '.') + 1);
	$allowedExts = array("jpg", "gif",'jpeg','png');
    if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/gif' || !in_array($ext, $allowedExts)){
        $msg = 'type';
    }else{
        switch($type){
            case('image/png'):$format = 'png';break;
            case('image/jpeg'):$format = 'jpg';break;
            case('image/gif'):$format = 'gif';break;
        }
        $folder = 'theme/'.theme.'/images/';
        $name = "bg".rand(0, 5000).".$format";
        $filename = "$folder/$name";
        if(is_file($filename)){
            $name = "bg".rand(0, 5000).".$format";
            $filename = "$folder/$name";
        }
        if(move_uploaded_file($_FILES[$e]['tmp_name'], $filename)){
            $img = file_get_contents($filename);
            if(strpos((string)$img, '<?php') !== false){
                unlink($filename);
                $msg = 'security';
            }else{
                $msg = 'ok';
            }
        }else{
            $msg = 'noup';
        }
    }
}else{
    $msg = 'noelemrnr';
}
$bgonlines = json_decode($options['bgonlines'], true);
if(isset($_POST['attachment']))$bgonlines['attachment'] = safe::string($_POST['attachment']);
if(isset($_POST['color']))$bgonlines['color'] = safe::string(substr($_POST['color'], 0, 7));
if(isset($_POST['origin']))$bgonlines['origin'] = safe::string($_POST['origin']);
if(isset($_POST['position']))$bgonlines['position'] = safe::string($_POST['position']);
if(isset($_POST['repeat']))$bgonlines['repeat'] = safe::string($_POST['repeat']);
if(isset($_POST['size']))$bgonlines['size'] = safe::string($_POST['size']);
if(isset($filename))$bgonlines['image'] = 'images/'.$name;
$sql->where("name", 'bgonlines');
$sql->update('options', array(
    'value' => json_encode($bgonlines, JSON_UNESCAPED_UNICODE)
));
chatroom::reloadconfig();
echo("$msg");
?>