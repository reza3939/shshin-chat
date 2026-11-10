<?php
$theme = 'player';
$src = array();
$title = array();
foreach($sql->get('player') as $row){
    $src[] = url($row['src']);
    $title[] = $row['title'];
}
include('theme/player/index.php');
?>