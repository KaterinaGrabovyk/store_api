<?php
namespace App\Controllers;

class PagesController{
    public function callMethod(string $method){
        $param[]=$method;
     if (!method_exists($this, $method)) {
            http_response_code(404);
            echo json_encode(['error' => 'Method not found']);
            return;
        }
        try {
            $result = empty($param)
                ? $this->$method()
                : $this->$method($param);
            $result;
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }  
    }
    public function index(array $param){
     include_once VIEW_PATH . '/'. $param[0] .'.php';
    }
}
