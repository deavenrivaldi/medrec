<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register patient</title>
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
              <h2>REGISTER PATIENT</h2>
            </div>
            <div class="">
              <form action="includes/addPatient.inc.php" method="POST" enctype="multipart/form-data">
                <!-- Patient's ID -->
                <div class="input_field">
                  <span
                    ><i aria-hidden="true" class="fa fa-user-friends"></i
                  ></span>
                  <input
                    type="number"
                    name="patient_id"
                    placeholder="Patient's ID"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="16"
                    min="0"
                    required
                  />
                </div>
                <!-- Full name -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-tag"></i></span>
                  <input
                    type="text"
                    name="name"
                    placeholder="Full name"
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
                    required
                  />
                  <label for="rd1">Male</label>
                  <input
                    type="radio"
                    name="gender"
                    id="rd2"
                    value="female"
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
                    required
                  />
                </div>
                <!-- Email -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                  <input type="email" name="email" placeholder="Email" />
                </div>
                <!-- Patient image -->
                <div class="image_field">
                  <input type="file" name="image">
                </div>
                <input
                  class="button"
                  type="submit"
                  name="submit"
                  value="REGISTER"
                />
              </form>
            </div>
            <?php 
                if (isset($_GET['error'])){
                    if($_GET['error'] == "patientalreadyexists"){
                    echo "<p style='color:red'>Patient already exists!</p>";
                    }
                    elseif ($_GET['error'] == "invalidname"){
                    echo "<p style='color:red'>Please enter an appropriate name!</p>";
                    }
                    elseif ($_GET['error'] == "invalidphone"){
                    echo "<p style='color:red'>Please enter an appropriate phone number!</p>";
                    }
                    elseif ($_GET['error'] == "invalidimg"){
                    echo "<p style='color:red'>Please upload an image!</p>";
                    }
                    elseif ($_GET['error'] == "emailused"){
                    echo "<p style='color:red'>Email has been registered!</p>";
                    }
                    elseif ($_GET['error'] == "stmtfailed" || $_GET['error'] == "queryfailed"){
                    echo "<p style='color:red'>Something went wrong, try again!</p>";
                    }
                }
            ?> 
          </div>
          <div class="navigator">
            <span><a href="dashboard.php">Back</a></span>
          </div>
        </div>
      </div>
    </section>
    <?php include_once 'footer.php'; ?>
</html>
