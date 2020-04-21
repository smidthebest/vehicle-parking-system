<?php
require "util.php"; 
$loc = $_GET['address']; 
header("Content-Type: application/json"); 
$url = "https://maps.googleapis.com/maps/api/geocode/json?";

$data = array(
    "address" => $loc, 
    "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"
);


$result = get_from_link($url.http_build_query($data)); 

 $array = json_decode($result, true); 
 echo json_encode( $array["results"][0]["geometry"]["location"]); 

?>

