<?php

if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'close');
$action = safe::string($_REQUEST['action']);

if($action == 'close'){
    $value = safe::string($_REQUEST['value']);
    if($value != 'true' and $value != 'false')$value = 'false';
    $sql->where("name", 'chat_close');
    $sql->update('options', array(
        'value' => $value
    ));
    chatroom::reloadconfig();
    echo('ok');
    
}elseif($action == 'msg'){
    $value = safe::string($_REQUEST['value']);
    $params =  json_decode($options['chat_closeparam'], true);
    $params['msg'] = $value;
    $params = json_encode($params, JSON_UNESCAPED_UNICODE);
    $sql->where("name", 'chat_closeparam');
    $sql->update('options', array(
        'value' => $value
    ));
    chatroom::reloadconfig();
    echo('ok');
}elseif($action == 'theme'){
    $value = safe::string($_REQUEST['value']);
    $params =  (array)json_decode($options['chat_closeparam']);
    $params['theme'] = $value;
    $params = json_encode($params, JSON_UNESCAPED_UNICODE);
    $sql->where("name", 'chat_closeparam');
    $sql->update('options', array(
        'value' => $value
    ));
    chatroom::reloadconfig();
    echo('ok');
}elseif($action == 'timetolunch'){
    $value = safe::string($_REQUEST['value']);
    $params =  (array)json_decode($options['chat_closeparam']);
    $params['timetolunch'] = $value;
    $params = json_encode($params, JSON_UNESCAPED_UNICODE);
    $sql->where("name", 'chat_closeparam');
    $sql->update('options', array(
        'value' => $value
    ));
    chatroom::reloadconfig();
    echo('ok');
}
elseif($action == 'procentageDone'){
    $value = safe::string($_REQUEST['value']);
    $params =  (array)json_decode($options['chat_closeparam']);
    $params['procentageDone'] = (int)$value;
    $params = json_encode($params, JSON_UNESCAPED_UNICODE);
    $sql->where("name", 'chat_closeparam');
    $sql->update('options', array(
        'value' => $value
    ));
    chatroom::reloadconfig();
    echo('ok');
}
?>