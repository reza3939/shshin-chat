<?php

$enable = $options['chat_love_enable'];
if ($enable == 'true') {
    include(theme::file('love.php', $options['chat_love_theme']));
}
?>