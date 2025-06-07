<?php
namespace App\Controllers;

use App\Queries;

class QueriesController{
    private $query;
    public function __construct($pdo)
    {
        $this->query=new Queries($pdo);
    }
    public function handleReq(){
        header('Content-Type:application/json');
        $method=$_SERVER['REQUEST_METHOD'];
        switch($method){
            case 'GET':
                echo json_encode($this->query->getAllProducts());
                break;
            default:
              http_response_code(405);
              echo json_encode(['message' => 'Method not allowed']);
        }
    }
}