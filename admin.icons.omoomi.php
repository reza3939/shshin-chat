<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'iconomoomi');
if (($_FILES['ozan']['size'] == 0) &&
        ($_FILES['omard']['size'] == 0) &&
          ($_FILES['tick']['size'] == 0) &&
           ($_FILES['untick']['size'] == 0) &&
		($_FILES['report']['size'] == 0) &&
		($_FILES['replypm']['size'] == 0) &&
        ($_FILES['box3']['size'] == 0) &&
        ($_FILES['ona']['size'] == 0)) {
    exit("nofile");
}
if(!empty($_FILES)) {
    $e = $_FILES;
    foreach($_FILES as $key => $s) {
        $e = $key;
        if($_FILES[$e]['name'] != '') {
            $type = $_FILES[$e]['type'];
            if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/gif') {
                exit('type');
                break;
            } else {
                switch($type) {
                    case ('image/png'):
                        $format = 'png';
                       break;
                    case ('image/jpeg'):
                        $format = 'jpg';
                        break;
                    case ('image/gif'):
                        $format = 'gif';
                        break;
                }
            }
        }
    
	}
	}
if ($_FILES['tick']['size'] > 0) {
    $link = "theme/images/chat/tick.png";
    move_uploaded_file($_FILES['tick']['tmp_name'], $link);
}
if ($_FILES['untick']['size'] > 0) {
    $link = "theme/images/chat/untick.png";
    move_uploaded_file($_FILES['untick']['tmp_name'], $link);
}
if ($_FILES['ozan']['size'] > 0) {
    $link = "theme/images/chat/chat.user_f.png";
    move_uploaded_file($_FILES['ozan']['tmp_name'], $link);
}
if ($_FILES['replypm']['size'] > 0) {
    $link = "theme/images/chat/replypm.png";
    move_uploaded_file($_FILES['replypm']['tmp_name'], $link);
}
if ($_FILES['omard']['size'] > 0) {
    $link = "theme/images/chat/chat.user_m.png";
    move_uploaded_file($_FILES['omard']['tmp_name'], $link);
}
if ($_FILES['ona']['size'] > 0) {
    $link = "theme/images/chat/chat.user_n.png";
    move_uploaded_file($_FILES['ona']['tmp_name'], $link);
}
if ($_FILES['report']['size'] > 0) {
    $link = "theme/images/chat/report.png";
    move_uploaded_file($_FILES['report']['tmp_name'], $link);
}
if ($_FILES['box3']['size'] > 0) {
    $link = "theme/images/chat/bodd.jpg";
    move_uploaded_file($_FILES['box3']['tmp_name'], $link);
}
echo "ok";
?>