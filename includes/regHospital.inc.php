<?php 
if(isset($_POST['submit'])){

    require_once 'connect.php'; //connect to db
    require_once 'functions.inc.php'; //getting functions

    $hospital = $_POST['hospital'];
    $manager = $_POST['manager'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $hospital = mysqli_real_escape_string($connection, $_POST['hospital']);
    $manager = mysqli_real_escape_string($connection, $_POST['manager']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);

    if(invalidHospital($hospital) !== false){
        header("location: ../regHospital.php?error=invalidhospitalname");
        exit();
    } //check for hospital name

    if(invalidName($manager) !== false){
        header("location: ../regHospital.php?error=invalidname");
        exit();
    } //check for manager name

    if(hospitalExists($connection, $hospital) !== false){
        header("location: ../regHospital.php?error=hospitalalreadyexists");
        exit(); //if hospital already exists
    }

    regHospital($connection, $hospital, $manager, $address, $phone, $email);
}
else{
    header("location: ../index.php"); //illegal access.
}