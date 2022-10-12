<?php
namespace FirstTask\Controllers;

use FirstTask\Controllers\Controller;
use FirstTask\Models\ProductModel;

class ProductController extends Controller 
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }
    public function allByCategoryId($category_id, $sort_data)
    {
        return $this->model->allByCategoryId($category_id, $sort_data);
    }

    public function all($sort_data)
    {
        return $this->model->all($sort_data);
    }

    public function id($id)
    {
        return $this->model->id($id);
    }
}
