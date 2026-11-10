<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'deletesmily');

$id = safe::number($_POST['smily']);
$sql->where("id", $id);
foreach($sql->get('smilies', null, array('id', 'img', 'code')) as $smily){
    if (is_file("theme/images/smilies/{$smily['img']}")) {
        unlink("theme/images/smilies/{$smily['img']}");
    }
    $sql->where("id", $smily['id']);
    $sql->delete('smilies');

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
    chatroom::addlog('9', "شکلک \"{$smily['code']}\" را حذف کرد");
}
  $text = " حذف کردن شکلک\n";
$text .='ایدی شکلک: '.$id ."\n";
$text .= "ادرس شکلک : ".url()."/theme/images/smilies/{$smily['img']}\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['sendsmilieslog'] == 'Sure'){
             tlg($text,'chat');
                 }
    echo('ok');
}
?>