<?php

if (session('admin') != '1')
    exit();


$firstname = isset($_POST['firstname']) ? safe::string($_POST['firstname']) : '';
if ($firstname == '') {
    echo('firstname');
    return;
}

$lastname = isset($_POST['lastname']) ? safe::string($_POST['lastname']) : '';
if ($lastname == '') {
    echo('lastname');
    return;
}

$email = isset($_POST['email']) ? safe::string($_POST['email']) : '';
if (!safe::is_email($email)) {
    echo('email');
    return;
}

$password = isset($_POST['password']) ? $_POST['password'] : '';
if ($password == '') {
    echo('password');
    return;
}

$city = isset($_POST['city']) ? safe::string($_POST['city']) : '';
if ($city == '') {
    echo('city');
    return;
}

$address = isset($_POST['address']) ? safe::string($_POST['address']) : '';
if ($address == '') {
    echo('address');
    return;
}

$zip = isset($_POST['zip']) ? safe::string($_POST['zip']) : '';
if ($zip == '') {
    echo('zip');
    return;
}

$phone = isset($_POST['phone']) ? safe::string($_POST['phone']) : '';
if ($phone == '') {
    echo('phone');
    return;
}

$activecode = isset($_POST['activecode']) ? safe::number($_POST['activecode']) : '';
if ($activecode == '') {
    echo('activecode');
    return;
}

$api = json_decode($options['dchat_api'], true);

//include('inc/classes/WebRequest.php');
WebRequest::SetOption('coockie', false);
$data = array(
    'username' => $api['username'],
    'password' => $api['password'],
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email,
    'password_user' => $password,
    'city' => $city,
    'address' => $address,
    'zip' => $zip,
    'phone' => $phone,
    'activecode' => $activecode
);

$request = WebRequest::post("{$api['url']}/chat.validtion" . $api['suffix'], $data);
if ($request[1] == 'ok') {
    if (!is_file('inc/config.tmp'))
        file_put_contents('inc/config.tmp', '');
    $config = file_get_contents('inc/config.tmp');
    $config = json_decode($config, true);
    $config['validtion'] = true;
    $config = json_encode($config);
    file_put_contents('inc/config.tmp', $config);
    session('validtion', 'true');
}
echo($request[1]);
?>