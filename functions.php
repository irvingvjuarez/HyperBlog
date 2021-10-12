<?php

function clear($variable){
    $variable = filter_var($variable, FILTER_SANITIZE_STRING);
    $variable = trim($variable);
    $variable = stripslashes($variable);
    $variable = htmlspecialchars($variable);
    return $variable;
}

function nonEmpty($variable, $msg){
    global $errors;

    if( empty($variable) ){
        $errors .= "<span class='err'>Please add a $msg</span>";
    }
}