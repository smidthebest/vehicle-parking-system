<?php
require "Request.php"; 
include("cacheController/top-cache.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){
    $name = $_GET["term"]; //what needs to be autocompleted by API
    $lat = $_GET["lat"]; //latitude of the center of map for biasing results
    $long = $_GET["long"]; //longitude of the center of map for biasing results 

    if(!isset($name) or !isset($lat) or !isset($long)){
        header("HTTP/1.1 404 Not Found"); 
        exit(); 
    }

    $data = array(
        "input" => $name, 
        "types" => "address",
        "location" => "$lat,$long",
        "radius" => 500, 
        "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"
    ); 
}

if(!isset($data)){
    header("HTTP/1.1 404 Not Found"); 
    exit(); 
}

$request = new Request("auto", $data, $requestMethod);
$request->processRequest(); 

include("cacheController/bottom-cache.php"); 
?>
