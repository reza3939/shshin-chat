<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'addavatar');
$msg = "";
if (isset($_FILES['fileavatar'])){
    $type = $_FILES['fileavatar']['type'];
    if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/gif'){
        $msg = 'type';
    }else{
        switch($type){
            case('image/png'):$format = 'png';break;
            case('image/jpeg'):$format = 'jpg';break;
            case('image/gif'):$format = 'gif';break;
        }
        $ext = strtolower(pathinfo($_FILES['fileavatar']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, array ('png', 'jpg','gif') )) {
                echo('type');
                exit;
            }
        $folder = 'theme/images/avatars';
        $namecode = isset($_REQUEST['name']) ? safe::string($_REQUEST['name']) : '';
        if(db::num('avatars', "`name`='$namecode'") > 0){
            echo('repeatname');return;
        }
        $nextid = $sql->where('table_schema', db_name)->where('table_name', db_prefix . 'avatars')->getValue('information_schema.tables', 'AUTO_INCREMENT');
		$rand = rand(100,9999);
        $name = $nextid . ".$format";
        $filename = "$folder/$name";
        if(@move_uploaded_file($_FILES['fileavatar']['tmp_name'], $filename)){
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
}else{
    $msg = 'noelemrnr';
}
echo("$msg");
?>