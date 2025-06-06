<?php
namespace App;
class Queries extends Config{

    public function getAllProducts():array{
        $query2 = 'SELECT * FROM products';
        $stmt=$this->pdo->query($query2);
        return $stmt->fetchAll();
    }
}