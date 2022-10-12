<?php
namespace FirstTask\Services;

class CategoryService
{
   public function getMethodName($category_name)
   {
        switch ($category_name) {
            case 'all':
                return 'allProducts';
                break;
            default:
                return 'allProductsByCategory';
                break;    
        }

   }
}