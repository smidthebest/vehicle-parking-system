<?php namespace App\Controllers;
session_start(); 
use CodeIgniter\RESTful\ResourceController;
class Home extends ResourceController
{
	public function index()
	{

		

		if(!isset($_SESSION["email"])){
			// print_r($_SESSION); 
			// return; 
			header("Location: ".base_url()."/signin"); 
			exit();  
			// return view('index');
		}

		else return view('index');
	}


	//--------------------------------------------------------------------

}
