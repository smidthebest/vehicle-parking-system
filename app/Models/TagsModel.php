<?php namespace App\Models;

use CodeIgniter\Model;

class TagsModel extends Model
{
    
    protected $table = "public.\"Tags\""; 
    protected $allowedFields = ['tags']; 
    protected $primaryKey = 'tags'; 
    protected $return_type = 'array'; 
}


?>