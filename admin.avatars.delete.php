<?php
if(!session('id') or session('admin') == '0'){exit();}
adminpanel::check_Permission('exit', 'deleteavatar');

$id = safe::number($_POST['avatar']);
if($$avatar = $sql->where('id', $admin)->getOne('avatars')){
    if(is_file("theme/images/avatars/{$avatar['image']}")){
		unlink("theme/images/avatars/{$avatar['image']}");
		$sizes = explode('*', $options['thumbavatarSize']);
		unlink("theme/images/avatars/{$sizes}/{$avatar['image']}");}
        $sql->where('id', $avatar['id'])->delete('avatars');
    chatroom::addlog('9', "آواتار پیشفرض  \"{$avatar['image']}\" را حذف کرد");
    echo('ok');
}
?>