<?php

$LOGIN_INFORMATION = array('mehrtarh' => '4135',);
define('USE_USERNAME', true);
if(isset($_GET['logout'])) {
  setcookie("verify", '');
  die("<script type=\"text/javascript\">alert('با موفقیت از پنل خارج شدید');window.location = '".url('emergency')."';</script>");
}
if(!function_exists('showLoginPasswordProtect')) {
function showLoginPasswordProtect($error_msg) {
?>
<html>
  
<head>
<title>پنل اضطراری چت روم</title>
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
	<link rel="stylesheet" type="text/css" href="../pages/emergency.css"/>

<?php echo $error_msg; ?>

</head>
<body>
<center>
 <div class="mainilitarh">		
<div class="content_nilitarh">
<div id="nilitarh_cen">	

<form method="POST" >
<h3>پنل اضطراری مهر طرح</h3>
<div class="nilitarh">
<input placeholder="username" type="input" name="access_login" size="20" />
<input placeholder="password" type="password" name="access_password" size="20" />
<input name="Submit" type="submit" class="sub_nilitarh" value="Login" />
  </div>
</form>
</div></div></div>
<h1 style="display:none;"><a href="http://www.mehrtarh.ir" title="طراحی چت روم" alt="طراحی چت روم">طراحی چت روم</a></h1>
<h3 style="display:none;"><a href="http://www.mehrtarh.ir" title="طراحی چت روم" alt="طراحی چت روم">طراحی چت روم</a></h3>
</center>
</body>
</html>
<?php
  die();
}
}
if (isset($_POST['access_password'])) {
  $login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
  $pass = $_POST['access_password'];
  if (!USE_USERNAME && !in_array($pass, $LOGIN_INFORMATION)
  || (USE_USERNAME && ( !array_key_exists($login, $LOGIN_INFORMATION) || $LOGIN_INFORMATION[$login] != $pass ) ) 
  ) {
    showLoginPasswordProtect("<script type=\"text/javascript\">alert('مشخصات وارد شده معتبر نمی باشید');</script>");
    setcookie("invalidlogin", 'yes', time() + 3600 * 2);
  }
  else {
    setcookie("verify", md5($pass));
    unset($_POST['access_login']);
    unset($_POST['access_password']);
    unset($_POST['Submit']);
  }

}
else {
  if (!isset($_COOKIE['verify'])) {
    showLoginPasswordProtect("");
  }
  $found = false;
  foreach($LOGIN_INFORMATION as $kay=>$val) {
    if ($_COOKIE['verify'] == md5($val)) {
      $found = true;
      break;
    }
  }
  if (!$found) {
    showLoginPasswordProtect("");
  }
}
?>
<?php
$theme = $options['admintheme'];
$el2 = giu('el2');
   
    if(session('validtion') != 'true'){
        if(!is_file('inc/config.tmp'))file_put_contents('inc/config.tmp', '');
        $config = file_get_contents('inc/config.tmp');
        $config = json_decode($config, true);
        if(isset($config['validtion']) and $config['validtion'] == true)session('validtion',   'true' );else session('validtion',   'false' );
    }
    if(!$el2) $el2 ='index';
    if($el2 == 'index'){
    }
    if(is_file("pages/emergency/$el2.php")){
            include("pages/emergency/$el2.php");
        }else{
            include("pages/emergency.php");
        }  
?>