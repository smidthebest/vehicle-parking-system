<?php namespace App\Controllers;
 session_start(); 
use App\Models\UsersModel;
use CodeIgniter\Controller;


class Accounts extends Controller
{

    public function __construct(){
        // echo "hello";   
        // Parent::__construct(); 
        // $this->load->model("UsersModel"); 
    }
    
	public function signin()
	{
		return view('signin');
    }
    
    public function signup(){
        return view('signup'); 
    }

   public function addUser(){
        $email = $this->request->getVar("email"); 
        $pass = $this->request->getVar("pass"); 
        $fName = $this->request->getVar("fname"); 
        $sName = $this->request->getVar("sname"); 

        $model =  new UsersModel(); 
  

        if($model->find($email) != null){
            echo json_encode("false"); 
            return; 
        }

        $model->insert([
            'email' => $email, 
            'pass' => $pass, 
            'fname' => $fName, 
            'sname' => $sName
        ]); 

        header("200 OK"); 
        echo json_encode(true); 
       
        $_SESSION["email"] = $email; 
        return; 

   }

   public function checkUser(){
    $email = $this->request->getVar("email"); 
    $pass = $this->request->getVar("pass"); 

    $model = new UsersModel(); 
    $check = $model->find($email); 
   
    
    if($check["pass"] == $pass) {
      
       $_SESSION["email"] = $email; 
       echo (json_encode($_SESSION["email"])); 
        return; 
    } 
    else{
        echo (json_encode("false")); 
        return; 
    }

   }

   
	//--------------------------------------------------------------------

}
