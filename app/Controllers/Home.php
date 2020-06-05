<?php namespace App\Controllers;
session_start(); 
use App\Models\PolysModel;
use CodeIgniter\Controller;

class Home extends Controller
{
	public function index()
	{
		if(!isset($_SESSION["email"])){

			header("Location: ".base_url()."/signin"); 
			exit();  
		}

		else {

			$model = new PolysModel();
			$data = [];  
			$polys = $model->getPolys($_SESSION["email"]); 
			$ids = []; 
			$names = []; 
			$descrips = []; 
			$dates = []; 
			foreach ($polys as $row) {
				$temp = explode(",", substr(substr($row["st_astext"], 9), 0,  -2)); 
				array_push($ids, $row["id"]); 
				array_push($data, $temp); 
				array_push($names, $row["name"]); 
				array_push($descrips, $row["description"]); 
				array_push($dates, date("Y-m-d", strtotime($row["date"])) ); 
			 }

			 $_SESSION["polys"] = $data; 
			 $_SESSION["ids"] = $ids; 
			 $_SESSION["names"] = $names; 
			 $_SESSION["des"] = $descrips; 
			 $_SESSION["dates"] = $dates; 

			//var_dump($_SESSION); 
			return view('index');

		}
	}


	//--------------------------------------------------------------------

}
