<?php

header::to404();
$theme = 'system';
if (is_file(theme::file('notfound.php'))) {
    include(theme::file('notfound.php'));
} elseif (is_file(theme::file('notfound.php', 'system'))) {
    include(theme::file('notfound.php', 'system'));
}
?>