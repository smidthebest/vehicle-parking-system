<?php
require "util.php"; 
$loc = $_GET['address']; 
$url = "https://maps.googleapis.com/maps/api/geocode/json?";

$data = array(
    "address" => $loc, 
    "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"
);


$result = get_from_link($url.http_build_query($data)); 

 $array = json_decode($result, true); 
 $ans = $array["results"][0]["geometry"]["location"]; 

 echo json_encode($ans); 
?>
