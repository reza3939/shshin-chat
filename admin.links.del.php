<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'dellinks');
$link=safe::number($_REQUEST["link"]);
$sql->where("id", $link);
foreach($sql->get('links',null, array('id','title')) as $row ){

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "لینک با عنوان:(".$row['title'].")را حذف کرد");
}

    $tel = json_decode($options['teloptions'], true);
    $text = "لینک با عنوان:(".$row['title'].")را حذف کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
       if($tel['sendlinkdonilog'] == 'Sure'){
             tlg($text,'chat');
                 }

    $sql->where("id", $row['id']);
    $sql->delete('links');
    echo('ok');
}
?>