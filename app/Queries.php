<?php
declare(strict_types=1);
namespace App;

use App\Exceptions\NoRouterException;
use Exception;

class Queries {
    private $db;
    public function __construct()
    {
        $this->db=App::db();
    }
    public function getAllProducts(){
        $query = 'SELECT * FROM products';
        $stmt=$this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getByID(int $id){
        $query = 'SELECT * FROM products WHERE id=:id';
        $stmt=$this->db->prepare($query);
        $stmt->execute([
            ':id'=>$id
        ]);
        $res=$stmt->fetch();
        if(!$res){
        throw new NoRouterException();
        }
        return $res;
    }
    public function addProduct(){
        $query='INSERT INTO products (title,price,amount,in_stock) VALUES(:title, :price, :amount, :in_stock)';
        $this->insert($_REQUEST,$query);
        $id=$this->db->lastInsertId();
        return ['message'=>'added new product with id = ' . $id];
    }
    public function updateProduct(int $id){
        $query="UPDATE products SET  title = :title,price = :price,amount = :amount,in_stock = :in_stock WHERE id = :id";
        $stmt=$this->db->prepare($query);
        $this->insert($_REQUEST,$query,$id);
        return ['message'=>'updated item with id = ' . $id];
    }
    public function insert(array $array,string $query,int $id=null){
        echo $in_stock = ($array['amount'] > 0) ? 1 : 0;
        $stmt=$this->db->prepare($query);
        $stmt->execute([
             ':title'=>$array['title'],
             ':price'=>$array['price'],
             ':amount'=>$array['amount'],
             ':in_stock'=>$in_stock,
             ':id'=>$id
        ]);
    }
}