<!DOCTYPE html><html><head><title><?php echo(site_title); ?></title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" ><meta http-equiv="Content-Language" content="fa">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo($options['chat_description']); ?>">
    <meta name="keywords" content="<?php echo($options['chat_keywords']); ?>">
    <?php echo(theme::get_header('chat')); ?>
    <?php if ($options['titleefect'] == 'true') { ?>
        <script src="<?php echo(theme::url('theme/js/qtip.js')); ?>" type="text/javascript"></script>
    <?php } ?>
    <style type="text/css">
<?php if ($options['blur'] == 'false') { ?>
.pvimg { filter:none !important;}
<?php } if ($options['titleefect'] == 'true') { ?>
 #qTip{color:#fff;background:rgba(0,0,0,0.8);font-size:11px;text-align:right;direction:ltr;display:none;padding:8px 10px 9px 10px;position:absolute;z-index:9999;-webkit-border-radius:5px;-moz-border-radius:5px;-o-border-radius:5px;border-radius:5px;text-shadow:0;text-shadow:0 0 0 #000; font-size:11px; font-family:tahoma;}
<?php } if ($options['roomstyle'] == 'true') { ?>
             .rooms:hover{box-shadow:inset 0 5px 10px rgba(0,0,0,.3),0 0 15px#0000ff;-moz-transition:all .1s ease-in}
    b_on{background:rgba(250,250,250,0.6) none repeat scroll 0% 0%;color:#000;padding:2px 7px;margin-top:2px;border-radius:15px 15px 15px 2px;border-left:3px solid rgba(0,0,0,0.1);float:left;margin-left:2px;position:relative}
                w_on{background:rgba(200,200,200,0.2) none repeat scroll 0% 0%;color:#FFF;padding:2px 7px;margin-top:0;border-radius:15px 15px 15px 2px;border-left:3px solid rgba(0,0,0,0.1);float:left;margin-left:2px;position:relative}
                .rooms{ display:inline-block; cursor:pointer;text-align:right;width:98%;padding:4px 1%;color:#e6e6e6;min-height:20px;height:auto;background-size:100% 100%;border-radius:4px;background-position:center right;margin-top:2px}
                .rooms span{font-family:dinarm;background:rgba(200,200,200,0.2);color:#fff;padding:2px 7px;margin-top:0;border-radius:15px 2px 15px 15px;border-right:3px solid rgba(0,0,0,0.2);margin-right:2px;position:relative}
                .rooms_b{filter:grayscale(100%);-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%);cursor:no-drop;text-align:right;width:98%;padding:4px 1%;color:#e6e6e6;min-height:20px;height:auto;background-size:100% 100%;border-radius:4px;background-position:center right;margin-top:2px}
                .rooms_b span{font-family:dinarm;background:rgba(250,250,250,0.6);color:#000;padding:2px 7px;margin-top:0;border-radius:15px 2px 15px 15px;border-right:3px solid rgba(0,0,0,0.2);margin-right:2px;position:relative}
            <?php } else { ?>
                .rooms{cursor:pointer;text-align:center;height:30px;margin-bottom:2px;padding:1px}
                .rooms_b{filter:grayscale(100%);-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%);cursor:no-drop;background-repeat:repeat-x;height:30px;margin-bottom:2px;padding:1px}
 .rooms:hover{box-shadow:inset 0 5px 10px rgba(0,0,0,.3),0 0 15px#0000ff;-moz-transition:all .1s ease-in}
            <?php } ?>
			 @keyframes shake{0%{transform:translate(2px,1px) rotate(0deg)}10%{transform:translate(-1px,-2px) rotate(-1deg)}20%{transform:translate(-3px,0px) rotate(1deg)}30%{transform:translate(0px,2px) rotate(0deg)}40%{transform:translate(1px,-1px) rotate(1deg)}50%{transform:translate(-1px,2px) rotate(-1deg)}60%{transform:translate(-3px,1px) rotate(0deg)}70%{transform:translate(2px,1px) rotate(-1deg)}80%{transform:translate(-1px,-1px) rotate(1deg)}90%{transform:translate(2px,2px) rotate(0deg)}100%{transform:translate(1px,-2px) rotate(-1deg)}}@-moz-keyframes shake{0%{-moz-transform:translate(2px,1px) rotate(0deg)}10%{-moz-transform:translate(-1px,-2px) rotate(-1deg)}20%{-moz-transform:translate(-3px,0px) rotate(1deg)}30%{-moz-transform:translate(0px,2px) rotate(0deg)}40%{-moz-transform:translate(1px,-1px) rotate(1deg)}50%{-moz-transform:translate(-1px,2px) rotate(-1deg)}60%{-moz-transform:translate(-3px,1px) rotate(0deg)}70%{-moz-transform:translate(2px,1px) rotate(-1deg)}80%{-moz-transform:translate(-1px,-1px) rotate(1deg)}90%{-moz-transform:translate(2px,2px) rotate(0deg)}100%{-moz-transform:translate(1px,-2px) rotate(-1deg)}}@-webkit-keyframes shake{0%{-webkit-transform:translate(2px,1px) rotate(0deg)}10%{-webkit-transform:translate(-1px,-2px) rotate(-1deg)}20%{-webkit-transform:translate(-3px,0px) rotate(1deg)}30%{-webkit-transform:translate(0px,2px) rotate(0deg)}40%{-webkit-transform:translate(1px,-1px) rotate(1deg)}50%{-webkit-transform:translate(-1px,2px) rotate(-1deg)}60%{-webkit-transform:translate(-3px,1px) rotate(0deg)}70%{-webkit-transform:translate(2px,1px) rotate(-1deg)}80%{-webkit-transform:translate(-1px,-1px) rotate(1deg)}90%{-webkit-transform:translate(2px,2px) rotate(0deg)}100%{-webkit-transform:translate(1px,-2px) rotate(-1deg)}}
            .TarhPardaz_win_title{font-family:<?php echo($thememanager['chat']['body']['font-family']); ?>}
            .TarhPardaz_win_content{font-family:<?php echo($thememanager['chat']['body']['font-family']); ?>;font-size:<?php echo($thememanager['chat']['body']['font-size']); ?>}
            .fontonline { font-family:<?php echo($thememanager['chat']['onlinelist']['font-family']); ?> !important; }
            .mainlinks a:hover{color:#00D6FF}.mainlinks{padding-right:3px;padding-left:3px}.mainlinks:hover{-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;color:#6E6E6E;background-color:#545454;box-shadow:inset 0 0 7px rgba(0,0,0,0.28)}          ::selection{background:#525252;color:#fff;text-shadow:0 0 2px #000}::-webkit-scrollbar{width:5px}::-webkit-scrollbar-thumb{background-color:#969696}::-webkit-scrollbar-button{background-color:#E4E4E4}::-webkit-scrollbar-track{background-color:#E4E4E4}::-webkit-scrollbar-corner{background-color:#dbdbdb}* :focus{outline:0}.privat_ausg_an{background-color:#fee;border:1px solid rgba(255,119,119,0.53);-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;box-shadow:0 0 2px rgba(255,119,119,0.48);font-family:b yekan,tahoma;text-shadow:1px 1px #fff;color:#333}
            #message{width:520px;height:28px;color:#000;border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:2px;font-family:tahoma;background:background: #fff;background:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…BoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);background:-moz-radial-gradient(center,ellipse cover,rgba(255,255,255,1) 0%,rgba(237,237,237,1) 100%);background:-webkit-gradient(radial,center center,0px,center center,100%,color-stop(0%,rgba(255,255,255,1)),color-stop(100%,rgba(237,237,237,1)));background:-webkit-radial-gradient(center,ellipse cover,rgba(255,255,255,1) 0%,rgba(237,237,237,1) 100%);background:-o-radial-gradient(center,ellipse cover,rgba(255,255,255,1) 0%,rgba(237,237,237,1) 100%);background:-ms-radial-gradient(center,ellipse cover,rgba(255,255,255,1) 0%,rgba(237,237,237,1) 100%);background:radial-gradient(ellipse at center,rgba(255,255,255,1) 0%,rgba(237,237,237,1) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff',endColorstr='#ededed',GradientType=1);margin-top:-5px;padding:2px 0}.mainlinks:hover{background:rgba(0,0,0,0.35);border-radius:2px;-webkit-border-radius:2px;-moz-border-radius:2px;padding-right:3px;padding-left:3px}


            #welcome{border-radius: <?php echo($thememanager['chat']['welcomebox']['border-radius']); ?>;color: <?php echo($thememanager['chat']['welcomebox']['fonts-color']); ?>;background-color: <?php echo($thememanager['chat']['welcomebox']['background-color']); ?>b3;font-size: <?php echo($thememanager['chat']['welcomebox']['font-size']); ?>;font-family: <?php echo($thememanager['chat']['welcomebox']['font-family']); ?>;font-style:normal;font-weight:400;padding:10px;background-repeat:repeat-x;margin-bottom:2px;text-align:center;box-shadow:0 0 20px rgba(0,0,0,0.04) inset;direction:rtl;padding-bottom:10px;border:<?php echo($thememanager['chat']['welcomebox']['border']); ?>;}


            .linkdooni{font-family:<?php echo($thememanager['chat']['linkdooni']['font-family']); ?>;background-color: <?php echo($thememanager['chat']['linkdooni']['background-color']); ?>b3;padding:8px;font-size:10px;color:#FFF;border-radius:3px;border-top-left-radius:3px;border-top-right-radius:3px;border-bottom-right-radius:3px;border-bottom-left-radius:3px;height:22px;line-height:20px;text-shadow:1px 1px rgba(0,0,0,0.30);font-weight:400;border:<?php echo($thememanager['chat']['linkdooni']['border']); ?>;margin:4pt auto 2pt}
            .newsTarhPardaz{font-family:<?php echo($thememanager['chat']['linkdooni']['font-family']); ?>;background:<?php echo($thememanager['chat']['linkdooni']['background-color']); ?>b3;border:<?php echo($thememanager['chat']['linkdooni']['border']); ?>;margin:0 auto auto;padding-top:0;color:#FFF;height:30px;border-radius:5px;font-size:15px;width:97%;}
            .TarhPardaz_win_content{background-repeat:<?php echo($thememanager['chat']['privat']['background-repeat']); ?>;background-color: <?php echo($thememanager['chat']['privat']['background-color']); ?>;background-image:url('<?php echo($thememanager['chat']['privat']['background-image']); ?>');}
            #adminbereich_body{background-repeat:<?php echo($thememanager['chat']['privat']['background-repeat']); ?>;background-color: <?php echo($thememanager['chat']['privat']['background-color']); ?>;background-image:url('<?php echo($thememanager['chat']['privat']['background-image']); ?>');}
            .privat_mesages_window{background-color:#D5F1FF;background-repeat:<?php echo($thememanager['chat']['privat']['background-repeat']); ?>;background-color: <?php echo($thememanager['chat']['privat']['background-color']); ?>;background-image:url('<?php echo($thememanager['chat']['privat']['background-image']); ?>');border: 2px dashed #000000; }


           #changemod{border:<?php echo($thememanager['chat']['welcomebox']['border']); ?>;border-radius: <?php echo($thememanager['chat']['welcomebox']['border-radius']); ?>;color: <?php echo($thememanager['chat']['welcomebox']['fonts-color']); ?>;background-color: <?php echo($thememanager['chat']['welcomebox']['background-color']); ?>b3;font-size: <?php echo($thememanager['chat']['welcomebox']['font-size']); ?>;font-family: <?php echo($thememanager['chat']['welcomebox']['font-family']); ?>;height:30px;margin:0 0 2px;padding:5px;display:none}


            #postslist{font-family:<?php echo($thememanager['chat']['onlinelist']['font-family']); ?>;float:right;font-size:<?php echo($thememanager['chat']['onlinelist']['font-size']); ?>;font-style:normal;height:450px;line-height:190%;overflow-x:hidden;overflow-y:auto;padding:5px 5px 16px;text-align:center;width:<?php echo($thememanager['chat']['onlinelist']['width']); ?>;border:<?php echo($thememanager['chat']['onlinelist']['border']); ?>}
            #myposts{border-radius: <?php echo($thememanager['chat']['chatinhalt']['border-radius']); ?>;font-size:<?php echo($thememanager['chat']['chatinhalt']['font-size']); ?>;font-family:<?php echo($thememanager['chat']['chatinhalt']['font-family']); ?>;background-image:url('<?php echo($thememanager['chat']['chatinhalt']['background-image']); ?>');background-repeat:<?php echo($thememanager['chat']['chatinhalt']['background-repeat']); ?>;background-color: <?php echo($thememanager['chat']['chatinhalt']['background-color']); ?>;height:100%;line-height:190%;overflow:auto;padding:5px 5px 16px;position:relative;border:<?php echo($thememanager['chat']['chatinhalt']['border']); ?>}
            #friends{border-radius: <?php echo($thememanager['chat']['onlinelist']['border-radius']); ?>;font-family:<?php echo($thememanager['chat']['onlinelist']['font-family']); ?>;float:left;font-size:<?php echo($thememanager['chat']['onlinelist']['font-size']); ?>;font-style:normal;height:100%;line-height:190%;margin-right:10px;overflow-x:hidden;overflow-y:auto;padding:5px 5px 16px;text-align:center;width:<?php echo($thememanager['chat']['onlinelist']['width']); ?>;border:<?php echo($thememanager['chat']['onlinelist']['border']); ?>}
			#myrequest {background-color:#2883bf;border-radius:5px;box-shadow:0 1px 0 1px #000000;fonts-color:#ffffff;border:;font-size:9pt;font-family:AGoogle;margin-right: 3px;margin-left: 3px;padding-right: 5px;padding-left: 5px;text-decoration: none;padding-bottom: 3px;padding-top: 3px;}
#autolinker {background-color:#2b79a8;border-radius:5px;box-shadow:0 1px 0 1px #000000;fonts-color:#ffffff;font-size:9pt;font-family:AGoogle;margin-top: -1px;margin-bottom: -1px;margin-left: 0px;padding-right: 5px;padding-left: 5px;text-decoration: none;}
#thedate {background-color:#B05791;border-radius:5px;box-shadow:0 1px 0 1px #000000;fonts-color:#ffffff;border:;font-size:9pt;font-family:AGoogle;margin-right: 3px;margin-left: 3px;padding-right: 5px;padding-left: 5px;text-decoration: none;padding-bottom: 3px;padding-top: 3px;}
#thetimer {background-color:#39702b;border-radius:5px;box-shadow:0 1px 0 1px #000000;fonts-color:#ffffff;border:;font-size:9pt;font-family:AGoogle;margin-right: 3px;margin-left: 3px;padding-right: 5px;padding-left: 5px;text-decoration: none;padding-bottom: 3px;padding-top: 3px;}
#fresh {background-color:#D1A333;border-radius:5px;box-shadow:0 1px 0 1px #000000;fonts-color:#ffffff;border:;font-size:9pt;font-family:AGoogle;margin-right: 3px;margin-left: 3px;padding-right: 5px;padding-left: 5px;text-decoration: none;padding-bottom: 3px;padding-top: 3px;}
#chatToggle {background-color:#2b97a8;border-radius:5px;box-shadow:0 1px 0 1px #000000;fonts-color:#ffffff;border:;font-size:9pt;font-family:AGoogle;margin-right: 3px;margin-left: 3px;padding-right: 5px;padding-left: 5px;text-decoration: none;padding-bottom: 3px;padding-top: 3px;}
#list {background-color:#723ac7;border-radius:5px;box-shadow:0 1px 0 1px #000000;fonts-color:#ffffff;border:;font-size:9pt;font-family:AGoogle;margin-right: 3px;margin-left: 3px;padding-right: 5px;padding-left: 5px;text-decoration: none;padding-bottom: 3px;padding-top: 3px;}
#rastchin {background-color:#c22e2e;border-radius:5px;box-shadow:0 1px 0 1px #000000;fonts-color:#ffffff;border:;font-size:9pt;font-family:AGoogle;margin-right: 3px;margin-left: 3px;padding-right: 5px;padding-left: 5px;text-decoration: none;padding-bottom: 3px;padding-top: 3px;}

#mahi {    font-size: 11px;    font-family: Byekan;    font-style: normal;    border-radius: 3px;    background-repeat: repeat-x;    border: 3px solid #262626;    margin-top: 20px;    color: #FFF;   background-color: #323232;    text-align: center;    direction: rtl;    height: 25px;margin-top: -40px;}
#boxforpv {	background-color: #f2f2ff;	border: 1px solid #f2f2ff;	border-radius: 10px;	margin: 0px;	min-width: atue;	overflow: hidden;	position: relative;	width: 180px;	word-wrap: break-word;	float: left;	margin: 10px 0 0;}
#replysep {	position: relative;	bottom: 30px;	left: 55px;	border-left: 3px solid #809fff;	width:90%;	word-break: break-all;	margin-top: -20px;}
#forwardBox {	display: none;	background-color: #f2f2ff;	text-align: center;	direction: rtl;	border-bottom: 2px solid green;	position: fixed;	top: 0;	width: 100%;	height: 120px;	z-index: 9999;	/*! margin-top: -10px; */margin-top: ;}
.forwardClose,.forwardLoading {	height: 25px;	position: relative;	text-align: center;	width: 25px;}
.forwardClose {	background: #809fff none repeat scroll 0 0;	border-radius: 100px;	font-size: 20px;	color: green;	cursor: pointer;	float: right;	right: 10px;}
.forwardLoading {	float: left;	left: 10px;}
.forwardSearch input {	width: 50%;	text-align: center;	height: 20px;	border: 1px solid green;}
.forwardSearch img {	width: 17px;	height: 17px;}
#forwardResult {	width: 100%;	height: 90px;	overflow: auto;}
.forwardItem {	float: right;	margin-right: 5px;	margin-top: 5px;	border: 1px solid green;	padding: 5px;	height: auto;	border-radius: 55px;}
.forwardItem:hover {	background-color: #1ED31B;	cursor: pointer;}
.forwardItem div img {	width: 45px;	height: 45px;	border-radius: 25px;	border: 2px solid #1AC5BE;}
.forwardTitle {	color: green;	margin-left: 7px;	margin-top: -2px;	position: relative;	font-size: 12px;}
.dropdown{ 	color:#000000;	position: relative; 	display: inline-block;}
.dropdown-content{    display: none;    position: absolute;    top: -10px;    left: 30px;    background-color: #a5a8ab;    border-radius: 3px;    width: 100%;    padding: 5px;    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);}
.dropdown-content a {    color: #FFF !important;    padding: 2px 2px;    text-decoration: none;    display: inline;    float: left;    font-size: 12px;    font-weight: normal;}
.dropdown-content a:last-child{    border-right: 0px;}
.dropdown a:hover {	color:black;    background-color: #807e7e80;}
.showdropdown{	display:block;}
.dropdown-content{	z-index:1;}
.dropdown-content .arrow, .dropdown-content .arrow:after {    position: absolute;    display: block;    width: 0;    height: 0;    border-color: transparent;    border-style: solid;}
.dropdown-content .arrow{    top: 12px;    left: -15px;    border-right-color: #a5a8ab;    border-left-width: 0;    border-width: 8px;}
.dropbtns {	cursor: pointer;}
.dropdowns {	color:#000000;	display: inline-block;	font-family:yekan}
.dropdown-contents {	display: none;	position: absolute;	background-color: #a5a8ab;	/*! min-width: auto; */	overflow: auto;	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);	width: 180px !important;	border-radius: 2px;}
.dropdown-contents a {	color: white !important;	padding: 12px 16px;	text-decoration: none;	display: block;}
.dropdowns a:hover {	color:black;	background-color: #898989;}
.showdropdowns {	display:block;}
.dropdown-contents {	z-index:1000;}
<?php
        $avonline = explode('*', $options['avatarOnline']);
        foreach ($avonline as $avonlines) {
            ?>
   #avataronline { height:<?php echo $avonlines ?>px; width:<?php echo $avonlines ?>px; } <?php } ?>
 .pmbox{margin-top:5px;}
<?php if ($options['msgnum_myself'] == 'true') { ?>
.msgnum_myself {
direction:rtl !important;
}
.msgnum_myself  a img  {
    width: 25px;
    border-radius: 15px;
}
.msgnum_myself  #meeno  {
display:none;
}
.msgnum_myself .mess_back {
   direction:rtl !important;
}
.msgnum_myself .mess_back b {
   display:none;
}
.msgnum_myself #box {
   direction:rtl !important;
}
.msgnum_myself #khat {
direction:rtl !important;
}
.msgnum_myself .pmbox .mess_back {
    float: right;
}
.msgnum_myself .pmbox  #box {
    float: right;
}
.msgnum_myself .pmbox  #box #khat #name{
    direction:ltr !important;
}
.msgnum_myself .pmbox  #box #khat #text{
    direction:ltr !important;
}
   .tlg {line-height: 25px; background-color: #f2f2ff !important; padding: 5px 15px !important; border-radius: 20px !important; }
   <?php } ?>
<?php if ($options['kadr_myself'] == 'true') { ?>
.tlg {line-height: 25px; background-color: #f2f2ff !important; padding: 5px 15px !important; border-radius: 20px !important; }
   <?php } ?>
<?php $avatarstyle= json_decode($options['avatarstyle'], true);?>
.avatar {
    border-radius: <?php echo($avatarstyle['border-radius']); ?>;
    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
    border: <?php echo($avatarstyle['border-size']); ?> solid <?php echo($avatarstyle['avatar-color']); ?>;
    transition: all 0.6s ease 0s;
}
.avatar:hover{border-radius:<?php echo($avatarstyle['avatar-hover']); ?>;}

#privat_anzeige {
margin-top:5px;
    font-size: 9pt;


}



 </style>
</head>
<body ondragstart="return false" draggable="false" ondragenter="event.dataTransfer.dropEffect='none'; event.stopPropagation(); event.preventDefault();" ondragover="event.dataTransfer.dropEffect='none';event.stopPropagation(); event.preventDefault();" ondrop="event.dataTransfer.dropEffect='none';event.stopPropagation(); event.preventDefault();">
<?php
theme::themeloader('chat', 'ads-bannerfix');
theme::themeloader('chat', 'code-top');
theme::themeloader('chat', 'header');
?>
<div id="rahmen_um_alles">
    <?php theme::themeloader('chat', "ads-banner-top"); ?>
<?php
if ($musicplace == 'chat') {
    $shahin_tracks = array();
    $sql->orderBy('priority', 'DESC');
    foreach ($sql->get('player') as $shahin_row) {
        $shahin_tracks[] = array('title' => $shahin_row['title'], 'mp3' => url($shahin_row['src']));
    }
    if (count($shahin_tracks) > 0) {
?>
<link rel="stylesheet" type="text/css" href="<?php echo(url('theme/player/css/player.css')); ?>">
<style type="text/css">
#shahin_musicbar{position:relative;z-index:30;clear:both;direction:ltr;width:100%;max-width:100%;margin:0 0 8px 0;padding:0;}
div#shahin_musicbar.jp-audio{width:100% !important;max-width:100% !important;}
#shahin_musicbar .jp-playlist{max-height:92px;overflow-y:auto;}
#shahin_musicbar .jp-interface{width:100%;}
</style>
<div id="shahin_jplayer" class="jp-jplayer"></div>
<div id="shahin_musicbar" class="jp-audio" role="application" aria-label="media player">
    <div class="jp-type-playlist">
        <div class="jp-gui jp-interface">
            <div class="jp-controls">
                <button class="jp-previous" role="button" tabindex="0">previous</button>
                <button class="jp-play" role="button" tabindex="0">play</button>
                <button class="jp-next" role="button" tabindex="0">next</button>
                <button class="jp-stop" role="button" tabindex="0">stop</button>
            </div>
            <div class="jp-progress">
                <div class="jp-seek-bar">
                    <div class="jp-play-bar"></div>
                </div>
            </div>
            <div class="jp-volume-controls">
                <button class="jp-mute" role="button" tabindex="0">mute</button>
                <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                </div>
            </div>
            <div class="jp-time-holder">
                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
            </div>
            <div class="jp-toggles">
                <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
            </div>
        </div>
        <div class="jp-playlist">
            <ul>
                <li>&nbsp;</li>
            </ul>
        </div>
        <div class="jp-no-solution">
            <span>برای پخش آهنگ مرورگر شما باید به‌روز باشد</span>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo(url('theme/player/js/player.js')); ?>"></script>
<script type="text/javascript" src="<?php echo(url('theme/player/js/playlist.js')); ?>"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
    new jPlayerPlaylist({
        jPlayer: "#shahin_jplayer",
        cssSelectorAncestor: "#shahin_musicbar"
    }, <?php echo(json_encode($shahin_tracks, JSON_UNESCAPED_UNICODE)); ?>, {
        supplied: "mp3",
        wmode: "window",
        useStateClassSkin: true,
        autoBlur: false,
        smoothPlayBar: true,
        keyEnabled: false
    });
});
</script>
<?php
    }
}
?>
    <div id="kopf">
        <div id="welcome">
            <b class="vbirancheshmak" style="color:<?php echo($thememanager['chat']['welcomebox']['username-color']); ?>;font-size:<?php echo($thememanager['chat']['welcomebox']['font-size']); ?>;"><?php echo(session('name')); ?> </b><font face="<?php echo($thememanager['chat']['welcomebox']['font-family']); ?>" size="3"><?php echo($options['up_box']); ?><b><a style="color:#D9C3FF;font-size: 15px;" href="/contact" target="_blank" title="تماس با مدیریت">  تماس با ما  </a><a href="/faq" style="color:#FFC733;font-size: 15px;" target="_blank" title="آموزش کار با چت روم"> | آموزش کار با چت روم</a></b></font>
        </div>
        <div id="changemod">
            <div style="float:right;"><a id="sonlinelist">لیست آنلاین ها</a><a id="spostslist">بخش اجتماعی</a><a id="reloadsocial" class="reload">به روز رسانی</a>

                    <?php if ($options['autolinker'] == 'true') { ?>
                    <a id="autolinker" href="/links" target="_blank">تبادل لینک اتوماتیک</a>
                    <?php } ?>

</div> <!-- <span style="font-size: 15px;position: relative;right: 5px;"><?php ?></span> -->
            <div style="display:none;"><a id="reloadsocial" class="reload">به روز رسانی دوستان و پروفایل ها</a><a id="schatinhalt">عمومی چت روم</a><a id="snewposts">بخش اجتماعی</a></div>
        </div>
        <div id="welcome">

            <center><spink>
                    <?php
                    $getUser = $sql->where("id", session('id'))->getOne('users', null, array('pending','cfpending'));
                    $cfpending = json_decode($getUser['cfpending'], true);
                    $pending = json_decode($getUser['pending'], true);
                    $count = count((array) $cfpending) + count((array) $pending);
                    ?>
                    <a id="myrequest" href="javascript:showmyrequest();">درخواست های شما : <?=$count;?></a>&nbsp;
                    <?php if ($options['stm'] == 'true') { ?><a id="fresh" href="javascript:document.location.reload();">رفرش کردن صفحه </a>&nbsp;<a id="list" href="#" onclick="if(this.innerHTML=='نمایش لیست چت'){document.getElementById('onlinelist').show();this.innerHTML='عدم نمایش لیست چت';}else if(this.innerHTML=='عدم نمایش لیست چت'){document.getElementById('onlinelist').hide();this.innerHTML='نمایش لیست چت';}">عدم نمایش لیست چت</a>&nbsp;
                        <a id="rastchin" href="#" onclick=" if(this.innerHTML=='چپ چین عمومی'){document.getElementById('chatinhalt').style.direction='ltr';this.innerHTML='راست چین عمومی';}else if(this.innerHTML=='راست چین عمومی'){document.getElementById('chatinhalt').style.direction='rtl';this.innerHTML='چپ چین عمومی';} ">راست چین عمومی</a>&nbsp;<a id="thetimer" class="kopf" href="#">مدت زمان حضور : <span id="timespent">00:0</span></a>

                <?php if ($options['date_time'] == 'true') { ?>
<a id="thedate" class="kopf" href="#">
<script>
week= new Array("یكشنبه","دوشنبه","سه شنبه","چهارشنبه","پنج شنبه","جمعه","شنبه")
months = new Array("فروردین","اردیبهشت","خرداد","تیر","مرداد","شهریور","مهر","آبان","آذر","دی","بهمن","اسفند");
a = new Date();
d= a.getDay();
day= a.getDate();
month = a.getMonth()+1;
year= a.getYear();
year = (year== 0)?2000:year;
(year<1000)? (year += 1900):true;
year -= ( (month < 3) || ((month == 3) && (day < 21)) )? 622:621;
switch (month) {
case 1: (day<21)? (month=10, day+=10):(month=11, day-=20); break;
case 2: (day<20)? (month=11, day+=11):(month=12, day-=19); break;
case 3: (day<21)? (month=12, day+=9):(month=1, day-=20); break;
case 4: (day<21)? (month=1, day+=11):(month=2, day-=20); break;
case 5:
case 6: (day<22)? (month-=3, day+=11):(month-=2, day-=21); break;
case 7:
case 8:
case 9: (day<23)? (month-=3, day+=9):(month-=2, day-=22); break;
case 10:(day<23)? (month=7, day+=8):(month=8, day-=22); break;
case 11:
case 12:(day<22)? (month-=3, day+=9):(month-=2, day-=21); break;
default: break;
}
document.write(" "+week[d]+" "+day+" "+months[month-1]+" "+ year);
</script> ساعت :<script>TIME = new Date();DIFF = new Date() - TIME ;INTV = window.setInterval("Show_Clock()",1000) ; function Show_Clock(){ TIME = new Date(new Date() - DIFF) ; HH = TIME.getHours() ; MM = TIME.getMinutes() ; SS = TIME.getSeconds() ; document.getElementById('CLOCK').innerHTML=((HH<10 )? "0"+HH:HH) + ":" + ((MM<10)? "0"+MM:MM) + ":" + ((SS<10)? "0"+SS:SS);}</script><span id="CLOCK"></span>
</a>
                    <?php
                }
                ?>



<a id="kopf" class="kopf" href="#"><script>window.setTimeout('getSecs()',1)</script></a><script>startday=new Date();clockStart=startday.getTime();function initStopwatch(){var myTime=new Date();return((myTime.getTime() - clockStart)/1000)}function getSecs(){var tSecs=Math.round(initStopwatch());var iSecs=tSecs % 60;var iMins=Math.round((tSecs-30)/60);var sSecs=""+((iSecs>9) ? iSecs:"0"+iSecs);var sMins=""+((iMins>9) ? iMins:"0"+iMins);document.getElementById('timespent').innerHTML=sMins+":"+sSecs;window.setTimeout('getSecs()',1000)}</script>
                    <?php } ?>
                </spink></center>


        </div>
        <?php if ($options['show_msgs'] == 'true') { ?>
            <div id="welcome">
                <div id="seemsg">
                    <input type="checkbox" id="show_msgs" onclick="show_msgs();" > عدم نمایش پیام های عمومی
                    <input type="checkbox" id="privat_msgs" onclick="privat_msgs();" <?php if(session('privat_msgs'))echo('checked');?>> عدم دریافت پیام خصوصی
                    <input type="checkbox" id="privat_Perm" onclick="privat_Perm();" <?php if(session('privat_perm')=="close")echo('checked');?>> ورود به خصوصی با تایید شما
                    <input type="checkbox" id="privat_photo" onclick="privat_photo();" <?php if(session('status_photo') == "false")echo('checked');?>> عدم دریافت عکس در خصوصی
                    <input type="checkbox" id="privat_file" onclick="privat_file();" <?php if(session('privat_file') == "false")echo('checked');?>> عدم دریافت فایل در عمومی
                </div>
            </div>
        <?php } ?>
        <div id="onlinelist"><img src="<?php echo(theme::url('theme/images/chat/chat.ajax-loader.gif')); ?>" alt="در حال بارگذاری....." /></div>
        <div id="postslist" style="display:none;"><div id="offmsg"></div></div>
        <div id="splitpane">
        </div>
        <div id="chatinhalt"><div id="pinmsg"></div></div>
        <div id="social" style="display:none;">
            <div id="friends"><span class="fon">دوستان آنلاین</span><div id="friends-on"></div><span class="fof">دوستان آفلاین</span><div id="friends-off"></div></div>
            <div id="myposts"><div class="desc"><span style="color:#ff4040;">پست های من</span> ، <span style="color:#009EFF;">پست های دوستان</span> ، <span style="color:#0F9A0E;">پست های دنبال شدگان</span></div><div id="getposts"></div></div>
        </div>
        <div id="clear"></div>
        <?php if ($options['linkdooni'] == 'true') { ?>
            <div class="linkdooni" id="linkdooni">
                <marquee  onMouseOver="this.setAttribute('scrollamount', 0, 0);this.stop();" OnMouseOut="this.setAttribute('scrollamount', 2, 0);this.start();" scrolldelay="70" scrollamount="2" direction="right">
                    <?php
                    $sql->where('active', 1);
                    foreach($sql->get('links', null, array('id', 'click', 'title')) as $links){
                        ?>
                        &nbsp;<a href="<?php echo(url("link/{$links['id']}")); ?>" target="_blank" class="mainlinks" title="[ <?php echo($links['click']); ?> بار مشاهده شده ]"><?php echo($links['title']); ?></a> &nbsp;&nbsp;<span style="color: <?php echo($thememanager['chat']['linkdooni']['space-textcolor']); ?>;font-weight:bold"><?php echo($options['spacetext']); ?></span>&nbsp;&nbsp;
                        <?php
                    }
                    ?>
                </marquee>
            </div> <?php } ?>
        <div id="form">
            <form id="message_form" style="display:inline;" action="javascript:;">
                <div id="form_left">
                    <div id="privat_anzeige"><center><?php echo($options['down_box']); ?></center></div>
                    <input type="hidden" name="fontname" id="fontname" value="<?php echo session('fontname') != null ? session('fontname') : $options['chat_defaultfontname']; ?>" />
                    <input type="hidden" name="fontsize" id="fontsize" value="<?php echo session('fontsize') != null ? session('fontsize') : $options['chat_defaultfontsize']; ?>" />
                    <input type="hidden" name="room" id="room" value="1">
                    <input type="hidden" name="privat" id="privat" value="">
                    <input type="hidden" name="bold" id="bold" value="<?php echo session('bold') == 'bold' ? 'bold' : 'normal'; ?>" >
                    <input type="hidden" name="italic" id="italic" value="<?php echo session('italic') == 'italic' ? 'italic' : 'normal'; ?>" >
                    <input type="hidden" name="color" id="color" value="#<?php echo session('color') != null ? session('color') : $options['chat_defaultcolor']; ?>" >
                    <input onfocus="this.className = 'focus';" class="input_class" name="message" id="message" type="text" placeholder="<?php echo($options['omomi_fild']); ?>" style="font-family:<?php echo session('fontname') != null ? session('fontname') : $options['chat_defaultfontname']; ?>;direction:rtl;width:520px;height:22px;font-size: <?php echo session('fontsize') != null ? session('fontsize') : $options['chat_defaultfontsize']; ?>;font-style: <?php echo session('italic') == 'italic' ? 'italic' : 'normal'; ?>;font-weight: <?php echo session('bold') == 'bold' ? 'bold' : 'normal'; ?>;color: #<?php echo session('color') != null ? session('color') : $options['chat_defaultcolor']; ?>;" maxlength="200" ondragenter="event.dataTransfer.dropEffect='none'; event.stopPropagation(); event.preventDefault();" ondragover="event.dataTransfer.dropEffect='none';event.stopPropagation(); event.preventDefault();" ondragstart="return false" draggable="false" ondrop="event.dataTransfer.dropEffect = 'none';event.stopPropagation();event.preventDefault();"><?php if (chatroom::checkPermission('voicesend')) { ?>
                    <style type="text/css">#form_left{white-space:nowrap}#voice_box{float:left;width:36px;margin:0;padding:0;text-align:center;white-space:nowrap}@media screen and (min-width:621px){#message{width:482px !important}}</style>
                    <span id="voice_box" style="white-space:nowrap;">
                        <input type="hidden" id="voice_url" value="<?php echo(url('ajax/upvoice')); ?>" />
                        <button type="button" id="voice_btn" onclick="return voiceRecOpenPopup();" title="ضبط و ارسال ویس" style="width:26px;height:26px;line-height:24px;padding:0;margin:0;overflow:hidden;border:0;border-radius:50%;background:#3f7edb;color:#fff;cursor:pointer;font-size:14px;vertical-align:middle;">&#127908;</button>
                        <span id="voice_btn_status" style="display:none;font-size:11px;color:#fff;background:#333;padding:2px 6px;border-radius:4px;vertical-align:middle;"></span>
                    </span>
                    <?php } ?>
                </div>
                <div id="form_right"></div>

            </form>
        </div>
    </div>
</div>
<?php if ($options['chatnews'] == 'true') { ?>
    <?php if (chatroom::checkPermission('chat_news')) { ?>
        <div class="newsTarhPardaz">
            <script type="text/javascript">var theSummaries = new Array();
                <?php
                $sql->where('active', 1); $i=0;
                foreach($sql->get('news', null, array('id', 'text')) as $row){
                ?>
                theSummaries[<?php echo $i; ?>] = '<?php echo $row['text']; ?>';
                    <?php $i++;
                    }
                    ?>var theSiteLinks = new Array();
            </script>
            <div style="text-align:center;direction:rtl;margin-top:3px;"><div class="MyTicker"><span id="theTicker">&nbsp;</span></div>
                <script type="text/javascript" src="<?php echo(url('theme/js/news.js')); ?>"></script>
                <script type="text/javascript">function startTicker() {
                        return theCurrentStory = -1, theCurrentLength = 0, document.getElementById ? void runTheTicker() : (document.write("<style> .ticki{display:none; direction:rtl; }.ticko{border:0px; padding:0px; direction:rtl;}</style>"), !0)}function runTheTicker() {
                        var t;
                        0 === theCurrentLength && (theCurrentStory++, theCurrentStory %= theItemCount, theStorySummary = theSummaries[theCurrentStory], theTargetLink = theSiteLinks[theCurrentStory]);
                        var e = theStorySummary.substring(0, theCurrentLength) + whatWidget();
                        theTargetLink ? NS6 ? document.getElementById("theTicker").innerHTML = '<a target="_self" style="font-size:14px; color:white; text-decoration:none;" href="' + theTargetLink + '" target="_top">' + e + "</a>" : document.all.theTicker.innerHTML = '<a target="_self" style="text - decoration:none; font - size:14px; color:white" href="' + theTargetLink + '" target="_top">' + e + " </a>" : NS6 ? document.getElementById("theTicker").innerHTML = '<span style = "text-decoration:none; font-weight:bold; font-size:14px; color:white;" > ' + e + "</span>" : document.all.theTicker.innerHTML = '<span style = "text-decoration:none; font-size:14px; font-weight:bold; color:white;" > ' + e + "</span>", theCurrentLength !== theStorySummary.length ? (theCurrentLength++, t = theCharacterTimeout) : (theCurrentLength = 0, t = theStoryTimeout), setTimeout("runTheTicker()", t)}function whatWidget() {
                        return theCurrentLength === theStorySummary.length ? theWidgetNone : theCurrentLength % 2 === 1 ? theWidgetOne : theWidgetTwo
                    }
                    var theCharacterTimeout = 60, theStoryTimeout = 4e3, theWidgetOne = "_", theWidgetTwo = "-", theWidgetNone = "", theItemCount = theSummaries.length, NS6 = document.getElementById && !document.all ? !0 : falsestartTicker();</script>
            </div>
        </div>
        <br>
        <br>
    <?php } ?>
<?php } ?>
<?php theme::themeloader('chat', "ads-banner-bottom"); ?>
<?php theme::themeloader('chat', "code-bottom"); ?>
<?php if ($options['box3'] == 'true') { ?>
    <center>
        <div align="center">
            <table border="0" width="100">
                <td>
                    <iframe src="<?php echo(url('compile/ranking')); ?>" style="border: 0px;" frameborder="0" height="248" scrolling="no" width="294"></iframe>
                </td>
                <td>
                    <div align="center">
                        <table border="0" style="color:white !important; width:288px;height:241px" background="<?php echo(url('theme/images/chat/bodd.jpg')); ?>">
                            <tr>
                                <td>
                                    <div class="menu">
                                        <div class="text-menu">
                                            <p align="center">
                                                <a style="color:white !important;" target="_blank" href="<?php echo(url('links')); ?>"><span style="text-decoration: none;color:white !important; font-weight: 700">لینک خود را ثبت کنید</span></a>
                                            </p>
                                        </div>
                                    </div>
                                    <p align="center" style="text-align: center;color:#fff;direction: rtl;color:white !important; ">
                                        <marquee trueSpeed scrollAmount="2" direction="up" height="150" align="middle" width="220" style="font-family: Tahoma;color:white !important; font-size: 10pt; background-color:#000000">
                                            <center>
                                                <?php
                                                $sql->where('active', 1);
                                                foreach($sql->get('links', null, array('id', 'click', 'title')) as $links){
                                                    ?>
                                                    &nbsp;<a style="color:#afe979 !important;" href="<?php echo(url("link/{$links['id']}")); ?>" target="_blank" style="font-family:<?php echo($thememanager['chat']['linkdooni']['font-family']); ?>;" class="mainlinks" title="[ <?php echo($links['click']); ?> بار مشاهده شده ]" ><?php echo($links['title']); ?></a><br> <br>&nbsp;&nbsp;<span style="color:#ffffff;font-weight:bold"><?php echo($options['spacetext']); ?><br><br></span>&nbsp;&nbsp;
                                                    <?php
                                                }
                                                ?>
                                            </center>
                                        </marquee>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </table>
        </div>
    </center>
    <?php
} else if ($options['showPlayer'] == 'true') {
    ?>
    <div id="cp_old_slot" style="display:none;text-align:center">
        <iframe src="<?php echo(url('player')); ?>" style="border:0px;width:351px;height:auto;" frameborder="0" scrolling="no"></iframe>
    </div>
    <script>setTimeout(function(){var s=document.getElementById("cp_old_slot");if(s&&s.children.length)s.style.display="block";},2000);</script>
    <?php
}
?>
</body>
</html>
<?php $pmwlc = json_decode($options['pmwlc'], true); ?>
<?php if ($pmwlc['wlcchat'] == 'true') {
    include ("pages/wlcchat.php");
} ?>
