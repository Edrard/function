<?php
if (! function_exists('today')) {
    function today()
    {
        return strtotime(date("Y-m-d"));
    }
}
if (! function_exists('now')) {
    function now()
    {
        return strtotime(date("Y-m-d H:i:s"));
    }
}
