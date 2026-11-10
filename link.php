<?php

$link = safe::number(giu('el2'));
$sql->where('active', 1);
$sql->where('id', $link);
if($link = $sql->getOne('links')){
    $sql->where("id", $link['id']);
    $sql->update('links', array(
        'click' => $sql->inc()
    ));
    header::Go($link['url']);
}
?>