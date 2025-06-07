<?php
namespace App;
class Queries {
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo=$pdo;
    }
    public function getAllProducts(){
        $query = 'SELECT * FROM products';
        $stmt=$this->pdo->query($query);
        return $stmt->fetchAll();
    }
    public function getByID(int $id){
        $query = 'SELECT * FROM products WHERE ';
        $stmt=$this->pdo->query($query);
        return $stmt->fetch();
    }
    public function addProduct(array $variables){

    }
}