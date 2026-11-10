<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'adminpanel');

$tel = json_decode($options['teloptions'], true);
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');

$user = isset($_POST['user']) ? safe::number($_POST['user']) : '';
$sql->where("id", $user);
if (!$user = $sql->getOne('users', array('id','type','username'))) {
    echo('user');
    return;
}
$sql->where("user", $user['id']);
if ($sql->has('adminpanel')) {
    echo('repeatuser');
}
if ($usertype[$user['type']]['admin'] == '0') {
    echo('noadminstrator');
    return;
}
if (empty($_POST["password"])) {
    echo('emptypw');
    return;
}



$permissions = isset($_POST['permission']) ? safe::string($_POST['permission']) : 'all';
$permissionsText = '';
if (is_array($permissions)) {
    if (in_array('all', $permissions)) {
        $permissionsText = 'all';
    } else {
        $permissionsKeys = array_keys(adminpanel::$Permissions);
        foreach ($permissions as $permission) {
            if (in_array($permission, $permissionsKeys)) {
                $permissionsText = implode(',', $permissions);
                $permissionsText = safe::string($permissionsText);
            }
        }
    }
} elseif (is_string($permissions)) {
    if ($permissions == 'all') {
        $permissionsText = 'all';
    } else {
        $permissionsKeys = array_keys(adminpanel::$Permissions);
        $permissions = explode(',', $permissions);
        foreach ($permissions as $permission) {
            if (in_array($permission, $permissionsKeys)) {
                $permissionsText = implode(',', $permissions);
                $permissionsText = safe::string($permissionsText);
            }
        }
    }
}


$password = isset($_POST['password']) ? chatroom::password_encode($_POST['password']) : '';
$sql->insert('adminpanel', array(
    'user' => $user['id'],
    'permissions' => $permissionsText,
    'password' => $password,
));

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "اجازه داد  " . Users::get('username', safe::number($_POST['user'])) . " به پنل مدیریت دسترسی داشته باشد");
}
 $text = " اجازه داد  " . Users::get('username', safe::number($_POST['user'])) . " به پنل مدیریت دسترسی داشته باشد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
  
       if($tel['sendadminpaneladslog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>