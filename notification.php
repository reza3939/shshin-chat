<?php


$file_path = "http://panel.tarhpardaz.ir/notification/notification.php";
$file = fopen($file_path, "r");

while ( !feof($file) ) {
    echo fgets($file);
}

fclose($file);

?>