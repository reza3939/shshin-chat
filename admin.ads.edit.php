<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'editads');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
$tel = json_decode($options['teloptions'], true);
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}
$id = isset($_POST['id']) ? $_POST['id'] : '';
if ($id == '') {
    echo('id');
    return;
}
    $title = isset($_POST['title']) ? safe::string($_POST['title']) : 'تبلیغ'; 
    $url = isset($_POST['url']) ? safe::url($_POST['url']) : '';
    if ($url == '') {
        echo('url');
        return;
    }
    if (substr($url, 0, 7) != 'http://') 
        $url = 'http://' . $url;
    if (strlen($url) == 7) {
        echo('url');
        return;
    }
    $type = isset($_POST['type']) ? safe::string($_POST['type']) : '';
    $page = isset($_POST['page']) ? safe::string($_POST['page']) : '';
    $location = isset($_POST['location']) ? safe::string($_POST['location']) : '';
    $exptime = isset($_POST['exptime']) ? safe::string($_POST['exptime']) : '';
    $expiration = isset($_POST['expiration']) ? safe::string($_POST['expiration']) : '';
    if ($expiration == '' or $expiration == '0') {
    $expiration = '0';
    $expirationTime = 0;
    } else if ($expiration == '1') {
    $flag=2;
    } else {
    $expirationTime = 0;
    $expiration = explode('-', $expiration);
    if (!isset($expiration[1]))
        $expirationTime = 0;

    $expiration[0] = (int) safe::number($expiration[0]);
    switch ($expiration[1]) {
        case('minute'):$expirationTime = $exptime + ($expiration[0] * 60);
            break;
        case('hour'):$expirationTime = $exptime + ($expiration[0] * 3600);
            break;
        case('day'):$expirationTime = $exptime + ($expiration[0] * 86400);
            break;
        case('week'):$expirationTime = $exptime + ($expiration[0] * 604800);
            break;
        case('month'):$expirationTime = $exptime + ($expiration[0] * 2592000);
            break;
        case('year'):$expirationTime = $exptime + ($expiration[0] * 31536000);
            break;
    }
 $flag=0;
}
    $expirationk = isset($_POST['expirationk']) ? safe::string($_POST['expirationk']) : '';
    if ($expirationk == '' or $expirationk == '0') {
    $expirationk = '0';
    $expirationkTime = 0;
    } else if ($expirationk == '1') {
    $flag=0;
    } else {
    $expirationkTime = 0;
    $expirationk = explode('-', $expirationk);
    if (!isset($expirationk[1]))
        $expirationkTime = 0;

    $expirationk[0] = (int) safe::number($expirationk[0]);
    switch ($expirationk[1]) {
        case('minute'):$expirationkTime = $exptime - ($expirationk[0] * 60);
            break;
        case('hour'):$expirationkTime = $exptime - ($expirationk[0] * 3600);
            break;
        case('day'):$expirationkTime = $exptime - ($expirationk[0] * 86400);
            break;
        case('week'):$expirationkTime = $exptime - ($expirationk[0] * 604800);
            break;
        case('month'):$expirationkTime = $exptime - ($expirationk[0] * 2592000);
            break;
        case('year'):$expirationkTime = $exptime - ($expirationk[0] * 31536000);
            break;
    }
$flag=1;
}
    if (isset($_FILES['banner'])) {
        $typeFile = $_FILES['banner']['type'];
        if ($typeFile != 'image/png' && $typeFile != 'image/jpeg' && $typeFile != 'image/gif') {
            $msg = 'type';
        } else {
            switch ($typeFile) {
                case('image/png'):$format = 'png';
                    break;
                case('image/jpeg'):$format = 'jpg';
                    break;
                case('image/gif'):$format = 'gif';
                    break;
            }
            $folder = 'theme/images/ads';
            if (!is_dir($folder))
                mkdir($folder);

            $name = "ad$id.$format";
            $filename = "$folder/$name";
            if (move_uploaded_file($_FILES['banner']['tmp_name'], $filename)) {
                $img = file_get_contents($filename);
                if (strpos((string) $img, '<?php') !== false) {
                    unlink($filename);
                    $msg = 'security';
                } else {
                    $inputs = json_encode(array('banner' => $filename, 'closeable' => 'true'));
                    if($flag==0) {
                    $sql->where('id', $id);
                    $sql->update('ads', array(                        
                        'title' => $title,                      
                        'url' => $url,
                        'type' => $type,
                        'page' => $page,
                        'location' => $location,
                        'expiration' => $expirationTime,
                        'inputs' => $inputs
                    ));	
				    }					
                    if($flag==1) {
                    $sql->where('id', $id);
                    $sql->update('ads', array(                        
                        'title' => $title,                      
                        'url' => $url,
                        'type' => $type,
                        'page' => $page,
                        'location' => $location,
                        'expiration' => $expirationkTime,
                        'inputs' => $inputs
                    ));	
					}					
                    $msg = 'ok';
                }
            } else {
                $msg = 'noup';
            }
        }
    } else {
        $msg = 'noelemrnr';
    }
     $msg = 'ok';
    if ($msg == 'ok') {
        if($flag==0) { 	 
	            $sql->where('id', $id);
                    $sql->update('ads', array(                        
                        'title' => $title,                      
                        'url' => $url,
                        'type' => $type,
                        'page' => $page,
                        'location' => $location,
                        'expiration' => $expirationTime,
                    ));		
             }    
		if($flag==1) {
                    $sql->where('id', $id);
                    $sql->update('ads', array(                        
                        'title' => $title,                      
                        'url' => $url,
                        'type' => $type,
                        'page' => $page,
                        'location' => $location,
                        'expiration' => $expirationkTime,
                    ));	
		}
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تبلیغ با عنوان $title را ویرایش کرد");
} 
  $text = "تبلیغی با عنوان ($title)  و ادرس ($url)را ویرایش کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    tlg($text,'designer');
      if($tel['sendadslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    }
    echo($msg); 

?>