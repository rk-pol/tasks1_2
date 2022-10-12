<?php 
require_once './vendor/autoload.php';

use FirstTask\Core\Route;

Route::route('/', ['MainController', 'index']); 

Route::route('/id/(\d+)', ['MainController', 'getProductById']);

Route::route('/all/all', ['CategoryController', 'getAllProducts']);

Route::route('/all/all\?(.*)', ['CategoryController', 'getAllProducts']);

Route::route('/(\w+)/(\w+)', ['CategoryController', 'allProductsByCategory']);

Route::route('/(\w+)/(\w+)\?(.*)', ['CategoryController', 'allProductsByCategory']);

//Start routing
Route::execute($_SERVER['REQUEST_URI']);


