<?php 
namespace FirstTask\Models;

use FirstTask\Core\Model;

class MainModel extends Model
{
    
    public function allCategories()
    {
        $query = "SELECT categories.name, COUNT(products.name) as amount
                    FROM categories
                    LEFT JOIN products
                    ON categories.id = products.category_id
                    GROUP BY categories.name";
                    
        return $this->connection->query($query)->fetchAll();
    }
    
}