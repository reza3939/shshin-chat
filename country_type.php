<?php
$visitor_country = iptocountry(ip());
$country_name = $countries[$visitor_country][1];
$file_to_check = "theme/images/flags/$visitor_country.png";
if (file_exists($file_to_check)) {
    $pics = "<img title='$country_name' src=$file_to_check><br>";
} else {
    $pics = "<img title='$country_name' src='flags/noflag.png'><br>";
}
?>
<!doctype html>
<html>
    <head>
        <title>آی پی شما مسدود است </title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <link href="<?php echo(url('theme/fonts/fonts.css')); ?>" rel="stylesheet" type="text/css"/>
        <style>
        body{background:#6B86B6;font-family:Byekan}
		button{cursor:pointer;background:#e68f01;padding:2px 7px;color:#fff;font-family:Byekan;font-size:12px;text-align:center;border:1px #af7311 solid;border-radius:5px;box-shadow:0 0 2px #af7311;text-shadow:0 0 0 #af7311}
		button:hover{background:#cf8306;box-shadow:0 0 0 #cf8306;text-shadow:0 0 2px #000;color:#000}
		button:active{border:0 #af7311 solid}
        </style>
    </head>
    <body>
    <center>
        <div style="margin-top:80px;"><img alt="طراحی جت روم" src="<?php echo(url('theme/images/stop.png')); ?>"></div>
    </center>
    <br><br>
    <center>
        <div style='width:200px;text-align:center;font-size:15px;padding:5px;font-family:Byekan;border:1px solid #FFC300;-webkit-border-radius:6px;-moz-border-radius: 6px;border-radius: 6px;background-color:#FFEE00;'>آیپی شما: <?php echo ip(); ?></div>
    </center>
    <br>
    <center>
        <div style='direction:rtl;width:500px;text-align:center;font-size:15px;padding:5px;font-family:Byekan;border:1px solid #FFC300;-webkit-border-radius:6px;-moz-border-radius: 6px;border-radius: 6px;background-color:#FFEE00;'>کشور شما: <?php echo $country_name; ?><?php echo $pics ?></div>
    </center>
    <br>
    <p style="color:black;font-size:17px;text-shadow:0px 0px 0px black;font-family:BYekan;text-align:center;"><span style="color:rgb(255, 215, 0)">اطلاعیه  :  
            <strong style="color:rgb(248, 255, 163)">سلام : ورود برای کشور شما امکان پذیر نمی باشد.لطفا چند ساعت دیگر مجدد تلاش کنید</strong>
        </span>
    </p>
    <?php include ("pages/logofooter.php"); ?>
</body>
</html>