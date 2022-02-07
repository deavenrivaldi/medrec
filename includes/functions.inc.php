<?php

// Login Functions
function uidExists($connection, $uid){
    $sql = "SELECT uid, password
            FROM admin_login
            WHERE uid = ?;";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function loginUser($connection, $uid, $pwd){
    $uidExists = uidExists($connection, $uid);

    if($uidExists === false){
        header("location: ../login.php?error=UIDdoesntexists");
        exit();
    }

    $pwdHashed = $uidExists['password'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    elseif($checkPwd){
        session_start(); //start a new session
        $_SESSION['uid'] = $uidExists['uid'];
        $_SESSION['name'] = getName($connection, $_SESSION['uid']);

        header("location: ../dashboard.php");
        exit();
    }

    /* $pwdUnhashed = $uidExists['password'];

    if($pwd !== $pwdUnhashed){
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    elseif($pwd == $pwdUnhashed){
        session_start(); //start a new session
        $_SESSION['uid'] = $uidExists['uid'];
        $_SESSION['name'] = getName($connection, $_SESSION['uid']);

        header("location: ../dashboard.php");
        exit(); 
    } */
}

function loginUserUn($connection, $uid, $pwd){
    $uidExists = uidExists($connection, $uid);

    if($uidExists === false){
        header("location: ../login.php?error=UIDdoesntexists");
        exit();
    }

    $pwdUnhashed = $uidExists['password'];

    if($pwd !== $pwdUnhashed){
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    elseif($pwd == $pwdUnhashed){
        session_start(); //start a new session
        $_SESSION['uid'] = $uidExists['uid'];
        $_SESSION['name'] = getName($connection, $_SESSION['uid']);

        header("location: ../dashboard.php");
        exit(); 
    }
}

function getName($connection, $uid){
    $sql = "SELECT SUBSTRING_INDEX(full_name, ' ', 1) as 'name'
            FROM admin_info
            WHERE uid = ?;";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row['name'];
    }
    mysqli_stmt_close($stmt);
}

// Change Password Functions
function oldPwd($connection, $uid, $pwd){
    $sql = "SELECT password
            FROM admin_login
            WHERE uid = ?;";
    
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    $checkPwd = $row['password'];

    mysqli_stmt_close($stmt);

    $result='';
    if(password_verify($pwd, $checkPwd) === false){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result='';
    if($pwd !== $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function updatePass($connection, $uid, $pwd){
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "UPDATE admin_login SET 
            password = ?
            WHERE uid = ?;";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $hashedPwd, $uid);
    mysqli_stmt_execute($stmt); 
    mysqli_stmt_close($stmt);

    header("location: ../dashboard.php");
    exit();
}

// Register Patient Functions

function idExists($connection, $id){
    $sql = "SELECT patient_id, full_name, gender, date_of_birth, address, phone_number, email, image_url
            FROM patient_info
            WHERE patient_id = ?;";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../regPatient.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function invalidName($name){
    $result='';
    if(!preg_match('/^[a-zA-Z\s]*$/', $name)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidPhone($phone){
    $result='';
    if(!preg_match('/^[0-9]*$/', $phone)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidImg($filename){
    $result = ''; 
    $img_ex = pathinfo($filename, PATHINFO_EXTENSION);
    $img_ex_lower = strtolower($img_ex);

    $allowed_ex = array("", "jpg", "jpeg", "png");

    if(!in_array($img_ex_lower, $allowed_ex)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emailExists($connection, $email){
    $sql = "SELECT email
            FROM patient_info
            WHERE email = ?;";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../addPatient.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);

    if($row['email'] > 0){
        $result = true;
        return $result;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function regPatient($connection, $id, $name, $birthDate, $gender, $address, $phoneNum, $email, $filename, $tempname){
    $folder = "../patients_img/".$filename; //uploaded image directory

    $sql = "INSERT INTO patient_info(patient_id, full_name, gender, date_of_birth, address, phone_number, email, image_url)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../addPatient.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "isssssss", $id, $name, $gender, $birthDate, $address, $phoneNum, $email, $filename);
    
    if(move_uploaded_file($tempname, $folder)){
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);
        header("location: ../dashboard.php");
    } else{
        echo "Files not uploaded";
    }
    exit();
}

// Update Patient's Info Function
function valEmail($connection, $id, $email){
    $sql = "SELECT email FROM patient_info WHERE patient_id = ?";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../addPatient.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt); 

    $emailResult = mysqli_stmt_get_result($stmt);
    $emailRow = mysqli_fetch_assoc($emailResult);
    $checkEmail = $emailRow['email'];

    mysqli_stmt_close($stmt);

    if($email !== $checkEmail){
        $sql = "SELECT email
                FROM patient_info
                WHERE email = ?;";

        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../updatePatient.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt); 

        $resultData = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resultData);

        if($row['email'] > 0){
            $result = true;
            return $result;
        }
        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    } else {
        $result = false;
        return $result;
    }
}

function updateInfoNoFile($connection, $id, $name, $birthDate, $gender, $address, $phoneNum, $email){
    $sql = "UPDATE patient_info SET 
            full_name = ?,
            gender = ?,
            date_of_birth = ?,
            address = ?,
            phone_number = ?,
            email = ?
            WHERE patient_id = ?;";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../updatePatient.php?id=$id&error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssi", $name, $gender, $birthDate, $address, $phoneNum, $email, $id);
    mysqli_stmt_execute($stmt); 
    mysqli_stmt_close($stmt);
    header("location: ../record.php?id=$id");
    exit();
}

function updateInfoFile($connection, $id, $name, $birthDate, $gender, $address, $phoneNum, $email, $filename, $tempname){
    $folder = "../patients_img/".$filename; //uploaded image directory

    $sql = "UPDATE patient_info SET 
            full_name = ?,
            gender = ?,
            date_of_birth = ?,
            address = ?,
            phone_number = ?,
            email = ?,
            image_url = ?
            WHERE patient_id = ?;";
    
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../updatePatient.php?id=$id&error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssi", $name, $gender, $birthDate, $address, $phoneNum, $email, $filename, $id);

    if(move_uploaded_file($tempname, $folder)){
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);
        header("location: ../record.php?id=$id");
    } else{
        echo "Files not uploaded";
    }
    exit();
}

// Add Record Functions
function invalidNote($note){
    $result='';
    if(!preg_match('/^[a-zA-Z0-9\s]*$/', $note)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function addRecord($connection, $pid, $date, $doctor, $action, $diagnosis, $note, $uid){
    $idExists = idExists($connection, $pid);
    $curDate = date('Y-m-d H:i:s');

    if($idExists === false){
        header("location: ../addRecord.php?error=patientnotregistered");
        exit();
    }

    $sql1 ="INSERT INTO record_info(patient_id, date_of_check, doctor, action, diagnose, note)
            VALUES ($pid, '$date', '$doctor', '$action', '$diagnosis', '$note')";
    
    $sql2 ="INSERT INTO record_admin(input_by, input_date)
            VALUES ($uid, NOW());";

    if (mysqli_query($connection, $sql1)) {
        if (mysqli_query($connection, $sql2)) {
            mysqli_close($connection);
            header("location: ../dashboard.php");
        }
        else{
            //header("location: ../addRecord.php?error=query2failed");
            echo "Error: " . $sql2. "<br>" . mysqli_error($connection);
            exit();
        }
    } else {
        //header("location: ../addRecord.php?error=query1failed");
        echo "Error: " . $sql1. "<br>" . mysqli_error($connection);
        exit();
    }
    exit();
}

// Register Hospital Functions
function invalidHospital($hospital){
    $result='';
    if(!preg_match('/^[a-zA-Z0-9\s]*$/', $hospital)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function hospitalExists($connection, $hospital){
    $sql = "SELECT hospital_name
            FROM hospital_info
            WHERE hospital_name = ?;";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../regHospital.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $hospital);
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);

    if($row['hospital_name'] > 0){
        $result = true;
        return $result;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function regHospital($connection, $hospital, $manager, $address, $phone, $email){
    $sql = "INSERT INTO hospital_info(hospital_name, manager, address, phone_number, email)
            VALUES(?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../regHospital.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $hospital, $manager, $address, $phone, $email);
    mysqli_stmt_execute($stmt); 
    mysqli_stmt_close($stmt);
    header("location: ../dashboard.php");
    exit();
}


// Register Admin Functions
function hospitalIDExists($connection, $hospital_id){
    $sql = "SELECT hospital_id
            FROM hospital_info
            WHERE hospital_id = ?;";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../regAdmin.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $hospital_id);
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);

    if($row['hospital_id'] > 0){
        $result = true;
        return $result;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function regAdmin($connection, $uid, $hospital_id, $emp_id, $name, $gender, $pwd){
    $sql1 = "INSERT INTO admin_info(uid, employee_id, full_name, gender)
            VALUES ($uid, '$emp_id', '$name', '$gender');";

    $sql2 = "INSERT INTO hospital_admin()
            VALUES ($uid, $hospital_id);";

    $sql3 = "INSERT INTO admin_login(uid, password)
            VALUES (?, ?);";
    
    if (mysqli_query($connection, $sql1)) {
        if (mysqli_query($connection, $sql2)) {

            $stmt = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt, $sql3)){
                header("location: ../addAdmin.php?error=stmtfailed");
                exit();
            }
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //$pwd;

            mysqli_stmt_bind_param($stmt, "is", $uid, $hashedPwd);
            mysqli_stmt_execute($stmt); 
            mysqli_stmt_close($stmt);

            header("location: ../dashboard.php");
        }
        else{
            //header("location: ../addRecord.php?error=query2failed");
            echo "Error: " . $sql2. "<br>" . mysqli_error($connection);
            exit();
        }
    } else {
        //header("location: ../addRecord.php?error=query1failed");
        echo "Error: " . $sql1. "<br>" . mysqli_error($connection);
        exit();
    }
    exit();
}



