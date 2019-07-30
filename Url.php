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
