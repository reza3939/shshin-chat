<?php

if (!session('id') or session('admin') == '0') {
    exit();
}adminpanel::check_Permission('notfound', 'logscover');
if (isset($_POST['action']) || empty($_POST[''])) {
    if ($_POST['action'] == 'delete') {
        $user = isset($_POST['user']) ? safe::number($_POST['user']) : '';
        if ($user == '' && $user < 1) {
            echo(json_encode(array('status' => false, 'error' => 'profile')));
            exit();
        } else {
            $sql->where("id", $user);
            $sql->where("cover", '', '!=');
            if ($cover = $sql->getValue('profiles', 'cover')) {
                $folder = "theme/images/covers/{$cover}";
                if (is_file($folder)) {
                    @unlink($folder);
                    $sql->where("id", $user);
                    $sql->update('profiles', array(
                        'cover' => ''
                    ));

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
                    chatroom::addlog('9', "جلد پروفایل .$user. را حذف کرد");
}
                    echo(json_encode(array('status' => true)));
                    exit();
                } else {
                    echo(json_encode(array('status' => false, 'error' => 'unexpectederror')));
                    exit();
                }
            } else {
                echo(json_encode(array('status' => false, 'error' => 'profile')));
                exit();
            }
        }
    } else {
        echo(json_encode(array('status' => false, 'error' => 'action')));
        exit();
    }
} else {
    echo(json_encode(array('status' => false, 'error' => 'action')));
    exit();
}
?>