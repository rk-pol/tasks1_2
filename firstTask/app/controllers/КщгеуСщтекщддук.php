<?php
namespace FirstTask\Controllers;

use FirstTask\Controllers\Controller;
use FirstTask\Models\MainModel;
use FirstTask\Models\ProductModel;
use FirstTask\Services\MainService;

class MainController extends Controller 
{
    protected $view_path;
    protected $model;
    protected $main_service;
    protected $products_model;

    public function __construct()
    {   
        parent::__construct();
        $this->model = new MainModel();
        $this->main_service = new MainService();
        $this->products_model = new ProductModel();
        $this->view_path = 'main.php';
    }
    
    public function index($url_data, $data = '')
    {
        $categories = $this->model->allCategories();
        $products = $this->products_model->all($url_data);
           
        $total_amount = $this->main_service->getTotalProductsInCategories($categories);
       
        $this->view->create($this->view_path, [
                                                'categories' => $categories, 
                                                'products' => $products,
                                                'total_amount' => $total_amount,

        ]);
    }

    public function id($data)
    {
        return $this->products_model->id($data['id']);
    }

}
