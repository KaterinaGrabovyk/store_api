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
}