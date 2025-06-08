<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Queries;

class QueriesController{
    private $query;
    public function __construct()
    {
        $this->query=new Queries();
    }
    public function callMethod(string $method, array $params=null){
        header('Content-Type:application/json');
        $this->$method($params);
    }
    //* Get methods
     public function getAll(){
        
        echo json_encode($this->query->getAllProducts());
    }
    public function getId(array $param){
        
        echo json_encode($this->query->getByID((int)$param[0]));
    }
    //* Add and Update methods
    public function add(){
        
        echo json_encode($this->query->addProduct());
    }
    public function update(array $param){
        echo json_encode($this->query->updateProduct((int)$param[0]));
    }
}