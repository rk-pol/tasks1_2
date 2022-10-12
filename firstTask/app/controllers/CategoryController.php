<?php
namespace FirstTask\Controllers;

use FirstTask\Controllers\Controller;
use FirstTask\Models\CategoryModel;
use FirstTask\Models\ProductModel;
use FirstTask\Services\ResponseService;
use FirstTask\Services\RouteService;

class CategoryController extends Controller 
{
    protected $model;
    protected $response_service;
    protected $route_service;
    protected $products_model;

    public function __construct()
    {   
        $this->model = new CategoryModel();
        $this->response_service = new ResponseService();
        $this->route_service = new RouteService();
        $this->products_model = new ProductModel();     
    }
    
    public function allProductsByCategory($params)
    {
        
        $sort_data = $this->route_service->dataFromUrl($params[2]);
        
        $products = $this->model->allProductsByCategory($params[0], $sort_data);
        // die(var_dump($products));
        $this->response_service->sendResponse($products);
    }

    public function getAllProducts($params = [])
    {
        
        $sort_data = $this->route_service->dataFromUrl($params[0]); 
        $products = $this->products_model->all($sort_data);   
        $this->response_service->sendResponse($products);
    }

    public function productById($data)
    {
        return $this->products_model->id($data['id']);
    }

}
