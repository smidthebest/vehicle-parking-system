<?php
$url = $_SERVER["REQUEST_URI"];
$break = Explode('?', $url);
$file = Explode('&', $break[1]);
$ans = Explode('.', $file[0])[0]."-".Explode('.', $file[1])[0].$file[2]; 
$cachefile = 'cache/cached-'.$ans.'.json';
$cachetime = 2.592*pow(10,6);
// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
    readfile($cachefile);
    exit;
}
ob_start(); // Start the output buffer
?>