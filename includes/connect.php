<?php 

    // connect to database using MySQLi 
    $connection = mysqli_connect('localhost', 'deaven', '12345', 'medrec');

    // check the connection
    if(!$connection){ //if connection is false
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>