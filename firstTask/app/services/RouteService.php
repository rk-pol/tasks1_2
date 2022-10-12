<?php
namespace FirstTask\Services;

class RouteService
{
    public function dataFromUrl($data)
    {
        $url_data = [];

        //Set default order's date if url_query is empty 
        if (empty($data)) {
            $url_data['order_name'] = 'name';
            $url_data['order_opt'] = 'asc';

            return $url_data;
        }
        
        //If $data is string     
        if (strpos($data,'&') == false) {           
            $query  = explode('=', $data);
            if ($query[0] == 'new') {   
                $temp_data['order_name'] = 'date';
            } else {
                $temp_data['order_name'] = $query[0];
            }
            $temp_data['order_opt'] = $query[1];
            $data = $temp_data;
            return $data;
        } 
            
        $query  = explode('&', $data);

        foreach($query as $param)
        {
            $temp_data = explode('=', $param);

            if ($temp_data[1] == 'new') {                
                $url_data['order_name'] = 'date';
                continue;
            }
            $url_data[$temp_data[0]] = $temp_data[1];
        }
        return $url_data;
    }

}