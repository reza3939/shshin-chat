<?php

if (!session('id') or session('admin') == '0') {
    exit();
}

adminpanel::check_Permission('notfound', 'delads');
$id = session('id');
$tel = json_decode($options['teloptions'], true);
$ad = isset($_POST['ad']) ? safe::number($_POST['ad']) : '';
$sql->where("id", $ad);
$sql->delete('ads');

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تبلیغ شماره $ad را حذف نمود");
}
 $text = "تبلیغ شماره $ad را حذف نمود\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
   if($tel['sendadslog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>