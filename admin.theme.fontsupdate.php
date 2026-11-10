<?php

if (!session('id') or session('admin') == '0')
    exit();
adminpanel::check_Permission('exit', 'addusertypes');

$sorts = safe::number($_POST['checkboxFnt']);
//print_r($sorts);
//exit;
if($_POST['action']=='update'){
if (is_array($id, $_POST['checkboxFnt'])) {
    foreach ($sorts as $id => $sortVal) {
        $id = trim($id);
        $sortVal = trim($sortVal);
        $sql->where("id", $id);
        $sql->update('chatfonts', array(
            'enable' => $sortVal
        ));
    }
} else {
    foreach ($sorts as $id => $sortVal) {
		$id = trim($id);
        $sortVal = trim($sortVal);
        $sql->where("id", $id);
        $sql->update('chatfonts', array(
            'enable' => $sortVal
        ));
    }
}
}

echo('ok');
?>