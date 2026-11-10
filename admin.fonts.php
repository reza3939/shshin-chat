<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('notfound', 'theme');
$action = isset($_POST['action']) ? safe::string($_POST['action']) : die('action?');
if($action == 'add'){
	$msg = "Error!";
	if (isset($_FILES['filefont'])){
		$fname = isset($_POST['fontname']) ? safe::string($_POST['fontname']) : die('fname?');
		if($fname == ''){
			echo('نام فونت را وارد کنید‌!');
			exit;
		}
		$type = $_FILES['filefont']['type'];
		$file = basename($_FILES['filefont']['name']);
		$ext = substr($file, strrpos($file, '.') + 1);
		$allowedExts = array('woff', 'eot', 'ttf');
		if(!in_array($ext, $allowedExts)){
			$msg = "فرمت فایل غیرمجاز است!\nفرمت های مجاز: woff - eot - ttf";
		}else{
			$folder = 'theme/fonts/';
			if(!is_dir($folder))mkdir($folder);
			$rand = rand(9999,9999999);
			$uname = md5(time() . session('id') . $rand).".".$ext;
			$filename = "$folder/".$uname;
			if(move_uploaded_file($_FILES['filefont']['tmp_name'], $filename)){
					$sql->where("name", 'fonts');
					$get = $sql->getValue('options', 'value');
					$new = json_decode($get, true);
					$new[] = array('name' => $fname, 'cName' => 'TarhPardaz'.$rand, 'src' => $uname, 'format' => $ext);
					$json = json_encode($new, JSON_UNESCAPED_UNICODE);
					$sql->where("name", 'fonts');
					$sql->update('options', array(
						'value' => $json
					));
					chatroom::reloadconfig();
					$msg = 'ok';
			}else{
				$msg = 'noup';
			}
		}
	}else{
		$msg = 'noelemrnr';
	}
	echo("$msg");
}elseif($action == 'delete'){
	$name = isset($_POST['name']) ? safe::string($_POST['name']) : '';
	$cname = isset($_POST['cname']) ? safe::string($_POST['cname']) : '';
	$src = isset($_POST['src']) ? safe::string($_POST['src']) : '';
	
	$fonts = json_decode($options['fonts'], true);
	for($i = 0; $i<count((array) $fonts); $i++){
		if($fonts[$i]['name'] == $name && $fonts[$i]['cName'] == $cname && $fonts[$i]['src'] == $src){
			if(is_file('theme/fonts/'.safe::filename($fonts[$i]['src'])))unlink('theme/fonts/'.$fonts[$i]['src']);
			unset($fonts[$i]);
		} 
	}

	$mfonts = json_decode($options['TarhPardaz_fonts'], true);
	for($i = 0; $i<count((array) $mfonts); $i++){
		if($mfonts[$i]['name'] == $name && $mfonts[$i]['cName'] == $cname && $mfonts[$i]['src'] == $src){
			unset($mfonts[$i]);
		} 
	}
	
	$json = array_values((array) $fonts);
	$json = json_encode($json, JSON_UNESCAPED_UNICODE);
	$sql->where("name", 'fonts');
	$sql->update('options', array(
		'value' => $json
	));
	
	$json = array_values((array) $mfonts);
	$json = json_encode($json, JSON_UNESCAPED_UNICODE);
	$sql->where("name", 'TarhPardaz_fonts');
	$sql->update('options', array(
		'value' => $json
	));
	chatroom::reloadconfig();
	echo("ok");
}elseif($action == 'update'){
	$array = isset($_POST['data']) ? safe::string($_POST['data']) : '';
	$onlinelist = isset($_POST['onlinelist']) ? safe::string($_POST['onlinelist']) : 'TarhPardaz_default';
	if(is_array($array)){
		$new = array();
		foreach($array as $data){
			$explode = explode('~', $data);
			if(!isset($explode[0]))continue;
			switch($explode[0]){
				case 'TarhPardaz':
					$new[] = array('name' => $explode[1], 'cName' => $explode[2], 'src' => $explode[3], 'format' => substr($explode[3], strrpos($explode[3], '.') + 1));
				break;
				case 'default':
					$new[] = array('name' => $explode[1], 'cName' => 'TarhPardaz'.$explode[1], 'src' => $explode[1], 'format' => 'all');
				break;
				default:
					continue 2;
				break;
			}
		}
	}
	$json = json_encode($new, JSON_UNESCAPED_UNICODE);
	$sql->where("name", 'TarhPardaz_fonts');
	$sql->update('options', array(
		'value' => $json
	));
	
	if($onlinelist != ''){
		$sql->where("name", 'TarhPardaz_onlinelist');
		$sql->update('options', array(
			'value' => $onlinelist
		));
	}
	chatroom::reloadconfig();
	echo('ok');
}

?>