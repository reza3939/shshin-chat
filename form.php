<?php
$re = giu('el2');
if (is_file("pages/form/$re.php")) {
    include("pages/form/$re.php");
}
else {
 echo 'inja omadi chikar :/';
}
?>