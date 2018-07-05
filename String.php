<?php
function special_cleans($string){
    
    $search[] = '“';
    $search[] = '”';

    $replace[] = '"';
    $replace[] = '"';
    
    return is_string($string) ? str_replace($search,$replace,$string) : $string;
}
function preg_non_word(){
    return '0-9A-Za-zА-Яа-яЁё';
}
function have_russian($input_line){
    return preg_match("/\p{Cyrillic}/u", $input_line);    
}
function only_latin($input_line){
    return preg_match("/^[\w\d\s\p{P}]*$/", $input_line);
}
function encodestring($st,$tran = 'en',$base = 'ru'){ 
    $arr['ru'] = array( 
        'А' => 'A', 
        'Б' => 'B', 
        'В' => 'V', 
        'Г' => 'G', 
        'Д' => 'D', 
        'Е' => 'E', 
        'Ё' => 'Jo', 
        'Ж' => 'Zh', 
        'З' => 'Z', 
        'И' => 'I', 
        'Й' => 'Jj', 
        'К' => 'K', 
        'Л' => 'L', 
        'М' => 'M', 
        'Н' => 'N', 
        'О' => 'O', 
        'П' => 'P', 
        'Р' => 'R', 
        'С' => 'S', 
        'Т' => 'T', 
        'У' => 'U', 
        'Ф' => 'F', 
        'Х' => 'H', 
        'Ц' => 'C', 
        'Ч' => 'Ch', 
        'Ш' => 'Sh', 
        'Щ' => 'Shh', 
        'Ъ' => '', 
        'Ы' => 'Y', 
        'Ь' => '', 
        'Э' => 'Eh', 
        'Ю' => 'Ju', 
        'Я' => 'Ja', 
        'а' => 'a', 
        'б' => 'b', 
        'в' => 'v', 
        'г' => 'g', 
        'д' => 'd', 
        'е' => 'e', 
        'ё' => 'jo', 
        'ж' => 'zh', 
        'з' => 'z', 
        'и' => 'i', 
        'й' => 'jj', 
        'к' => 'k', 
        'л' => 'l', 
        'м' => 'm', 
        'н' => 'n', 
        'о' => 'o', 
        'п' => 'p', 
        'р' => 'r', 
        'с' => 's', 
        'т' => 't', 
        'у' => 'u', 
        'ф' => 'f', 
        'х' => 'H', 
        'ц' => 'c', 
        'ч' => 'ch', 
        'ш' => 'sh', 
        'щ' => 'shh', 
        'ъ' => '', 
        'ы' => 'y', 
        'ь' => '', 
        'э' => 'eh', 
        'ю' => 'ju', 
        'я' => 'ja'
    ); 
    if($tran == 'en'){
        $key = array_keys($arr[$base]);
        $val = array_values($arr[$base]);
        $transl = str_replace($key,$val,$st ); 
    }else{ 
        $key = array_keys($arr[$base]);
        $val = array_values($arr[$base]);
        $transl = str_replace($val,$key,$st );         
    }

    return nl2br(htmlspecialchars($transl)); 
}
function mb_ucfirst($string, $encoding = 'utf-8')
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}
/**
* Remove/Replace Special characters
* 
* @param string $str - needle 
* @param boolen $white - Removing whitespace, default true 
* @param string|boolean $add - additional Reg
* @param string $replace - relace with
*/
function string_rspec($str, $white = TRUE, $add = FALSE, $replace = ''){
    $main = preg_non_word();
    $main = $white !== FALSE ? $main.'\s' : $main;
    $main = $add !== FALSE ? $main.preg_quote($add) : $main;
    return preg_replace("/[^".$main."]/iu", $replace, htmlspecialchars_decode($str));
}
function slug_string($str){
    return mb_strtolower(preg_replace('#[^A-Za-z0-9\-]#iu','',str_replace(' ','-',encodestring(trim($str)))));
}
function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false, $insert = false) {
    if (is_array($ending)) {
        extract($ending);
    }
    if ($considerHtml) {
        if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        $totalLength = mb_strlen($ending);
        $openTags = array();
        $truncate = '';
        preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
        foreach ($tags as $tag) {
            if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param|source/s', $tag[2])) {
                if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
                    array_unshift($openTags, $tag[2]);
                } else if (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
                    $pos = array_search($closeTag[1], $openTags);
                    if ($pos !== false) {
                        array_splice($openTags, $pos, 1);
                    }
                }
            }
            $truncate .= $tag[1];

            $contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));
            if ($contentLength + $totalLength > $length) {
                $left = $length - $totalLength;
                $entitiesLength = 0;
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                    foreach ($entities[0] as $entity) {
                        if ($entity[1] + 1 - $entitiesLength <= $left) {
                            $left--;
                            $entitiesLength += mb_strlen($entity[0]);
                        } else {
                            break;
                        }
                    }
                }

                $truncate .= mb_substr($tag[3], 0 , $left + $entitiesLength);
                break;
            } else {
                $truncate .= $tag[3];
                $totalLength += $contentLength;
            }
            if ($totalLength >= $length) {
                break;
            }
        }

    } else {
        if (mb_strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = mb_substr($text, 0, $length - strlen($ending));
        }
    }
    if($insert !== FALSE){
        $endlost = str_replace($truncate,'',$text);
    }
    if (!$exact) {
        $spacepos = mb_strrpos($truncate, ' ');
        if (isset($spacepos)) {
            if ($considerHtml) {
                $bits = mb_substr($truncate, $spacepos);
                preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
                if (!empty($droppedTags)) {
                    foreach ($droppedTags as $closingTag) {
                        if (!in_array($closingTag[1], $openTags)) {
                            array_unshift($openTags, $closingTag[1]);
                        }
                    }
                }
            }
            $after = mb_substr($truncate, $spacepos);
            $truncate = mb_substr($truncate, 0, $spacepos);
        }
    }
    $truncate .= $insert !== FALSE ? $ending.$after.$endlost : $ending;

    if ($considerHtml && $insert === FALSE) {
        foreach ($openTags as $tag) {
            $truncate .= '</'.$tag.'>';
        }
    }

    return $truncate;
}
function escape_like($string)
{
    $search = array('%', '_');
    $replace   = array('\%', '\_');
    return str_replace($search, $replace, $string);
}
function reconstruct_array($array,$t="|"){
    $new = [];
    foreach($array as $key => $val){
        $tmp = explode($t,$key);
        $new[$tmp[0]] = !isset($new[$tmp[0]]) ? [] : $new[$tmp[0]];
        $new[$tmp[0]] = _reconstruct_array($tmp,$val,$new[$tmp[0]]);
    }  
    return $new;  
}
function _reconstruct_array($keys,$val,$new){
    unset($keys[array_first_element($keys)]); 
    if(!empty($keys)){ 
        reset($keys);
        $key = $keys[key($keys)];
        $new[$key] = !isset($new[$key]) ? [] : $new[$key];
        $new[$key] = _reconstruct_array($keys,$val,$new[$key]);
    }else{
        $new = $val;
    }
    return $new;
}
function path_to_class(array $paths){
    $return = [];
    foreach($paths as $p){
        $tmp = explode('.',ucfirst($p));
        $return[] = str_replace('/','\\','/'.$tmp[0]);    
    }
    return $return;
}
function splitLast($string,$def='\\'){
    $tmp = explode($def,$string);
    $return = array_pop($tmp);   
    return $return; 
}