<?php
namespace App\Controllers;

use App\Queries;

class QueriesController{
    private $query;
    public function __construct($pdo)
    {
        $this->query=new Queries($pdo);
    }
     public function getAll(){
        header('Content-Type:application/json');
        echo json_encode($this->query->getAllProducts());
    }
}