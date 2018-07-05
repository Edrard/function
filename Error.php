<?php
if (! function_exists('dd')) {  
    function dd(){
        $arg_list = func_get_args();
        foreach($arg_list as $var){
            print_r($var); 
        }              
        die;
    }
}