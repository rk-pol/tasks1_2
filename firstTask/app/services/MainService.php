<?php
namespace FirstTask\Services;

class MainService
{
    public function getTotalProductsInCategories($categories)
    {
        $total_amount = 0;

        foreach ($categories as $category) {
            $total_amount += $category['amount'];
        }
        return $total_amount;
    }

    public function getMethodName($data) {
        switch ($data) {
            case '':
                return 'index';
                break;
            default:
                return $data;
                break;    
        }
    }
}