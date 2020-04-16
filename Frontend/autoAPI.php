<?php

$name = $_GET["loc"]; 
echo $name; 
$url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?"; 
$data = array("input" => "Gurg", "types" => "address", "key" => "AIzaSyDmpN-plRNCFrhIRCBNKjvfGuRASDK4EOg"); 

$options = array(
    'http' => array(
        'method' => "POST", 
        'content' => http_build_query($data)
    ),
    "ssl" => [
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ]
); 

$context = stream_context_create($options); 

$result = file_get_contents($url, false, $context); 
echo $result; 


?>
