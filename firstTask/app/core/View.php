<?php 
namespace FirstTask\Core;

class View 
{
    private static $base_view_template_path = 'app/view/layouts/app.php';

    public static function create($view_path, $data = [])
    {
        include_once self::$base_view_template_path;
    }
}