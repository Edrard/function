<?php
  
function shell_command_exist($cmd) {
    $returnVal = trim(shell_exec("type $cmd"));
    return (empty($returnVal) ? false : true);
}
function shell_command_run($command, $param){
    exec($command.' '.$param);       
}