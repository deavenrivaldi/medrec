<?php 
if(isset($_POST['submit'])){

    require_once 'connect.php'; //connect to db
    require_once 'functions.inc.php'; //getting functions

    $uid = $_POST['user_id'];
    $hospital_id = $_POST['hospital_id'];
    $emp_id = $_POST['emp_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $pwd = $_POST['pwd'];

    $emp_id = mysqli_real_escape_string($connection, $_POST['emp_id']);
    $admin = mysqli_real_escape_string($connection, $_POST['name']);
    $pwd = mysqli_real_escape_string($connection, $_POST['pwd']);

    if(uidExists($connection, $uid) !== false){
        header("location: ../regAdmin.php?error=useralreadyexists");
        exit();
    } // If uid already exists

    if(invalidName($name) !== false){
        header("location: ../regAdmin.php?error=invalidname");
        exit();
    } //check for admin name

    if(hospitalIDExists($connection, $hospital_id) == false){
        header("location: ../regAdmin.php?error=hospitalnotexist");
        exit(); //if hospital not exists
    }

    regAdmin($connection, $uid, $hospital_id, $emp_id, $name, $gender, $pwd);
}
else{
    header("location: ../index.php"); //illegal access.
}