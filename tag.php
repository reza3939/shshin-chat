<?php
$tag = safe::number(giu('el2'));
$query = db::query("SELECT * FROM {prefix}tags WHERE `id`='$tag'");
if(mysqli_num_rows($query)>0){
$tags = mysqli_fetch_array($query);
$options['chat_site_title'] = $tags['title'];
$options['chat_description'] = $tags['dec'];
$options['chat_keywords'] = $tags['key'];
include("theme/{$tags['theme']}/login.php");
}else{
Header( "HTTP/1.1 301 Moved Permanently" ); 
header::Go(url());	
}
?>