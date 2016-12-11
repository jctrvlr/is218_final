<?php
session_start();

define('DIR','http://web.njit.edu/~jic6/is218_final');
define('SITEEMAIL','jic6@njit.edu');
include 'classes/pdo.class.php';


function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}




?>
