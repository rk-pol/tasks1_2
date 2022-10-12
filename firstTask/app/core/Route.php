<?php 

namespace FirstTask\Core;

use FirstTask\Core\View;

class Route
{
	private static $routes = array();
	private static $page_exist = false;

	public static function route($pattern, $array)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $array;
    }
	//
	public static function execute($url)
    {
        foreach (self::$routes as $pattern => $array)
        {
			// die(var_dump($pattern, $url, preg_match($pattern, $url, $params)));
            if (preg_match($pattern, $url, $params))
            {	
				// die(var_dump($pattern, $url,  $params));
				if (method_exists('FirstTask\Controllers\\' . $array[0], $array[1])){				
					$controller_namespace = 'FirstTask\Controllers\\' . $array[0];
					$controller_obj = new $controller_namespace();
					$method_name = $array[1];
					// die(var_dump($controller_namespace, $method_name));
					array_shift($params);
					if (!empty($params)) {
						$controller_obj->$method_name($params);
					} else {
						$controller_obj->$method_name();
					}
					self::$page_exist = true;			
				}
            }
        }
		if (!self::$page_exist) {
			self::page404();
		}
    }

	public static function page404()
	{
		$status_header = 'HTTP/1.1 404 Fail';
        header($status_header);
        header('Content-type: ' . $_SERVER['CONTENT_TYPE']);
		View::create('page404.php');
	}
		
}