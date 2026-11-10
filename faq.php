<?php

if (is_file("theme/help/help.php")) {
    include("theme/help/help.php");
} else {
    include("pages/notfound.php");
}
?>