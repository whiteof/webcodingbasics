<?php 
$path='/var/www/html/video.webcodingbasics.com/intro.mp4';
header('Content-type: video/mp4');    
header('Content-Length: '.filesize($path)); // provide file size    
readfile($path);
?>