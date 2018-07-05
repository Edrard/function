<?php

function unparse_url(array $parsed) {
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
    if(substr($path, 0, 1) != '/'){
        $return .= '/';    
    }

    $return .= $path;                      
    $return .= (strlen($query) ? "?$query" : '');
    $return .= (strlen($fragment) ? "#$fragment" : '');
    return $return;
}

function unparse_proxy(array $proxy){
    return $proxy['proxy'].':'.$proxy['port'];    
}