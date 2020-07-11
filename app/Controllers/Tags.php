<?php namespace App\Controllers;
session_start(); 
use CodeIgniter\RESTful\ResourceController;
use App\Models\TagsModel; 

class Tags extends ResourceController
{
    protected $format = 'json'; 

    public function getTags(){
        $model = new TagsModel(); 
        $all = $model->findColumn("tags"); 
        return json_encode($all); 
    }
}

?>