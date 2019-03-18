<?php
/**
* Changing special double quotes to normal
* 
* @param mixed $string
*/
if (! function_exists('string_quotes_change')) {   
    function string_quotes_change($string){

        $search[] = '“';
        $search[] = '”';

        $replace[] = '"';
        $replace[] = '"';

        return is_string($string) ? str_replace($search,$replace,$string) : $string;
    }
}
/**
* Check if string have Cyrillic
* 
* @param mixed $input_line
*/
if (! function_exists('string_have_russian')) {   
    function string_have_russian($input_line){
        return preg_match("/\p{Cyrillic}/u", $input_line);    
    }
}
/**
* Check if string have only latin
* 
* @param mixed $input_line
*/
if (! function_exists('string_only_latin')) {   
    function string_only_latin($input_line){
        return preg_match("/^[\w\d\s\p{P}]*$/", $input_line);
    }
}
/**
* Transliterate text
* 
* @param mixed $st
* @param mixed $tran
* @param mixed $base
*/
if (! function_exists('encodestring')) {   
    function encodestring($st,$tran = 'en',$base = 'ru'){ 
        return string_encodestring($st,$tran,$base);
    }
}
if (! function_exists('string_encodestring')) {   
    function string_encodestring($st,$tran = 'en',$base = 'ru'){ 
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
}
/**
* Mb to upper case first latter
* 
* @param mixed $string
* @param mixed $encoding
*/
if (! function_exists('mb_ucfirst')) {   
    function mb_ucfirst($string, $encoding = 'utf-8')
    {
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }
}
/**
* Remove/Replace Special characters
* 
* @param string $str - needle 
* @param boolen $white - Removing whitespace, default true 
* @param string|boolean $add - additional Reg
* @param string $replace - relace with
*/
if (! function_exists('string_rspec')) {   
    function string_rspec($str, $white = TRUE, $add = FALSE, $replace = ''){
        $main = preg_non_word();
        $main = $white !== FALSE ? $main.'\s' : $main;
        $main = $add !== FALSE ? $main.preg_quote($add) : $main;
        return preg_replace("/[^".$main."]/iu", $replace, htmlspecialchars_decode($str));
    }
}
if (! function_exists('preg_non_word')) {   
    function preg_non_word(){
        return '0-9A-Za-zА-Яа-яЁё';
    }
}
/**
* Clean filename
* 
* @param mixed $name
*/
if (! function_exists('string_file_name')) {   
    function string_file_name($name){
        $name = preg_replace('/\s+/', '-', $name);
        $name = preg_replace("/[^0-9A-Za-zА-Яа-яЁё\-_]/iu", '', $name);
        $name = trim($name, ".-_\t\n\r\0\x0B");
        return $name;
    }
}
/**
* Slug text
* 
* @param string $str - String
* @param string $del - Delimiter
*/
if (! function_exists('string_slug')) {   
    function string_slug($str,$del = '-'){
        $preg = '\\'.$del;
        return mb_strtolower(preg_replace('#[^A-Za-z0-9'.$preg.']#iu','',str_replace(' ',$del,encodestring(trim($str)))));
    }
}
/**
* Truncate string
* 
* @param mixed $text
* @param mixed $length
* @param mixed $ending
* @param mixed $exact
* @param mixed $considerHtml
* @param mixed $insert
*/
if (! function_exists('string_truncate')) {   
    function string_truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false, $insert = false) {
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
}
/**
* Convert path to class PSR-4
* 
* @param mixed $paths
*/
if (! function_exists('path_to_class')) {   
    function path_to_class(array $paths){
        $return = [];
        foreach($paths as $p){
            $tmp = explode('.',ucfirst($p));
            $return[] = str_replace('/','\\','/'.$tmp[0]);    
        }
        return $return;
    }
}
/**
* Split last word in String with custome delimiters
* 
* @param mixed $string
* @param mixed $def
*/
if (! function_exists('string_split_last')) {   
    function string_split_last($string,$def='\\'){
        $tmp = explode($def,trim($string,$def));
        $return = array_pop($tmp);   
        return $return; 
    }
}
/**
* Split first word in String with custome delimiters
* 
* @param mixed $string
* @param mixed $def
*/
if (! function_exists('string_split_first')) {   
    function string_split_first($string,$def='\\'){
        $tmp = explode($def,trim($string,$def));
        $return = array_shift($tmp);   
        return $return; 
    }
}
/**
* Wrap text/string witch $break if current state more then $width 
* 
* @param mixed $str
* @param mixed $width
* @param mixed $break
* @param mixed $cut
*/
if (! function_exists('mb_wordwrap')) {   
    function mb_wordwrap($str, $width = 75, $break = "\n", $cut = true) {
        $lines = explode($break, $str);
        foreach ($lines as &$line) {
            $line = rtrim($line);
            if (mb_strlen($line) <= $width)
                continue;
            $words = explode(' ', $line);
            $line = '';
            $actual = '';
            foreach ($words as $word) {
                if (mb_strlen($actual.$word) <= $width)
                    $actual .= $word.' ';
                else {
                    if ($actual != '')
                        $line .= rtrim($actual).$break;
                    $actual = $word;
                    if ($cut) {
                        while (mb_strlen($actual) > $width) {
                            $line .= mb_substr($actual, 0, $width).$break;
                            $actual = mb_substr($actual, $width);
                        }
                    }
                    $actual .= ' ';
                }
            }
            $line .= trim($actual);
        }
        return implode($break, $lines);
    }
}
/**
* Generate very rare marker
* 
* @param mixed $num
*/
if (! function_exists('heartgen')) {   
    function heartgen($num=3){
        $f = '';
        for($i=1;$i<=$num;$i++){
            $f .= '♥';
        }
        return $f;
    }
}