<?php namespace App\Controllers;
 session_start(); 
use App\Models\UsersModel;
use CodeIgniter\Controller;


class Accounts extends Controller
{
    protected $session;
    
	public function signin()
	{
        session_unset(); 
        session_destroy(); 
		return view('signin');
    }
    
    public function signup(){
        session_unset(); 
        session_destroy(); 
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
        session_regenerate_id(true);
        $this->session = \Config\Services::session(); 
        $_SESSION["email"] = $email; 
        $_SESSION["fName"] = $fName; 
        $_SESSION["sName"] = $sName; 
        echo json_encode($_SESSION); 
        return; 

   }

   public function checkUser(){
    $email = $this->request->getVar("email"); 
    $pass = $this->request->getVar("pass"); 

    $model = new UsersModel(); 
    $check = $model->find($email); 
   
    
    if($check["pass"] == $pass) {
      
       $_SESSION["email"] = $email; 
       $_SESSION["fName"] = $check["fname"]; 
       $_SESSION["sName"] = $check["sname"]; 
       echo (json_encode($_SESSION)); 
       session_regenerate_id(true);

        return; 
    } 
    else{
        echo (json_encode("false")); 
        return; 
    }

   }

   
	//--------------------------------------------------------------------

}
