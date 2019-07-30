<?php

if (! function_exists('obj_to_array')) {
    /**
    * Converting Object to array
    *
    * @param stdClass $obj
    * @return array
    */
    function obj_to_array($obj)
    {
        return json_decode(json_encode($obj), true);
    }
}
