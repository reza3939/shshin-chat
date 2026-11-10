<?php

header("Content-Type: text/html;charset=utf-8");
if (session('id')) {
    $sql->where("user", session('id'));
    if($to = $sql->getOne('banns', array('id', 'to', 'author', 'reason'))){
        setcookie('ChatBenn', $to['id'], $to['to']);
        $sql->where("id", session('id'));
        $sql->delete('onlines');
        Users::Offline(session('id'));
           $newsession = array();
		if(session('ui')){
			$newsession['chat_ui'] = safe::number(session('ui'));
		}
		$_SESSION = $newsession;
        //include(theme::file('banned.php'));
    include('theme/banned/banned.php');
    }
} elseif (session('banned')) {
    $sql->where("id", $el2);
    if($to = $sql->getOne('banns', array('id', 'to', 'author', 'user'))){
        setcookie('ChatBenn', $to['id'], $to['to']);
        $sql->where("id", $to['user']);
        $sql->delete('onlines');
        Users::Offline($to['user']);
        $newsession = array();
             $newsession = array();
		if(session('ui')){
			$newsession['chat_ui'] = safe::number(session('ui'));
		}
		$_SESSION = $newsession;
        //include(theme::file('banned.php'));
         include('theme/banned/banned.php');
    }
}
?>
