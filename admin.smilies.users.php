<?php

if (!session('id') or session('admin') == '0')
    exit();
adminpanel::check_Permission('exit', 'smiliesusers');

$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';
$action = isset($_POST['action']) ? safe::string($_POST['action']) : '';

if ($action == "delete") {
    $sql->where("id", $id);
    $sql->delete('user_smile');
	echo('okdel');
}
if ($action == "active") {
    $sql->where("id", $id);
    $sql->update('user_smile', array(
        'active' => '1'
    ));
	echo('ok');
}
?>