<?php
if (!session('id') or session('admin') == '0') {
	exit;
}
adminpanel::check_Permission('exit', 'databasesettings');
/* * *********** database SETTINGS********************** */
if (isset($_POST['enginemysql'])) {
	$newvalue = safe::string($_POST['enginemysql']);
	if (in_array($newvalue, array('MYISAM', 'InnoDB'))) {
		$sql->where('name', 'enginemysql')->update('options', array(
			'value' => $newvalue
		));
	}
}
chatroom::reloadconfig();
$hide = $sql->where('id', $id)->getValue('onlines', 'hide');
if ($hide == '1' and session("admin") == 1) {
} elseif ($hide == '0' and session("admin") != 0) {
	chatroom::addlog('9', "تنظیمات را تغییر داد");
}
echo 'ok';
?>
