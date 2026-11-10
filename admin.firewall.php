<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'firewall');

if (isset($_POST['active']) and safe::string($_POST['active']) == 'true')
    $active = 'enable';
else
    $active = 'disable';
if (isset($_POST['antiDDos_level']) and in_array($_POST['antiDDos_level'], array('easy', 'medium', 'hard')))
    $level = safe::string($_POST['antiDDos_level']);
else
    $level = 'easy';
$sql->where("name", 'antiDDos');
$sql->update('options', array(
    'value' => $active
));
$sql->where("name", 'antiDDos_level');
$sql->update('options', array(
    'value' => $level
));

chatroom::reloadconfig();
echo('ok');
?>