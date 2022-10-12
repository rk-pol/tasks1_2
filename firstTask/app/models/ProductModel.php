<?php 
namespace FirstTask\Models;

use FirstTask\Core\Model;

class ProductModel extends Model
{
    public function allByCategoryId($category_id, $order_data)
    {
        
        $query = "SELECT * FROM products WHERE category_id = :id ORDER BY $order_data[order_name] $order_data[order_opt]";
        $sth =  $this->connection->prepare($query);
        $sth->execute(['id' => $category_id]);
        $products = $sth->fetchAll();
        // die(var_dump($category_id, $order_data, $products, $query, $this->connection));
        return $products;
    }

    public function all($order_data, $count = 20, $offset = 0)
    {   
        $query = "SELECT * FROM products ORDER BY $order_data[order_name] $order_data[order_opt] LIMIT $offset, $count";
        // die(var_dump($order_data, $query, $this->connection??'no'));
        return $this->connection->query($query)->fetchAll();
    }

    public function id($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $sth =  $this->connection->prepare($query);
        $sth->execute(['id' => $id]);
        
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

}