<?php
/**
* Resort array using 2 internal parametrs with delimiter
* 
* @param mixed $array
* @param mixed $param_1
* @param mixed $param_2
* @param mixed $del
*/
if (! function_exists('array_resort_by_mergetwo')) {   
    function array_resort_by_mergetwo($array,$param_1,$param_2,$del = ''){
        $new = [];
        if(is_array($array)){
            foreach($array as $val){
                $new[$val[$param_1].$del.$val[$param_2]] = $val;
            }    
        }
        return $new;
    }
}
/**
* Recursive search in array
* 
* @param mixed $needle
* @param mixed $haystack
*/
if (! function_exists('array_recursive_search')) {   
    function array_recursive_search($needle,$haystack) {
        foreach($haystack as $key => $value) {
            $current_key = $key;
            if($needle === $value OR (is_array($value) && array_recursive_search($needle,$value) !== false)) {
                return $current_key;
            }
        }
        return false;
    }
}
/**
* Get key of first element
* 
* @param mixed $array
*/
if (! function_exists('array_first_element')) {   
    function array_first_element($array){
        reset($array);
        return key($array);
    }
}
/**
* Get key of last element
* 
* @param mixed $array
*/
if (! function_exists('array_last_element')) {   
    function array_last_element($array){
        end($array);
        return key($array);
    }
}
/**
* Resort Array by paramentr in array
* 
* @param mixed $array
* @param mixed $param
*/
if (! function_exists('array_resort')) {   
    function array_resort($array,$param){
        $new = [];
        if(is_array($array)){
            foreach($array as $val){
                if(is_object($val)){
                    $new[$val->{$param}] = $val;    
                }elseif(is_array($val)){
                    $new[$val[$param]] = $val;
                }
            }
        }
        return $new;
    }
}
/**
*  Resort Array and create multilevel 
*/
if (! function_exists('array_resort_multi')) {   
    function array_resort_multi($array,$param){
        $new = [];
        if(is_array($array)){
            foreach($array as $val){
                if(is_object($val)){
                    $new[$val->{$param}][] = $val;    
                }elseif(is_array($val)){
                    $new[$val[$param]][] = $val;
                }
            }
        }
        return $new;
    }
}
/**
* Resort array by paramenr in array and delete value
* 
* @param mixed $array
* @param mixed $param
*/
if (! function_exists('array_resort_empty')) {   
    function array_resort_empty($array,$param){
        $new = [];
        foreach($array as $val){
            $new[$val[$param]] = '';
        }
        return $new;
    }
}
/**
* Rename key in array
* 
* @param mixed $array
* @param mixed $name
* @param mixed $rename
*/
if (! function_exists('array_rename')) {   
    function array_rename(&$array,$name,$rename){
        foreach($array as $key => $val){
            if($key == $name){
                $array[$rename] = $val;
                unset($array[$name]);
                break;
            }
        }
        return $array;
    }
}
/**
* Copy value to key
* 
* @param mixed $array
*/
if (! function_exists('array_copy_value_to_key')) {   
    function array_copy_value_to_key($array){
        $new = [];
        foreach($array as $key => $val){
            $new[$val] = $val;
        }
        return $new;
    }
}
/**
* Copy key to value
* 
* @param mixed $array
*/
if (! function_exists('array_copy_key_to_value')) {   
    function array_copy_key_to_value(Array $array){
        foreach($array as $key => &$val){
            $val = $key;
        }
        return $array;
    }
}
/**
* Special merge, keep all keys even if its exists
* 
* @param mixed $array1
* @param mixed $array2
*/
if (! function_exists('array_special_merge')) {   
    function array_special_merge($array1,$array2){
        if(!is_array($array1)){
            $array1 = array();
        }
        if(is_array($array2)){
            foreach($array2 as $key2 => $val2){
                if(!array_key_exists($key2,$array1)){
                    $array1[$key2] = $val2;
                }else{
                    $array1[] = $val2;
                }
            }
        }

        return $array1;

    }
}
/**
* Marge array, if same key, then create array and keep multiple value
* 
* @param array $array1
* @param array $array2
*/
if (! function_exists('array_special_merge_samein')) {   
    function array_special_merge_samein(array $array1,array $array2){
        if(!is_array($array1)){
            $array1 = array();
        }
        if(is_array($array2)){
            foreach($array2 as $key2 => $val2){
                if(!array_key_exists($key2,$array1)){
                    $array1[$key2] = $val2;
                }else{          
                    if(!is_array($array1[$key2])){
                        $tmp = $array1[$key2];
                        unset($array1[$key2]); 
                        $array1[$key2][] = $tmp;
                    }
                    $array1[$key2][] = $val2; 
                }
            }
        }

        return $array1;
    }
}
/**
* Merge array, if same key, then add prefix to key
* 
* @param array $array1
* @param array $array2
* @param string $prefix
*/
if (! function_exists('array_special_merge_samere')) {   
    function array_special_merge_samere(array $array1,array $array2,$prefix = 'second_')
    {
        if(!is_array($array1)){
            $array1 = array();
        }
        if(is_array($array2)){
            foreach($array2 as $key2 => $val2){
                if(!array_key_exists($key2,$array1)){
                    $array1[$key2] = $val2;
                }else{          
                    $array1[$prefix.$key2] = $val2; 
                }
            }
        }

        return $array1;
    }
}   
/**
* Check if Object empty
* 
* @param mixed $obj
*/
if (! function_exists('empty_obj')) {   
    function empty_obj($obj) {
        foreach ($obj as $k) {
            return false;
        }
        return true;
    }
}
/**
* Convert to numeric all values
* 
* @param mixed $array
*/
if (! function_exists('array_conv_numeric')) {   
    function array_conv_numeric($array){
        array_walk($array, function(&$value, $key) {
            $value = (int) $value;
        });
        return $array;
    }
} 
/**
* Recursive sum array
* 
* @param mixed $array
* @return number
*/
if (! function_exists('array_sum_recursive')) {   
    function array_sum_recursive(array $array){
        $sum = array(0);
        foreach($array as $value) {
            if(is_array($value)) {
                $sum[] = arraySum($value);
            } else {
                $sum[] = $value;
            }
        }
        return array_sum($sum);
    }
}
    /**
    * Insert in array after $skey with $wkey
    * 
    * @param mixed $array
    * @param mixed $insert
    * @param mixed $skey
    * @param mixed $wkey
    */
if (! function_exists('array_insert_after_key')) {   
    function array_insert_after_key($array,$insert,$skey,$wkey=''){
        $k = 0;
        if(is_array($array)){
            foreach($array as $key => $val){
                if($key == $skey){
                    $new[$key] = $val;
                    $new[$wkey] = $insert;
                    $k = 1; 
                }else{
                    if(!isset($new[$key])){
                        $new[$key] = $val;
                    }
                }
            }
        }                                 
        if($k == 0){
            $new[$skey] = $insert;
        }         
        return $new;
    }
}
/**
* Clean array from empty value, keys can be reassign
* 
* @param mixed $array
* @param mixed $use_keys
*/
if (! function_exists('array_clean_empty_value')) {   
    function array_clean_empty_value($array,$use_keys = FALSE)
    {
        if(isset($array)){
            $new = array();
            foreach ($array as $key => $value) {
                if(!is_array($value)){
                    if ((!is_null($value) || $value !="") && strlen($value) > 0) {
                        if(!$use_keys){
                            $new[] = $value;
                        }else{
                            $new[$key] = $value;    
                        }
                    }
                }
            } 
            return $new;
        }
    }
}