<?php
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
    "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"); 

$options = array(
    // 'http' => array(
    //     'method' => "POST", 
    //     'content' => http_build_query($data)
    // ),
    "ssl" => array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    )
); 

$context = stream_context_create($options); 

//$result = file_get_contents($url, false, $)
$result = file_get_contents($url.http_build_query($data), false, $context); 

$array_names = json_decode($result, true); 
$ans = array(); 
foreach($array_names["predictions"] as $key => $value){
    array_push($ans, $value["description"]); 
}

echo json_encode($ans); 


?>
