<?php

if(isset($_POST['submit'])){
    require_once 'connect.php';
    require_once 'functions.inc.php';
    
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    // $uid = mysqli_real_escape_string($connection, $_POST['uid']); //for security
    $pwd = mysqli_real_escape_string($connection, $_POST['pwd']); //for security

    if($uid == 20211201 or $uid == 20211202){
        loginUserUn($connection, $uid, $pwd);
    } else {
        loginUser($connection, $uid, $pwd);
    }
    
}
else{
    header('location: ../index.php');
    exit();
}