<?php
function safe_codes($t){
    if(is_array($t)): return $t; endif;
    $t=trim($t);
    for($i=0;$i<100;$i++):
       $t=str_replace(array("ahyir","users","(",")","?","'","<?","<?php","<?=","?>","union","select","update","insert","delete","َ","ُ","ّ","ً","ٌ","ٍ","ريال",",",";"),"",$t);
    endfor;
    return($t);
}
foreach($_POST as $key=>$value):
    if(isset($_POST[$key])):
        $_POST[$key]=safe_codes($value);
    endif;
endforeach;
foreach($_GET as $key=>$value):
    if(isset($_GET[$key])):
        $_GET[$key]=safe_codes($value);
    endif;
endforeach;
foreach($_REQUEST as $key=>$value):
    if(isset($_REQUEST[$key])):
        $_REQUEST[$key]=safe_codes($value);
    endif;
endforeach;
if (!session('id') or session('admin') == '0') {
    exit();
}

$password = isset($_POST['password']) ? safe::string($_POST['password']) : '';

if ($options['filemanager_password'] == $password) {
	session("filemanager_password", $password);
    echo('ok');
} else {
    session('filemanager_password', '');
    echo('invalid');
}
?>
