<?php

function get_from_link($url){
    $options = array(
        "ssl" => array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        )
    ); 

    $context = stream_context_create($options); 
    $result = file_get_contents($url, false, $context); 

    return $result; 
}

?>