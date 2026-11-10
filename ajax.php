<?php

$re = giu('el2');
if (is_file("pages/ajax/$re.php")) {
    include("pages/ajax/$re.php");
} else {
 echo 'inja omadi chikar :/';
}
?>
