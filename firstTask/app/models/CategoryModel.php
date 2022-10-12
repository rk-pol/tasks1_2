<?php 
namespace FirstTask\Models;

use FirstTask\Core\Model;
use FirstTask\Models\ProductModel;

class CategoryModel extends Model
{
    protected $products;

    public function __construct()
    {
        parent::__construct();
        $this->products = new ProductModel();
    }

    public function allProductsByCategory($category, $sort_data)
    {
       
        $query = "SELECT id FROM categories WHERE name = :name";
        $sth =  $this->connection->prepare($query, [\PDO::FETCH_ASSOC]);
        $sth->execute(['name' => $category]);
        $category_id = $sth->fetch();
         
        return $this->products->allByCategoryId($category_id['id'], $sort_data);            
    }

    public function all()
    {
        $query = "SELECT * FROM categories";
        return  $this->connection->query($query);
    }

    public function categoriesAndProductAmount()
    {
        $query = "SELECT categories.name, COUNT(products.name) as amount
                    FROM categories
                    LEFT JOIN products
                    ON categories.id = products.category_id
                    GROUP BY categories.name";
         
        return $this->connection->query($query)->fetchAll();
    }

}