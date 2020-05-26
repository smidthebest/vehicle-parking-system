<?php namespace App\Models;

use CodeIgniter\Model;

class PolysModel extends Model
{
    
    protected $table = "public.\"Polys\""; 
    protected $allowedFields = ['email', 'polygon', 'date', 'id']; 
    protected $primaryKey = 'id'; 
    protected $return_type = 'array'; 


    public function addPoly($email, $polys ){
        $db = \Config\Database::connect();
        $query = $db->query("INSERT INTO public.\"Polys\" (email, polygon, date, id) VALUES ('$email', $polys, current_timestamp, default)"); 
        return "INSERT INTO public.\"Polys\" (email, polygon, date, id) VALUES ('$email', $polys, current_timestamp, default)"; 


    }
}


?>