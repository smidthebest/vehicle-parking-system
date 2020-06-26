<?php namespace App\Models;

use CodeIgniter\Model;

class PolysModel extends Model
{
    
    protected $table = "public.\"Polys\""; 
    protected $allowedFields = ['email', 'polygon', 'date', 'id', 'name', 'description', 'tags']; 
    protected $primaryKey = 'id'; 
    protected $return_type = 'array'; 


    public function addPoly($email, $polys, $name, $des, $tags ){
        $db = \Config\Database::connect();
        $data = "{"; 
        $num = 0; 
        foreach($tags as $row){
            if($num == 0){
                $data .= "\"$row\"";
            }
            else{
                $data .= ",\"$row\" "; 
            }
            $num = $num +1; 
            
        }
        $data .= "}"; 
        $query = $db->query("INSERT INTO public.\"Polys\" (email, polygon, date, id, name, description, tags ) VALUES ('$email', $polys, current_timestamp, default, '$name', '$des', '$data' )"); 
        return "INSERT INTO public.\"Polys\" (email, polygon, date, id, name, description, tags ) VALUES ('$email', $polys, current_timestamp, default, '$name', '$des', '$data')"; 
    }

    public function getPolys($email){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT ST_AsText(polygon), id, name, description, date, tags FROM public.\"Polys\" WHERE email ='$email' ORDER BY name")->getResult('array'); 
        return $query; 
    }

    public function updatePoly($id, $polys, $name, $des){
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE public.\"Polys\" SET polygon = $polys, name = '$name', description = '$des', date = current_timestamp WHERE id = $id"); 
        return $query; 
    }

}


?>