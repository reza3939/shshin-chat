<?php
class Sse
{
    static function Update()
    {
        $file = file_get_contents('inc/lastupdate.simple.php');
        $file = str_replace("{time}", time(), $file);
        $f    = fopen('inc/lastupdate.php', 'w');
        fwrite($f, $file);
        fclose($f);
    }
}
?>