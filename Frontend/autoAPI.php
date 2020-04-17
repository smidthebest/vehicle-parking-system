<?php
require "util.php"; 

header("Content-Type: application/json"); 
$name = $_GET["term"]; 
$lat = $_GET["lat"];
$long = $_GET["long"]; 
$url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?"; 
$data = array(
    "input" => $name, 
    "types" => "address",
     "location" => "$lat,$long",
     "radius" => 500, 
    "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"
); 

$result = get_from_link($url.http_build_query($data)); 

$array_names = json_decode($result, true); 
$ans = array(); 
foreach($array_names["predictions"] as $key => $value){
    array_push($ans, $value["description"]); 
}

echo json_encode($ans); 


?>
