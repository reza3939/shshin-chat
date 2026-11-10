<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'textsetting');
/************* TEXT SETTINGS***********************/
if(isset($_POST['lname_fname'])){
    $newvalue = ($_POST['lname_fname']);
    $sql->where("name", 'lname_fname');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['number_cart'])){
    $newvalue = ($_POST['number_cart']);
    $sql->where("name", 'number_cart');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['number_hesab'])){
    $newvalue = ($_POST['number_hesab']);
    $sql->where("name", 'number_hesab');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['bank'])){
    $newvalue = ($_POST['bank']);
    $sql->where("name", 'bank');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['phone'])){
    $newvalue = (safe::string($_POST['phone']));
    $sql->where("name", 'phone');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['ghavanin'])){
    $newvalue = (safe::string($_POST['ghavanin']));
    $sql->where("name", 'ghavanin');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}

if(isset($_POST['1'])){
    $newvalue = (safe::string($_POST['1']));
    $sql->where("name", 1);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['2'])){
    $newvalue = (safe::string($_POST['2']));
    $sql->where("name", 2);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['3'])){
    $newvalue = (safe::string($_POST['3']));
    $sql->where("name", 3);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['4'])){
    $newvalue = (safe::string($_POST['4']));
    $sql->where("name", 4);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['5'])){
    $newvalue = (safe::string($_POST['5']));
    $sql->where("name", 5);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['6'])){
    $newvalue = (safe::string($_POST['6']));
    $sql->where("name", 6);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['7'])){
    $newvalue = (safe::string($_POST['7']));
    $sql->where("name", 7);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['8'])){
    $newvalue = (safe::string($_POST['8']));
    $sql->where("name", 8);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['9'])){
    $newvalue = (safe::string($_POST['9']));
    $sql->where("name", 9);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if(isset($_POST['10'])){
    $newvalue = (safe::string($_POST['10']));
    $sql->where("name", 10);
    $sql->update('options', array(
        'value' => $newvalue
    ));
}

if (isset($_POST['chat_advertise_enable'])) {
    $newvalue = 'true';
    $sql->where("name", 'chat_advertise_enable');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'chat_advertise_enable');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}

if (isset($_POST['pupin'])) {
    $newvalue = 'true';
    $sql->where("name", 'pupin');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'pupin');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['pupout'])) {
    $newvalue = 'true';
    $sql->where("name", 'pupout');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'popout');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['newout'])) {
    $newvalue = 'true';
    $sql->where("name", 'newout');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'newout');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['newin'])) {
    $newvalue = 'true';
    $sql->where("name", 'newin');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'newin');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['banin'])) {
    $newvalue = 'true';
    $sql->where("name", 'bain');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'banin');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['banout'])) {
    $newvalue = 'true';
    $sql->where("name", 'banout');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'banout');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['banclein'])) {
    $newvalue = 'true';
    $sql->where("name", 'banclein');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'banclein');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['bancleout'])) {
    $newvalue = 'true';
    $sql->where("name", 'bancleout');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'bancleout');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['linkin'])) {
    $newvalue = 'true';
    $sql->where("name", 'linkin');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'linkin');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['lnamefname'])) {
    $newvalue = 'true';
    $sql->where("name", 'lnamefname');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'lnamefname');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['bank2'])) {
    $newvalue = 'true';
    $sql->where("name", 'bank2');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'bank2');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}

if (isset($_POST['numbercart'])) {
    $newvalue = 'true';
    $sql->where("name", 'numbercart');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'numbercart');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
if (isset($_POST['numberhesab'])) {
    $newvalue = 'true';
    $sql->where("name", 'numberhesab');
    $sql->update('options', array(
        'value' => $newvalue
    ));
} else {
    $newvalue = 'false';
    $sql->where("name", 'numberhesab');
    $sql->update('options', array(
        'value' => $newvalue
    ));
}
chatroom::reloadconfig();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "تنظیمات  هزینه تبلیغات را تغییر داد");
} 
$tel = json_decode($options['teloptions'], true);
   $text = "تنظیمات  هزینه تبلیغات را تغییر داد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendadsbuylog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>
