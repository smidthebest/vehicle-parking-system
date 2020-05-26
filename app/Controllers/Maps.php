<?php namespace App\Controllers;

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

    //app/Models/Path.Drag.js
    public function polydrag(){
       
        header("HTTP/1.1 200 OK");
        $file = fopen("../app/Models/Path.Drag.js", "r"); 
        $ans = fread($file, filesize("../app/Models/Path.Drag.js")); 
        fclose($file);
        return $ans; 
    }

	//--------------------------------------------------------------------

}
