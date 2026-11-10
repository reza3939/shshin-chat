<?php
if(!session('id') or session('admin') == '0')exit();
adminpanel::check_Permission('exit', 'silent');

$silent = isset($_POST['id']) ? safe::number($_POST['id']) : '';
if($silent == ''){echo('id');return;}
if($silent = db::get('bracelet_smile', '*', "`id`='$silent'")){
    db::delete('cbracelet_smile', "`id`='$silent[0]'");
}
echo('ok');  
?>