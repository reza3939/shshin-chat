<?php

header::to404();
$theme = 'system';
if (is_file(theme::file('noaccess.php'))) {
    include(theme::file('noaccess.php'));
} elseif (is_file(theme::file('noaccess.php', 'system'))) {
    include(theme::file('noaccess.php', 'system'));
}
?>