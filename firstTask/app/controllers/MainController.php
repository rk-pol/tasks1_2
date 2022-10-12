<?php
namespace FirstTask\Controllers;

use FirstTask\Controllers\Controller;
use FirstTask\Models\ProductModel;
use FirstTask\Services\ResponseService;

class MainController extends Controller 
{
    protected $response_service;
    protected $products_model;

    public function __construct()
    {   
        $this->response_service = new ResponseService();
        $this->products_model = new ProductModel();
    }
    
    public function index($params = [])
    {
        $this->response_service->index($params);
    }

    public function getProductById($data)
    { 
        $product = $this->products_model->id($data[0]);
        $this->response_service->sendResponse($product);
    }

}
