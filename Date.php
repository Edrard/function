<?php

function today(){
    return strtotime(date("Y-m-d"));
}
function now(){
    return strtotime(date("Y-m-d H:i:s"));
}