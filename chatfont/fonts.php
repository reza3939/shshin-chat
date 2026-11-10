<?php

header("Content-type: text/css");
$sql->orderBy('id', 'DESC');
$fonturl = 'theme/chatfont/';
foreach($sql->get('chatfonts') as $fonts){
    echo("@font-face {");
    echo("font-family:");
    echo("dcfont-" . $fonts['id'] . ";");
    echo("src:url(");
    echo($fonturl . $fonts['id'] . ".eot?#" . ")");
    echo("format('eot'),");
    echo("url(");
    echo($fonturl . $fonts['id'] . ".woff" . ")");
    echo("format('woff'),");
    echo("url(");
    echo($fonturl . $fonts['id'] . ".ttf" . ")");
    echo("format('truetype')");
    echo(";font-weight: normal;");
    echo("font-style: normal;");
    echo("}");
}
?>