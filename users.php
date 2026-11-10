<?php

if ($options['chat_users_enable'] == 'true') {
    include(theme::file("users.php", $options['chat_users_theme']));
}
?>