<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'users');

$username = isset($_POST['username']) ? safe::string($_POST['username']) : '';
if ($username == '') {
    echo('nullusername');
    return false;
}
if (function_exists('mb_strlen')) {
    if (mb_strlen($username, 'utf-8') > $options['chat_maxlengthname']) {
        echo('lenusername');
        return false;
    }
}
if (Users::Checkrunning($username)) {
    echo('usernamerunning');
    return false;
}


$name = isset($_POST['name']) ? safe::string($_POST['name']) : $username;
if (function_exists('mb_strlen')) {
    if (mb_strlen($name, 'utf-8') > $options['chat_maxlengthname']) {
        echo('lenname');
        return false;
    }
}

$gender = isset($_POST['gender']) ? safe::number($_POST['gender']) : '';
if ($gender != '1' && $gender != '2') {
    $gender = '0';
}

$type = isset($_POST['type']) ? safe::number($_POST['type']) : '2';
if (!Users::is_type($type)) {
    $type = '2';
}

$password = isset($_POST['password']) ? safe::string($_POST['password']) : '';
if ($password == '' && $type != '1') {
    echo('nullpassword');
    return false;
}
$password = md5($password);

$email = isset($_POST['email']) ? safe::string($_POST['email']) : '';
if ($email != '') {
    if (!safe::is_email($email)) {
        echo('nopatrnemail');
        return false;
    }
}

Users::addUser($username, $name, $type, $gender, $email, $password);
echo('ok');
?>