<?php
require_once "util.php"; 

class Request{

    private $type; //which api to make call to. 
    private $data; //data to be sent to api. 
    private $requestMethod; 
    private const AUTO_STRING = "https://maps.googleapis.com/maps/api/place/autocomplete/json?"; 
    private const GEOCODE_STRING = "https://maps.googleapis.com/maps/api/geocode/json?"; 

    public function __construct($type, $data, $requestMethod){
        $this->type = $type; 
        $this->data = $data; 
        $this->requestMethod = $requestMethod; 
    }

    public function processRequest(){

        switch($this->requestMethod){
            case 'GET':
                $response = $this->getData(); 
                break; 
            default: 
                $response = $this->notFoundResponse(); 
        }

        header($response['status_code_header']); 
        if($response['body']){
           
            echo $response['body']; 
        }
    }

    //sends request to api and filters to the appropriate data that the client requested. 
    private function getData(){
         
        if($this->type == "auto"){
            $result = get_from_link(self::AUTO_STRING.http_build_query($this->data)); 
            $array_names = json_decode($result, true); 

            if(!isset($array_names)){
                $this->serverSideError(); 
            }
            $ans = array(); 

            foreach($array_names["predictions"] as $key => $value){
                array_push($ans, $value["description"]); 
            }
             
            $response['status_code_header'] = 'HTTP/1.1 200 OK'; 
            $response['body'] = json_encode($ans); 
            return $response; 
        }
        else if($this->type == "geocode"){
            $result = get_from_link(self::GEOCODE_STRING.http_build_query($this->data)); 
            $array = json_decode($result, true); 
            if(!isset($array)){
                $this->serverSideError(); 
            }
            $response['status_code_header'] = 'HTTP/1.1 200 OK'; 
            $response['body'] = json_encode( $array["results"][0]["geometry"]["location"]); 
            
            return $response; 
        }
    }

    private function serverSideError(){
        $resposne['status_code_header'] = 'HTTP/1.1 500 Internet Server Error'; 
        $response['body'] = null; 
        return $response; 
    }

    //If a call is made that the api is not designed to handle, 404 code is sent out. 
    private function notFoundResponse(){
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}

?>