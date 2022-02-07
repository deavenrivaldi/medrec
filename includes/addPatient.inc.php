<?php 
if(isset($_POST['submit'])){

    require_once 'connect.php'; //connect to db
    require_once 'functions.inc.php'; //getting functions

    $id = $_POST['patient_id'];
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
        header("location: ../addPatient.php?error=invalidname");
        exit();
    } //check for name

    if(invalidPhone($phoneNum) !== false){
        header("location: ../addPatient.php?error=invalidphone");
        exit();
    } //check for name

    if(emailExists($connection, $email) !== false){
        header("location: ../addPatient.php?error=emailused");
        exit(); //if email already used
    }

    if(invalidImg($filename) !== false){
        header("location: ../addPatient.php?error=invalidimg");
        exit(); //if file uploaded is not an image
    }

    if(idExists($connection, $id) !== false){
        header("location: ../addPatient.php?error=patientalreadyexists");
        exit(); //if patient already exists 
    }

    // echo "<pre>";
    // print_r($_FILES['image']);
    // echo "</pre>";

    regPatient($connection, $id, $name, $birthDate, $gender, $address, $phoneNum, $email, $filename, $tempname); //input patient data to db
}
else{
    header("location: ../index.php"); //illegal access.
}