<?php
declare(strict_types=1);
namespace App;

use App\Exceptions\NoRouterException;

class Queries {
    private $db;
    public function __construct()
    {
        $this->db=App::db();
    }
    public function getAll(){
        $query = 'SELECT * FROM products';
        $stmt=$this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getbyId(array $params){
        $query = 'SELECT * FROM products WHERE id=:id';
        $stmt=$this->db->prepare($query);
        $stmt->execute([':id'=>(int)$params[0]]);
        $res=$stmt->fetch();
        if(!$res){
        throw new NoRouterException();
        }
        return $res;
    }
    public function add(){
        $query='INSERT INTO products (title,price,amount,in_stock) VALUES(:title, :price, :amount, :in_stock)';
        $this->insert($_REQUEST,$query);
        $id=$this->db->lastInsertId();
        return ['message'=>'added new product with id = ' . $id];
    }
    public function update(array $params){
        parse_str(file_get_contents('php://input'), $input);
        $query="UPDATE products SET  title = :title,price = :price,amount = :amount,in_stock = :in_stock WHERE id = :id";
        $this->isExists((int)$params[0]);
        $this->insert($input,$query,(int)$params[0]);
        return ['message'=>'updated item with id = ' . $params[0]];
    }
    public function patch(array $params){
        parse_str(file_get_contents('php://input'), $input);
        $params=[':id'=>(int)$params[0]];
        foreach ($input as $key => $value) {
            $fields[] = "$key = :$key";
            $params[":$key"] = $value;
        }
        if(isset($input['amount'])){
        $in_stock = ($input['amount'] > 0) ? 1 : 0;
        $params[':in_stock']=$in_stock;
        $fields[]="in_stock = :in_stock";
        }
        $query='UPDATE products SET '. implode( ',',$fields).' WHERE id = :id';
        $this->isExists((int)$params[':id']);
        $stmt=$this->db->prepare($query);
        $stmt->execute($params);
        return ['message' => 'patched item with id = ' . $params[':id']];
    }
    public function delete(array $params){
        $query='DELETE FROM products WHERE id = :id';
        $this->isExists((int)$params[0]);
        $stmt=$this->db->prepare($query);
        $stmt->execute([':id'=>(int)$params[0]]);
        return ['message'=>'item with id = ' . $params[0] . ' no linger exists.'];
    }
    public function insert(array $array,string $query,int $id=0){
        $in_stock = ($array['amount'] > 0) ? 1 : 0;
        $stmt=$this->db->prepare($query);
        $params=[
             ':title'=>$array['title'],
             ':price'=>$array['price'],
             ':amount'=>$array['amount'],
             ':in_stock'=>$in_stock
        ];
        if($id!==0){
         $params[':id']=$id;
        }
        $stmt->execute($params);
    }
    public function isExists(int $id){
        $query='SELECT * FROM products WHERE id=:id';
        $stmt=$this->db->prepare($query);
        $stmt->execute([':id'=>$id]);
        $res=(int)$stmt->fetch();
        if($res==0){
            http_response_code(404);
            echo 'item with id = ' . $id . ' doesn`t exists.';
            exit;
        }
    }
}