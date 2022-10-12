<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'newschema');
//Set default values
$result = []; 
$global_res = [];
$connection = null;
//Get connection
$dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "";
$connection = new PDO($dns, DB_USER, DB_PASSWORD);
//Get data
$query = 'SELECT * FROM categories';
$data = $connection->query($query)->fetchAll();
//Start making an array
$start = microtime(true);
foreach($data as $element) {
    $result = recursiveMethod($data, $element['parent_id']);
    $global_res = $global_res + $result;
}
echo 'Время выполнения скрипта: ' . (microtime(true) - $start) . ' sec.';
echo '<br>';
print_r($global_res);
//
function recursiveMethod($data, $parent_id)
{   
    static $count = 0;
    $nod = array();
        foreach ($data as &$element) {     
            if ($element['parent_id'] == $parent_id) {
                $value = recursiveMethod($data, $element['categories_id']);               
                //
                if (!empty($value)) {     
                    if (key_exists($element['parent_id'],  $nod)) {
                        $nod[$element['parent_id']][$element['categories_id']]=$value[$element['categories_id']];      
                    } else {
                        $nod[$element['parent_id']]=$value;
                    }       
                } else {
                    if (key_exists($element['parent_id'],  $nod)) {
                        $nod[$element['parent_id']][$element['categories_id']] = $element['categories_id'];
                    } else {
                        $nod[$element['parent_id']] =  [$element['categories_id'] => $element['categories_id']];
                    }
                }
                unset($GLOBALS['data'][$count]);
                $count++;
            }      
        } 
    return $nod;
}
