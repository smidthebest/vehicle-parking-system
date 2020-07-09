<?php namespace App\Models;

use CodeIgniter\Model;

class PolysModel extends Model
{
    
    protected $table = "public.\"Polys\""; 
    protected $allowedFields = ['email', 'polygon', 'date', 'id', 'name', 'description', 'tags', 'info']; 
    protected $primaryKey = 'id'; 
    protected $return_type = 'array'; 


    public function addPoly($email, $polys, $name, $des, $tags, $json = "{}" ){
        try {
            $db = \Config\Database::connect();
            $data = $this->preProcessTags($tags); 
            // $query =  $db->query("INSERT INTO public.\"Polys\" (email, polygon, date, id, name, description, tags, info ) VALUES ('$email', $polys, current_timestamp, default, '$name', '$des', '$data', '$json' )"); 
            $query = $db->simpleQuery("INSERT INTO public.\"Polys\" (email, polygon, date, id, name, description, tags, info ) VALUES ('$email', $polys, current_timestamp, default, '$name', '$des', '$data', '$json' )"); 
            if($query){
                $res = "Success!"; 
            }
            else {
                // log_message("error", "query error!"); 
                $error = $db->error(); 
                // $res = $error["message"]; 
                if(strpos($error["message"], "json") === false){
                    $res = "Query Error"; 
                }
                else {
                    $res = "JSON Error"; 
                }
            }
        }
        catch (\Throwable $th) {
            // log_message("error", "Database connection error!"); 
            $res = $th->__toString(); 
        }
        finally {
            $db->close(); 
            return $res; 
        }
       
    }

    public function getPolys($email){
        try {
            $db = \Config\Database::connect();
            $query = $db->query("SELECT ST_AsText(polygon), id, name, description, date, tags, info FROM public.\"Polys\" WHERE email ='$email' ORDER BY name")->getResult('array'); 
        } catch (\Throwable $th) {
            $query = "Database Error"; 
        }
        finally{
            $db->close(); 
            return $query; 
        }
        
        
        
    }

    public function updatePoly($id, $polys, $name, $des, $tags, $json){
        try {
            $db = \Config\Database::connect();
            $data = $this->preProcessTags($tags); 
            // $query = $db->query("UPDATE public.\"Polys\" SET polygon = $polys, name = '$name', description = '$des', date = current_timestamp, tags = '$data' , info = '$json' WHERE id = $id"); 
            if($db->simpleQuery("UPDATE public.\"Polys\" SET polygon = $polys, name = '$name', description = '$des', date = current_timestamp, tags = '$data' , info = '$json' WHERE id = $id")){
                $query = "Success!"; 
            }
            else{
                $query = "Failure!"; 
            }
        }catch (\Throwable $th) {
            $query = "Database Error"; 
        }
        finally {
            $db->close(); 
            return $query; 
        }
      
    }

    private function preProcessTags($tags){
        $num = 0; 
        $data = "{"; 
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

        return $data; 
    }

}


?>