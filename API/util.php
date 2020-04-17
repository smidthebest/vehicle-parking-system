<?php

//returns json data from url. 
function get_from_link($url){
   $curl = curl_init($url); 
   
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
    curl_setopt($curl, CURLOPT_CAINFO, 'cacert.pem');

   $output = curl_exec($curl);
   
   curl_close($curl);
    
   return $output; 
}

?>