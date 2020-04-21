<?php
$url = $_SERVER["REQUEST_URI"];
$break = Explode('?', $url);
$file = $break[1];
$cachefile = 'cache/cached-'.$file.'.html';
$cachetime = 18000;
// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
   
    readfile($cachefile);
    exit;
}
ob_start(); // Start the output buffer
?>