<?php 
session_start();

if(isset($_POST['submit'])){

    require_once 'connect.php'; //connect to db
    require_once 'functions.inc.php'; //getting functions

    $id = $_POST['patient_id'];
    $cuDate = $_POST['checkup_date'];
    $doctor = $_POST['doctor'];
    $action = $_POST['action'];
    $diagnosis = $_POST['diagnosis'];
    $note = $_POST['note'];

    $note = mysqli_real_escape_string($connection, $note);

    if(invalidNote($note) !== false){
        header("location: ../addRecord.php?error=invalidnote");
        exit();
    } // check validity of note

    addRecord($connection, $id, $cuDate, $doctor, $action, $diagnosis,$note ,$_SESSION['uid']);
}