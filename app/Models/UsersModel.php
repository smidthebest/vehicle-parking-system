<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    
    protected $table = "public.\"Users\""; 
    protected $allowedFields = ['email', 'pass', 'fname', 'sname']; 
    protected $primaryKey = 'email'; 
    protected $return_type = 'array'; 
}


?>