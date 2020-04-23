<?php
require "Request.php"; 
include("cacheController/top-cache.php"); 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){
    $loc = $_GET['address']; 
    $data = array(
        "address" => $loc, 
        "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"
    );
}
 
$request = new Request("geocode", $data, $requestMethod); 
$request->processRequest(); 

include("cacheController/bottom-cache.php"); 
?>

