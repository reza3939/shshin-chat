<?php
$action = isset($_POST['action']) ? safe::string($_POST['action']) : '';
if(!session('id') or session('admin') == '0'){exit();}
if($action == "del"){
	$id = isset($_POST['id']) ? safe::number($_POST['id']) : '';
	if($id == ''){echo('id');return;}
    db::delete('tags', "`id`='$id'");
    chatroom::addlog('9', "برچسب شماره ($id)  را حذف کرد");       
    echo('ok');
}else if($action == "add"){
	$token = isset($_POST['token']) ? safe::string($_POST['token']) : '';
	if($token != session('changepw')){exit("token");}
	$title = isset($_POST['title']) ? safe::string($_POST['title']) : '';
	$dec = isset($_POST['dec']) ? safe::string($_POST['dec']) : '';
	$key = isset($_POST['key']) ? safe::string($_POST['key']) : '';
	$theme= isset($_POST['theme']) ? safe::string($_POST['theme']) : '';
	if($title == ""){exit("title");}else if($dec == ""){exit("dec");}
	else if($key == ""){exit("key");}else if($theme == ""){exit("theme");}else{
	db::insert('tags', "`title`, `dec`, `key`, `theme`", "'$title', '$dec', '$key', '$theme'");
	chatroom::addlog('9', " برچسب ($title)  را اضافه کرد  ");
	exit("ok");
	}
}
?>