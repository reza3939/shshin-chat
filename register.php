<?php

if (!session('id')) {
    if (session('ui'))
        $sql->where("id", session('ui'));
        $register = $sql->getOne('register', array('code'));
	$theme = 'register';
    include(theme::file('register.php'));
}else {
    header::Go(url($options['chat_prefix']));
}
?>
