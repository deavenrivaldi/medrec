<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Record</title>
    <link rel="stylesheet" href="css/record.css" />
    <script
      src="https://kit.fontawesome.com/68e1167060.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <nav class="navbar">
      <div class="max-width">
        <div class="logo">
          <a href="dashboard.php"><img src="images/logo.png" alt="logo.inc" /></a>
        </div>
        <div class="sign_btn"><a href="index.php">LOGOUT</a></div>
      </div>
    </nav>
    <section class="record" id="record">
      <div class="record-content">
        <div class="head">
          <a href="searchResult.php" class="fas fa-caret-left"></a>
          <div class="title">MEDICAL RECORDS</div>
        </div>
        <!-- Information Section -->
        <div class="info-card">
          <div class="info-title">A. Patients Information</div>
          <div class="info-content">
            <div class="info-left">
              <p>Full Name:</p>
              <p>Date of Birth:</p>
              <p>Gender:</p>
              <p>Address:</p>
              <p>Phone No.:</p>
              <p>Email:</p>
            </div>
            <div class="info-right">
              <?php 
                $connection = mysqli_connect('localhost', 'deaven', '12345', 'medrec');
                $id = mysqli_real_escape_string($connection, $_GET['id']);
                $sql = "SELECT full_name, DATE_FORMAT(date_of_birth, '%d %M %Y') as 'date_of_birth' ,gender, address, phone_number, email FROM patient_info WHERE patient_id = '$id';";
                $info_result = mysqli_query($connection, $sql);
                while ($info_row = mysqli_fetch_assoc($info_result)){
              ?>
                <p><?php echo $info_row['full_name'] ?></p>
                <p><?php echo $info_row['date_of_birth'] ?></p>
                <p><?php echo $info_row['gender'] ?></p>
                <p style="text-transform:uppercase"><?php echo $info_row['address'] ?></p>
                <p><?php echo $info_row['phone_number'] ?></p>
                <p style="text-transform:lowercase"><?php echo $info_row['email'] ?></p>
              <?php } ?>
            </div>
          </div>
          <div class="edit-btn"><a href="updatePatient.php?id=<?php echo $id ?>">Edit Information</a></div>
        </div>
        <!-- Detail Section -->
        <div class="detail-card">
          <div class="detail-title">B. Patients Record</div>
          <?php 
            $i = 1;
            $sql = "SELECT DATE_FORMAT(date_of_check, '%d-%m-%Y') as 'date_of_check', doctor, action, diagnose, note FROM record_info WHERE patient_id = '$id' ORDER BY UNIX_TIMESTAMP(date_of_check) asc;";
            $record_result = mysqli_query($connection, $sql);
            while ($record_row = mysqli_fetch_assoc($record_result)){
          ?>
          <!-- Repeat from this part -->
          <div class="record-counter"><?php echo $i ?>. Medical Record</div>
          <div class="detail-content">
            <div class="detail-left">
              <p>Date of Check:</p>
              <p>Doctor:</p>
              <p>Diagnose:</p>
              <p>Action:</p>
              <p>Note:</p>
            </div>
            <div class="detail-right">
              <p><?php echo $record_row['date_of_check']?></p>
              <p style="text-transform:uppercase"><?php echo $record_row['doctor']?></p>
              <p style="text-transform:uppercase"><?php echo $record_row['diagnose']?>.</p>
              <p><?php echo $record_row['action']?></p>
              <p><?php echo $record_row['note']?></p>
            </div>
          </div>
          <!-- Repeat until this part -->
          <?php 
            $i++;
            } 
          ?>
          <div class="add-btn"><a href="addRecord.php">Add Record</a></div>
        </div>
      </div>
    </section>
    <?php include_once 'footer.php'; ?>
  </body>
</html>
