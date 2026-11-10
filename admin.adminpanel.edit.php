<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'adminpanel');
$tel = json_decode($options['teloptions'], true);
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw')) {
    die('لطفا صفحه خود را رفرش کنيد');
}
$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';
if (session('id') != '1' && $id == '1') {
    echo 'این شخص صاحب چت روم است اجازه ویرایش اطلاعات را ندارید .';
    exit;
}
$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';
$sql->where("id", $id);
if (!$adminpanel = $sql->getOne('adminpanel')) {
    echo('id');
    return;
}


$user = isset($_POST['user']) ? safe::number($_POST['user']) : '';
$admins = array(1, 2, 3, 4, 5, 6, 7, 8);
foreach ($usertype as $type) {
    if (in_array($type['admin'], $admins)) {
        $is_admin[] = $type['id'];
    }
}
$sql->where("id", $user);
if (!$user = $sql->getOne('users', array('id','type'))) {
    echo('user');
    return;
}
if (!in_array($user['type'], $is_admin)) {
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
if (safe::is_md5($adminpanel['password']) and $password == '') {
    $password = $adminpanel['password'];
}
$sql->where("id", $id);
$sql->update('adminpanel', array(
    'permissions' => $permissionsText,
    'password' => $password,
    'user' => $user['id']
));

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));

if ($hide['hide'] == '1' and session("admin")==1){
    
}elseif ($hide['hide'] == '0' and session("admin")!=0){
   chatroom::addlog('9', "محدودیت های پنل مدیریت " . Users::get('username', safe::number($_POST['user'])) . " را عوض کرد");
}
 $text = " محدودیت های پنل مدیریت " . Users::get('username', safe::number($_POST['user'])) . " را عوض کرد\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";

       if($tel['sendadminpaneleditlog'] == 'Sure'){
             tlg($text,'chat');
                 }
echo('ok');
?>