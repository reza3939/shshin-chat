<?php
header("Content-Type: text/html;charset=utf-8");
$el2 = giu('el2');
if (!$el2)
    header::Go(url());
else
    header::Go(url());
?>