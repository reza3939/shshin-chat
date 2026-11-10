<?php

if (true) {
    if (isset($_COOKIE['resetpw'])) {
        $_COOKIE['resetpw'] = safe::number($_COOKIE['resetpw']);
        $sql->where('id', $_COOKIE['resetpw']);
        $resetpw = $sql->getOne('resetpw', array('code'));
    }
	$theme = 'register';
    include(theme::file('resetpw.php'));
} else {
    header::Go(url($options['chat_prefix']));
}
?>
