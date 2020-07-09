<?php namespace App\Controllers;
session_start(); 
use App\Models\PolysModel;
use CodeIgniter\Controller;


class Polys extends Controller
{
    public function saveFence(){
        
        $poly = $this->request->getVar("polygon");
        $id = $this->request->getVar("id");  
        $name = $this->request->getVar("name"); 
        $des = $this->request->getVar("descrip"); 
        $tags = explode(",", $this->request->getVar("tags")); 
        $json = $this->request->getVar("json"); 

        if(trim($json) == ""){
            $json = "{}"; 
        }

        $model = new PolysModel(); 
        $count = 0; 
        $polys = ""; 
        foreach ($poly as $item) {
            $polys .= $item[0].' '.$item[1].', '; 
            $count =  $count +1; 
        }
        $polys .= $poly[0][0].' '.$poly[0][1]; 

        $result = "tue"; 
        if($id == -1){
            $result = $model->addPoly($_SESSION["email"], "ST_GeomFromText('Polygon(($polys))')", $name, $des, $tags, $json);
        } 
        else {
            $result = $model->updatePoly($id, "ST_GeomFromText('Polygon(($polys))')", $name, $des, $tags, $json); 
        }
    
        echo json_encode($result); 
        

    }

    public function deletePoly(){
        $id = $this->request->getVar("id"); 
        $model = new PolysModel(); 

        $model->delete($id); 

        return json_encode("true"); 
    }
}
?>