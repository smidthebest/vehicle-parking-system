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
			$this->setValues();
			if($_SESSION["preload"][1] == false) {
				unset($_SESSION["preload"]); 
			}
			else{
				$_SESSION["preload"][1] = false; 
			}

			//var_dump( $_SESSION); 
			//return view('index');

		}
	}

	public function dash(){
		if(!isset($_SESSION["email"])){
			header("Location: ".base_url()."/signin"); 
			exit();  
		}
		else {
			$this->setValues(); 
			return view('dash');
		}
	}

	public function trans($num){
		$_SESSION["preload"] = [$num, true];
		header("Location: ".base_url()."/"); 
		exit(); 

	}

	private function setValues(){
		$model = new PolysModel();
		$data = [];  
		$polys = $model->getPolys($_SESSION["email"]); 
		$ids = []; 
		$names = []; 
		$descrips = []; 
		$dates = [];  
		$tags = []; 
		foreach ($polys as $row) {
			$temp = explode(",", substr(substr($row["st_astext"], 9), 0,  -2)); 
			array_push($ids, $row["id"]); 
			array_push($data, $temp); 
			array_push($names, $row["name"]); 
			array_push($descrips, $row["description"]); 
			array_push($dates, date("g:i A m-d-y", strtotime($row["date"])) ); 
			echo $rows["tags"]; 
			array_push($tags, $rows["tags"]); 
		}

		$_SESSION["polys"] = $data; 
		$_SESSION["ids"] = $ids; 
		$_SESSION["names"] = $names; 
		$_SESSION["des"] = $descrips; 
		$_SESSION["dates"] = $dates; 
		$_SESSION["tags"] = $tags; 
	}


	//--------------------------------------------------------------------

}
