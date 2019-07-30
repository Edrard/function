<?php
if (! function_exists('dd')) {
    /**
    * Normal print variables
    *
    */
    function dd()
    {
        $arg_list = func_get_args();
        foreach ($arg_list as $var) {
            print_r($var);
        }
        die;
    }
}
if (! function_exists('vd')) {
    /**
    * Var dump variables
    *
    */
    function vd()
    {
        $arg_list = func_get_args();
        foreach ($arg_list as $var) {
            var_dump($var);
        }
        die;
    }
}
