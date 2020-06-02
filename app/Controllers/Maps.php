<?php namespace App\Controllers;
session_start(); 
use CodeIgniter\RESTful\ResourceController;
use App\Models\APIRequest;

class Maps extends ResourceController
{
    protected $format = 'json'; 

	public function index()
	{
        if(!isset($_SESSION["email"])) return view('signin'); 
		return view('welcome');
    }
    
    public function autocomplete($term = "", $lat = null, $lng = null){
        
        
       $term= str_replace('%20', " ", $term) ; 
        $data = array(
            "input" => $term, 
            "types" => "address",
            "location" => "$lat,$lng",
            "radius" => 500, 
            "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"
        ); 

       
        $model = new APIRequest("auto", $data, "GET"); 
        $res = $model->processRequest() ;
        
        return $this->respond($res); 
    }

    public function geocode($term = ""){
        $term= str_replace('%20', " ", $term) ; 
        $data = array(
            "address" => $term, 
            "key" => "AIzaSyCZRvqG4MqNFZRQH62bwcHuANO_1MqHCio"
        );

        $model = new APIRequest("geocode", $data, "GET"); 

        $res = $model->processRequest(); 
       
        return $this->respond($res); 
    }


	//--------------------------------------------------------------------

}
