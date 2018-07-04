<?php
function array_walk_keys_apply_function(&$array, $function) {      // $function(massive,key,value)
    if(is_array($array)) {
        foreach($array as $key => &$val){
            $function($array,$key);
            array_walk_keys_apply_function($val,$function);
        }
    }

}
function array_sum(array $array){
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
function dd(){
    $arg_list = func_get_args();
    foreach($arg_list as $var){
        print_r($var); 
    }              
    die;
}
function today(){
    return strtotime(date("Y-m-d"));
}
function unset_first(&$array){
    reset($array);
    $key = key($array);
    unset($array[$key]); 
}
function one_word($word,$quote = TRUE){
    if($quote === TRUE){
        $word = str_replace(array('\'','"'),'',$word);
    }
    if(strpos(trim($word), ' ') !== false)
    {
        return trim(strtok($word,' '));
    }
    else
    {
        return $word;
    }
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
function array_resort($array,$param){
    $new = array();
    if(is_array($array)){
        foreach($array as $val){
            $new[$val[$param]] = $val;
        }
    }
    return $new;
}
/** resort array and empty information **/
function array_resort_empty($array,$param){
    $new = array();
    foreach($array as $val){
        $new[$val[$param]] = '';
    }
    return $new;
}
function array_resort_special($array,$param,$param2 = ''){
    if(!$param2){
        foreach($array as $val){
            $new[$val[$param]][] = $val;
        }
    }else{
        foreach($array as $val){
            $new[$val[$param]][$val[$param2]] = $val;
        }
    }
    return $new;

}
function array_insert($array,$insert,$skey){
    $k = 0;
    if(is_array($array)){
        foreach($array as $key => $val){
            if($key == $skey){
                $new[] = $insert;
                $k = 1; 
            }
            $new[] = $val;
        }
    }
    if($k == 0){
        $new[] = $insert;
    }
    return $new;
}
function array_rename($array,$name,$rename){
    foreach($array as $key => $val){
        if($key == $name){
            $array[$rename] = $val;
            unset($array[$name]);
            break;
        }
    }
    return $array;
}
function slice_string($string,$n)
{   
    $len = mb_strlen($string,'utf8');
    while($len >= $n ){
        $tmp = (array) explode(' ',$string); 
        if(count($tmp) > 1){       
            unset($tmp[(count($tmp)-1)]);
            $string = implode(' ',$tmp);
            $len = mb_strlen($string,'utf8');
        }else{
            break;
        }
    }

    return $string;
}
function transform($string,$n)
{   
    $new = '';                          
    //echo $string.' n='.mb_strlen($string,'utf8').'<br>';
    if(mb_strlen($string,'utf8') > $n){
        $num = mb_strlen($string,'utf8');
        $new = mb_substr($string,0,(-1*($num-$n+3)),'utf8');
        $new .= '...';
    }else{
        $new .= $string;
    }
    //echo $new.'<br>';
    return $new;
}
function transform_word($string,$n)
{   
    $new = '';
    //echo $string.' n='.mb_strlen($string,'utf8').'<br>';
    if(mb_strlen($string,'utf8') > $n){
        $num = mb_strlen($string,'utf8');
        $new = mb_substr($string,0,(-1*($num-$n+3)),'utf8');
    }else{
        $new .= $string;
    }
    //echo $new.'<br>';
    return $new;  
}