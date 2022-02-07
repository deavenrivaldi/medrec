<?php 
if(isset($_POST['update'])){

    require_once 'connect.php'; //connect to db
    require_once 'functions.inc.php'; //getting functions

    $id = $_GET['id'];
    $name = $_POST['name'];
    $birthDate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phoneNum = $_POST['phone'];
    $email = $_POST['email'];
    $filename = basename($_FILES['image']['name']);
    $tempname = $_FILES['image']['tmp_name'];

    $name = mysqli_real_escape_string($connection, $_POST['name']); //for security
    $address = mysqli_real_escape_string($connection, $_POST['address']); //for security
    $phoneNum = mysqli_real_escape_string($connection, $_POST['phone']); //for security
    $email = mysqli_real_escape_string($connection, $_POST['email']); //for security

    if(invalidName($name) !== false){
        header("location: ../updatePatient.php?id=$id&error=invalidname");
        exit();
    } //check for name

    if(invalidPhone($phoneNum) !== false){
        header("location: ../updatePatient.php?id=$id&error=invalidphone");
        exit();
    } //check for name

    if(valEmail($connection, $id, $email) !== false){
        header("location: ../updatePatient.php?id=$id&error=emailused");
        exit();
    } //check for update email

    if(is_uploaded_file($tempname)){
        updateInfoFile($connection, $id, $name, $birthDate, $gender, $address, $phoneNum, $email, $filename, $tempname);
    }
    else{
        updateInfoNoFile($connection, $id, $name, $birthDate, $gender, $address, $phoneNum, $email);
    }

} else{
    header("location: ../index.php"); //illegal access.
}