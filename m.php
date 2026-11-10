<?php

if (is_mobile_detect()) {
    $theme = 'm';
    include(theme::file('index.php'));
} else {
    include("pages/index.php");
}
?>
