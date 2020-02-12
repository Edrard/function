<?php
if (! function_exists('url_unparse')) {
    function url_unparse(array $parsed)
    {
        $get = function ($key) use ($parsed) {
            return isset($parsed[$key]) ? $parsed[$key] : null;
        };

        $pass      = $get('pass');
        $path      = $get('path');
        $user      = $get('user');
        $userinfo  = $pass !== null ? "$user:$pass" : $user;
        $port      = $get('port');
        $scheme    = $get('scheme');
        $query     = $get('query');
        $fragment  = $get('fragment');
        $authority =
        ($userinfo !== null ? "$userinfo@" : '') .
        $get('host') .
        ($port ? ":$port" : '');

        $return =  (strlen($scheme) ? "$scheme:" : '');
        $return .= (strlen($authority) ? "//$authority" : '');
        if (substr($path, 0, 1) != '/') {
            $return .= '/';
        }

        $return .= $path;
        $return .= (strlen($query) ? "?$query" : '');
        $return .= (strlen($fragment) ? "#$fragment" : '');
        return $return;
    }
}
if (! function_exists('url_unparse_proxy')) {
    function url_unparse_proxy(array $proxy)
    {
        return $proxy['proxy'].':'.$proxy['port'];
    }
}
/**
* Fixing URL
*
* @param mixed $url - check url
* @param mixed $add - url if base havent
*/
if (! function_exists('fix_url')) {
    function fix_url($url, $add)
    {
        if (strtolower(substr($url, 0, 2)) != "//") {
            if (strtolower(substr($url, 0, 4)) != "http" && strtolower(substr($url, 0, 5)) != "https") {
                $url = $add.$url;
            }
        } elseif (strtolower(substr($url, 0, 2)) == "//") {
            $url = "http:".$url;
        }
        return $url;
    }
}
if (! function_exists('url_title')) {
    function url_title($str, $separator = '-', $lowercase = TRUE)
    {
        if ($separator == 'dash')
        {
            $separator = '-';
        }
        else if ($separator == 'underscore')
        {
            $separator = '_';
        }

        $q_separator = preg_quote($separator);

        $trans = array(
            '&.+?;'                 => '',
            '[^a-z0-9 _-]'          => '',
            '\s+'                   => $separator,
            '('.$q_separator.')+'   => $separator
        );

        $str = strip_tags($str);

        foreach ($trans as $key => $val)
        {
            $str = preg_replace("#".$key."#i", $val, $str);
        }

        if ($lowercase === TRUE)
        {
            $str = strtolower($str);
        }

        return trim($str, $separator);
    }
}
if (! function_exists('encodestring')) {
    function encodestring($st,$tran)
    {

        $arr = array(
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'JO',
            'Ж' => 'ZH',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'JJ',
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
            'Х' => 'KH',
            'Ц' => 'C',
            'Ч' => 'CH',
            'Ш' => 'SH',
            'Щ' => 'SHH',
            'Ъ' => 'a',
            'Ы' => 'Y',
            'Ь' => 'a',
            'Э' => 'EH',
            'Ю' => 'JU',
            'Я' => 'JA',
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
            'х' => 'kh',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shh',
            'ъ' => 'a',
            'ы' => 'y',
            'ь' => 'a',
            'э' => 'eh',
            'ю' => 'ju',
            'я' => 'ja'
        );
        if($tran == 'en'){
            $key = array_keys($arr);
            $val = array_values($arr);
            $transl = str_replace($key,$val,$st );
        }elseif($tran == 'rus'){
            $key = array_keys($arr);
            $val = array_values($arr);
            $transl = str_replace($val,$key,$st );

        }

        return nl2br(htmlspecialchars($transl));
    }
}

if (! function_exists('hypnes_ru_url')) {
    function hypnes_ru_url($string){
        return url_title((trim(encodestring($string,'en'))));
    }
}