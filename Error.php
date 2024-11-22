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
if (! function_exists('is_function_available')) {
    function is_function_available($func) {
        if (ini_get('safe_mode') || !function_exists($func)) return false;
        $disabled = ini_get('disable_functions');
        if ($disabled) {
            $disabled = explode(',', $disabled);
            $disabled = array_map('trim', $disabled);
            return !in_array($func, $disabled);
        }
        return true;
    }
}