<?php
if (! function_exists('cli_confirm')) {
    function cli_confirm ($text = "Are you sure you want to do this?  Type 'yes' to continue: \n",$thanks = "\nThank you, continuing...\n",$error = "Exiting...\n") {
        echo $text;
        $line = fgets(fopen ("php://stdin","r"));
        preg_match('/((yes)|y)$/i', $line, $output_array);
        if($output_array == array()){
            echo $error;
            exit;
        }
        fclose($handle);
        echo $thanks;
    }
}
