<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'addavatar');
$msg = "";
if (isset($_FILES['file'])){
    $type = $_FILES['file']['type'];
	$file = basename($_FILES['file']['name']);
    $ext = substr($file, strrpos($file, '.') + 1);
	$allowedExts = array("jpg", "gif",'jpeg','png', 'zip');
    if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/gif' && $type != 'application/zip' || !in_array($ext, $allowedExts)){
        $msg = 'type';
    }else{
        switch($type){
            case('image/png'):$format = 'png';break;
            case('image/jpeg'):$format = 'jpg';break;
            case('image/gif'):$format = 'gif';break;
            case('application/zip'):$format = 'zip';break;
        }
        if($format == 'png' or $format == 'jpg' or $format == 'gif'){
            $folder = 'theme/images/avatars';
            $namecode = '';
            $nextid = $sql->where('table_schema', db_name)->where('table_name', db_prefix . 'avatars')->getValue('information_schema.tables', 'AUTO_INCREMENT');
		    $rand = rand(100,9999);
            $name = $nextid . ".$format";
            $filename = "$folder/$name";
            if(move_uploaded_file($_FILES['file']['tmp_name'], $filename)){
                $img = file_get_contents($filename);
                if(strpos((string)$img, '<?php') !== false){
                    unlink($filename);
                    $msg = 'security';
                }else{
                       
                $sql->insert('avatars', array(
                   	 'image' => $name,
                  	 'name' => $name
                 ));
			
			if($options['thumbavatar'] == 'true'){
                $sizes = explode('*', $options['thumbavatarSize']);
                $newfilename = "$sizes[0]-$sizes[1]/".$name;
                if(is_file("$folder/$newfilename"))unlink("$folder/$newfilename");
                if(is_file("$folder/$lastavatar"))unlink("$folder/$lastavatar");
                $image = new ImageResizer();
                $image->load($filename);
                $image->resize($sizes[0], $sizes[1]);
                $image->save("$folder/$newfilename");
            }
                $msg = 'ok';
            }
        }else{
            $msg = 'noup';
        }
      }
	}
}else{
    $msg = 'noelemrnr';
}
echo("$msg");
?>