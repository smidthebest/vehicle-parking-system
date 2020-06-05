<?php namespace App\Models;

use CodeIgniter\Model;

class PolysModel extends Model
{
    
    protected $table = "public.\"Polys\""; 
    protected $allowedFields = ['email', 'polygon', 'date', 'id', 'name', 'description']; 
    protected $primaryKey = 'id'; 
    protected $return_type = 'array'; 


    public function addPoly($email, $polys, $name, $des ){
        $db = \Config\Database::connect();
        $query = $db->query("INSERT INTO public.\"Polys\" (email, polygon, date, id, name, description ) VALUES ('$email', $polys, current_timestamp, default, '$name', '$des')"); 
        return $query; 
    }

    public function getPolys($email){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT ST_AsText(polygon), id, name, description, date FROM public.\"Polys\" WHERE email ='$email'")->getResult('array'); 
        return $query; 
    }

    public function updatePoly($id, $polys, $name, $des){
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE public.\"Polys\" SET polygon = $polys, name = '$name', description = '$des', date = current_timestamp WHERE id = $id"); 
        return $query; 
    }
}


?>