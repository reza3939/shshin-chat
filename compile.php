<?php

$el2 = giu('el2');
$allowpage = array('ranking');
if (in_array($el2, $allowpage)) {
    if (is_file(theme::file("$el2.php")))
        include(theme::file("$el2.php"));
}
?>