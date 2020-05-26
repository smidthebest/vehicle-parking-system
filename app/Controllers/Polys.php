<?php namespace App\Controllers;
session_start(); 
use App\Models\PolysModel;
use CodeIgniter\Controller;


class Polys extends Controller
{
    public function saveFence(){
        $poly = $this->request->getVar("polygon"); 

        $model = new PolysModel(); 
        $count = 0; 
        $polys = ""; 
        foreach ($poly as $item) {
            $polys .= $item[0].' '.$item[1].', '; 
            $count =  $count +1; 
        }
        $polys .= $poly[0][0].' '.$poly[0][1]; 

        // $model->builder()->insert([
        //     'email' => $_SESSION["email"], 
        //     'polygon' => 'ST_GeomFromText(\'Polygon(('.$polys.'))\')', 
        //     'date' => 'current_timestamp', 
        //     'id' => 'default'
        // ]); 

         echo json_encode($model->addPoly($_SESSION["email"], "ST_GeomFromText('Polygon(($polys))')")); 

        // echo json_encode([
        //     'email' => $_SESSION["email"], 
        //     'polygon' => 'ST_GeomFromText(\'Polygon(('.$polys.'))\')', 
        //     'date' => 'current_timestamp', 
        //     'id' => 'default'
        // ]); 
        

    }
}
?>