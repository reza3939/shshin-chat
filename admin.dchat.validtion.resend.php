<?php

if (session('admin') != '1')
    exit();
$api = json_decode($options['dchat_api'], true);

//include('inc/classes/WebRequest.php');
WebRequest::SetOption('coockie', false);
$request = WebRequest::post("{$api['url']}/chat.validtion.resend" . $api['suffix'], array('username' => $api['username'], 'password' => $api['password']));
switch ($request[1]) {
    case('ok'):echo('ok');
        break;
    case('time'):echo('time');
        break;
    case('invalid'):case('cannot'):echo('connnot');
        break;
    default:echo($request[1]);
        break;
}
?>