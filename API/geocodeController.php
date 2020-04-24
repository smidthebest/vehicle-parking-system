<?php
require_once "Request.php"; 
require_once "cache.php"; 

$cache = top_cache(); 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

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

if(isset($cache)){
    bottom_cache($cache); 
} 
?>

