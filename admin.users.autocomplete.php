<?php

check_session();
if (session('admin') == '0') {
    die('admin?');
}

$wheres = array();
if (isset($_REQUEST['term']) and ! empty($_REQUEST['term'])) {
    $username = safe::string(urldecode($_REQUEST['term']));
    $wheres[] = array('username', '%'.$username.'%', 'LIKE');
    $wheres[] = array('name', '%'.$username.'%', 'LIKE', 'OR');
} else {
    exit();
}
$rows = array();

header::tojson();
foreach($wheres as $where){
    call_user_func_array(array($sql, 'where'), $where);
}
$sql->orderBy('type', 'DESC');
foreach($sql->get('users', null, array('id', 'username', 'name')) as $row){
    $rows[] = array('id' => $row['id'], 'label' => "{$row['username']}({$row['name']})", 'value' => $row['username']);
}
echo(json_encode($rows, JSON_UNESCAPED_UNICODE));
?>