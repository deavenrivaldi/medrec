<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update patient info</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="css/patient.css" />
  </head>
  <body>
    <section>
      <div class="max-width">
        <div class="container">
          <div class="card">
            <div class="title">
              <h2>UPDATE PATIENT INFO</h2>
            </div>
            <div class="">
                <?php
                    $connection = mysqli_connect('localhost', 'deaven', '12345', 'medrec');
                    $id = mysqli_real_escape_string($connection, $_GET['id']);
                    $sql = "SELECT full_name, DATE_FORMAT(date_of_birth, '%Y-%m-%d') as 'date_of_birth' ,gender, address, phone_number, email FROM patient_info WHERE patient_id = '$id';";
                    $info_result = mysqli_query($connection, $sql);
                    $info_row = mysqli_fetch_assoc($info_result);
                ?>
              <form action="includes/updatePatient.inc.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                <!-- Patient's ID -->
                <div class="input_field">
                  <span
                    ><i aria-hidden="true" class="fa fa-user-friends"></i
                  ></span>
                  <input
                    type="number"
                    name="patient_id"
                    placeholder="Patient's ID"
                    value="<?php echo $id?>"
                    disabled
                  />
                </div>
                <!-- Full name -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-tag"></i></span>
                  <input
                    type="text"
                    name="name"
                    placeholder="Full name"
                    value="<?php echo $info_row['full_name']?>"
                    required
                  />
                </div>
                <!--Birth Date -->
                <div>Birth date</div>
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-calendar"></i></span>
                  <input
                    type="date"
                    name="birthdate"
                    placeholder="Birth date"
                    value="<?php echo $info_row['date_of_birth']?>"
                    required
                  />
                </div>
                <!-- Gender -->
                <div class="input_field radio_option">
                  <input
                    type="radio"
                    name="gender"
                    id="rd1"
                    value="male"
                    <?php if($info_row['gender'] == "male"){
                        echo 'checked';
                    } ?> 
                    required
                  />
                  <label for="rd1">Male</label>
                  <input
                    type="radio"
                    name="gender"
                    id="rd2"
                    value="female"
                    <?php if($info_row['gender'] == "female"){
                        echo 'checked';
                    } ?> 
                    required
                  />
                  <label for="rd2">Female</label>
                </div>
                <!-- Address -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-map-pin"></i></span>
                  <input
                    type="text"
                    name="address"
                    placeholder="Address"
                    value="<?php echo $info_row['address']?>"
                    required
                  />
                </div>
                <!-- Phone Number -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                  <input
                    type="text"
                    name="phone"
                    placeholder="Phone number"
                    value="<?php echo $info_row['phone_number']?>"
                    required
                  />
                </div>
                <!-- Email -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                  <input type="email" 
                    name="email" 
                    placeholder="Email" 
                    value="<?php echo $info_row['email']?>"
                />
                </div>
                <!-- Patient image -->
                <div class="image_field">
                  <input type="file" 
                  name="image" 
                  />
                </div>
                <input
                  class="button"
                  type="submit"
                  name="update"
                  value="UPDATE"
                />
              </form>
            </div>
            <?php 
                if (isset($_GET['error'])){
                    if ($_GET['error'] == "invalidname"){
                    echo "<p style='color:red'>Please enter an appropriate name!</p>";
                    }
                    elseif ($_GET['error'] == "invalidphone"){
                    echo "<p style='color:red'>Please enter an appropriate phone number!</p>";
                    }
                    elseif ($_GET['error'] == "emailused"){
                    echo "<p style='color:red'>Email has been registered!</p>";
                    }
                    elseif ($_GET['error'] == "invalidimg"){
                    echo "<p style='color:red'>Please upload an image!</p>";
                    }
                    elseif ($_GET['error'] == "stmtfailed" || $_GET['error'] == "queryfailed"){
                    echo "<p style='color:red'>Something went wrong, try again!</p>";
                    }
                }
            ?> 
          </div>
          <div class="navigator">
            <span><a href="record.php?id=<?php echo $id?>">Back</a></span>
          </div>
        </div>
      </div>
    </section>
    <?php include_once 'footer.php'; ?>
</html>
