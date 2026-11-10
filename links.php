<?php

if ($options['autolinker'] == 'false') {
    header::Go(url('cantact'));
} else {
    if (is_file(theme::file('links.php'))) {
        include(theme::file('links.php'));
    } else {
        include(theme::file('links.php', 'system'));
    }
}
?>