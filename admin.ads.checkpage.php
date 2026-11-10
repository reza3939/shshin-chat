<?php
$pages = array('login', 'chat', 'profile', 'banned');
foreach($pages as $p){
    if($p == 'profile'){
        $sql->where("page", $p);
        $sql->where("type", array('popup', 'newtab'), 'in');
        $numpop = $sql->getValue('ads', 'count(*)');
        $return = array('types' => array(
            'banner'
        ));
        if($numpop < 3){
            $return['types'][] = 'popup';
            $return['types'][] = 'newtab';
        }
    }
}
?>