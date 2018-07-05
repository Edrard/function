<?php
  
function command_exist($cmd) {
    $returnVal = trim(shell_exec("type $cmd"));
    return (empty($returnVal) ? false : true);
}