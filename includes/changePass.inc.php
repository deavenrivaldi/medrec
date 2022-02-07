<?php 
session_start();

if(isset($_POST['change'])){

    require_once 'connect.php'; //connect to db
    require_once 'functions.inc.php'; //getting functions

    $old_pwd = $_POST['old_pass'];
    $pwd = $_POST['new_pwd'];
    $pwdRepeat = $_POST['repeat_pwd'];

    $old_pwd = mysqli_real_escape_string($connection, $old_pwd);
    $pwd = mysqli_real_escape_string($connection, $pwd);
    $pwdRepeat = mysqli_real_escape_string($connection, $pwdRepeat);

    if(oldPwd($connection, $_SESSION['uid'], $old_pwd) !== false){
        header("location: ../changePass.php?error=oldpasswordsdontmatch");
        exit(); //check password matching
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../changePass.php?error=passwordsdontmatch");
        exit(); //check password matching
    }

    updatePass($connection, $_SESSION['uid'], $pwd);
}
else{
    header("location: ../index.php"); //illegal access.
}