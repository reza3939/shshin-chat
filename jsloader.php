<?php
    header::toJS();
    header::NoCache();
    $el2=safe::string(giu('el2'));
    if($el2=='admin'){
        $el3=safe::string(giu('el3'));
        if(substr($options['admintheme'],0,5)=='admin' && in_array($el3,array('script','plugins','app','mango','filemanger')) && is_file(theme::file("js/{$el3}.js",$options['admintheme']))){
            $theme='adminpanel';
            include(theme::file("js/{$el3}.js",'adminpanel'));
        }else{
            header::to404();
        }
    }
?>