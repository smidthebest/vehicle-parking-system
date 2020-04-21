<?php
require "util.php"; 
include("top-cache.php");
header("Content-Type: application/json"); 
$name = $_GET["term"]; //what needs to be autocompleted by API
$lat = $_GET["lat"]; //latitude of the center of map for biasing results
$long = $_GET["long"]; //longitude of the center of map for biasing results 
$url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?"; 

$data = array(
    "input" => $name, 
    "types" => "address",
     "location" => "$lat,$long",
     "radius" => 500, 
    "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"
); 

//gets json data from places API 
$result = get_from_link($url.http_build_query($data)); 

//decodes json to filter out irrelevatn information and return the location 
// addresses. 
$array_names = json_decode($result, true); 
$ans = array(); 
foreach($array_names["predictions"] as $key => $value){
    array_push($ans, $value["description"]); 
}

echo json_encode($ans); 

include("bottom-cache.php"); 
?>
