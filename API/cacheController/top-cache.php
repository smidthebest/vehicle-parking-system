<?php
require "cache.php"; 

$url = $_SERVER["REQUEST_URI"];
$cache = new Cache($url); 

if($cache->getCache()){
    exit;
}
else {
    ob_start(); // Start the output buffer
}

?>