<?php
if($options['chat_game_enable'] == 'true'){
    $gamefile = $options['chat_game_file'];
    include(theme::file('game.php', $options['chat_game_theme']));
}
?>