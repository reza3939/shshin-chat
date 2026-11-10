<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'deleteavatar');
$action = isset($_REQUEST['action']) ? safe::string($_REQUEST['action']) : '';
if($action == 'delavatars'){
	$query = $sql->get('avatars');
	foreach($query as $row){
		if(is_file("theme/images/avatars/{$row['image']}"))unlink("theme/images/avatars/{$row['image']}");
		$sql->where('id', $row['id'])->delete('avatars');
    }
    chatroom::addlog('9', "تمامی آواتار های پیشفرض را حذف کرد");
    echo('ok');
}
?>