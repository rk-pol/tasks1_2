<?php
namespace FirstTask\Services;

use FirstTask\Models\CategoryModel;
use FirstTask\Models\ProductModel;
use FirstTask\Core\View;

class ResponseService
{
    protected $route_service;
    protected $categore_model;
    protected $products_model;
    protected $main_service;

    public function __construct()
    {
        $this->route_service = new RouteService();
        $this->categore_model = new CategoryModel();
        $this->products_model = new ProductModel();
        $this->main_service = new MainService();
    }
    private function prepHeaderResponse($status, $status_mssg, $content_type) 
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $status_mssg;
        header($status_header);
        header('Content-type: ' . $content_type);
    }
    public function index($products, $params = '', $view_path = 'main.php')
    {        
        $categories = $this->categore_model->categoriesAndProductAmount();
        // die(var_dump($products));
        if (!$products) {
            $url_data = $this->route_service->dataFromUrl($params); 
            $products = $this->products_model->all($url_data);
       }
       
        $total_amount = $this->main_service->getTotalProductsInCategories($categories);
        // die(var_dump($total_amount));
        View::create($view_path, [
                                    'categories' => $categories, 
                                    'products' => $products,
                                    'total_amount' => $total_amount,

        ]);
    }

    public function sendResponse($data, $url_data = [])
    {   
        if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
            $this->prepHeaderResponse('200', 'OK', $_SERVER['CONTENT_TYPE']);
            die(json_encode($data));
            // echo json_encode($data);
        } else {
            $this->index($data, $url_data);
        }
	}
}