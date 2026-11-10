<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'logsprofile');
$id = isset($_POST['postid']) ? safe::number($_POST['postid']) : '';
$sql->where("id", $id);
if (!$sql->has('profile_posts')) {
    exit('nonew');
}
$sql->where("id", $id);
if($post = $sql->getOne('profile_posts', array('id'))){
    $sql->where("id", $post['id']);
    $sql->delete('profile_posts');
    echo('ok');
}

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "پست پروفایل کاربر را حذف نمود$id");
}
?>