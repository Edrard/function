<?php
function array_resort_by_mergetwo($array,$param_1,$param_2){
    $new = [];
    if(is_array($array)){
        foreach($array as $val){
            $new[$val[$param_1].$val[$param_2]] = $val;
        }    
    }
    return $new;
}
function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key => $value) {
        $current_key = $key;
        if($needle === $value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}
function array_first_element($array){
    reset($array);
    return key($array);
}
function array_last_element($array){
    end($array);
    return key($array);
}
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
function array_resort_empty($array,$param){
    $new = [];
    foreach($array as $val){
        $new[$val[$param]] = '';
    }
    return $new;
}
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
function array_copy_value_to_key($array){
    $new = [];
    foreach($array as $key => $val){
        $new[$val] = $val;
    }
    return $new;
}
function array_copy_key_to_value($array){
    foreach($array as $key => &$val){
        $val = $key;
    }
    return $array;
}
function resort_array_for_vertical_show(Array $array, $columns = '3'){
    $count = count($array);
    $new = [];
    $n = 1;
    foreach($array as $val){
        $tmp = ($n - 1)*$columns;
        if($tmp >= $count){
            $f = 0;
            while($tmp >= 0){
                $tmp -= $count;
                $f++;
            }
            $tmp = $tmp+$count + 1*($f - 1);
        }
        $new[$tmp] = $val;
        $n++;
    }
    ksort($new);
    return $new;
}
function array_special_merge($array1,$array2)
{
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
function array_special_merge_time($array1,$array2)
{
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
function empty_obj($obj) {
    foreach ($obj as $k) {
        return false;
    }
    return true;
}
function array_check_numeric($array){
    array_walk($array, function(&$value, $key) {
        $value = (int) $value;
    });
    return $array;
}
function array_max_min($keys,&$array,$min = 'min', $max = 'max'){
    $keys = explode('.',$keys);
    while (count($keys) > 1) {
        $key = array_shift($keys);

        // If the key doesn't exist at this depth, we will just create an empty array
        // to hold the next value, allowing us to create the arrays to hold final
        // values at the correct depth. Then we'll keep digging into the array.
        if (! isset($array[$key]) || ! is_array($array[$key])) {
            return FALSE;
        }

        $array = &$array[$key];
    }
    $last = array_shift($keys);
    if($array[$last][$min] > $array[$last][$max]){
        $array[$last][$min] = $array[$last][$max];    
    }
}