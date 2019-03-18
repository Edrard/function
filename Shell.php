<?php
if (! function_exists('shell_command_exist')) { 
    function shell_command_exist($cmd) {
        $returnVal = trim(shell_exec("type $cmd"));
        return (empty($returnVal) ? false : true);
    }
}
if (! function_exists('shell_command_run')) {
    function shell_command_run($command, $param){
        exec($command.' '.$param);       
    }
}