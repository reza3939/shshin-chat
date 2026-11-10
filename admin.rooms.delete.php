<?php

if (!session('id') or session('admin') == '0') {
    header::Go(url('login'));
    exit();
}
adminpanel::check_Permission('notfound', 'deleteroom');

$id = safe::number($_POST['room']);
$sql->where("id", $id);
if ($room = $sql->getOne('rooms')) {
    if ($room['id'] == $options['chat_defaultroom']) {
        header::Go(url('admin/rooms'));
        exit();
    }
    if ($sql->getValue('rooms', 'count(*)') == 1) {
        header::Go(url('admin/rooms'));
        exit();
    }
    $firstroom = $sql->getOne('rooms',array('id', 'title'));
    $sql->where("roomid", $room['id'])->update('onlines', array(
        'roomid' => $firstroom['id'],
        'roomname' => $firstroom['title']
    ));
    $sql->where("id", $id)->delete('rooms');

    $sql->where("id", session('id'));
    $hide = $sql->getOne('onlines',array('id', 'hide')); 

if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
   chatroom::addlog('9', "اتاق \"{$room['title']}\" را حذف کرد");
}
  $tel = json_decode($options['teloptions'], true);
   $text = "اتاق \"{$room['title']}\" را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
   
       if($tel['sendroomlog'] == 'Sure'){
             tlg($text,'chat');
                 }
    header::Go(url('admin/rooms'));
}
?>