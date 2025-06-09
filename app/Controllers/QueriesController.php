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
    //* Handle queries
    public function callMethod(string $method, array $params=[]){
        
        if (!method_exists($this->query, $method)) {
            http_response_code(404);
            echo json_encode(['error' => 'Method not found']);
            return;
        }

        try {
            $result = empty($params)
                ? $this->query->$method()
                : $this->query->$method($params);
            header('Content-Type:application/json');
            echo json_encode($result);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}