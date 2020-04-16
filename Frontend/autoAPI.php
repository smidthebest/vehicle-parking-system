<?php
header("Content-Type: application/json"); 
$name = $_GET["loc"]; 
echo "hellp"; 
$url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?"; 
$data = array("input" => "Gurg", "types" => "address", "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"); 

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
echo $result; 



?>
