<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register admin</title>
    
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    /> 
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"
    /> 

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="css/patient.css" />
  </head>
  <body>
    <section>
      <div class="max-width">
        <div class="container">
          <div class="card">
            <div class="title">
              <h2>REGISTER ADMIN</h2>
            </div>
            <div class="">
              <form action="includes/regAdmin.inc.php" method="POST">
                <!-- USER ID -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-key"></i></span>
                  <input
                    type="number"
                    name="user_id"
                    placeholder="Admin's user ID"
                    min="0"
                    required
                  />
                </div>
                <!-- HOSPITAL ID -->
                <div class="select_option">
                  <select
                    class="w-100"
                    name="hospital_id"
                    id="hospital_id"
                    data-live-search="true"
                    data-size="5"
                    required
                  >
                  <option style="display:none">Admin's Hospital ID</option>
                  <?php
                      $connection = mysqli_connect('localhost', 'deaven', '12345', 'medrec');
                      $sql1 = "SELECT hospital_id, hospital_name FROM hospital_info ORDER BY hospital_name asc;";
                      $result1 = mysqli_query($connection, $sql1);
                      while($row1 = mysqli_fetch_assoc($result1)):;
                      ?>
                      <option value="<?php echo $row1['hospital_id']?>"><?php echo $row1['hospital_name'];?></option>
                  <?php endwhile; ?>
                  </select>
                </div>
                <!-- <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-hospital"></i></span>
                  <input
                    type="number"
                    name="hospital_id"
                    placeholder="Admin's hospital ID"
                    min="0"
                    required
                  />
                </div> -->
                <!-- EMPLOYEE ID -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-tag"></i></span>
                  <input
                    type="text"
                    name="emp_id"
                    placeholder="Admin's employee ID"
                    required
                  />
                </div>
                <!-- ADMIN NAME -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-user"></i></span>
                  <input
                    type="text"
                    name="name"
                    placeholder="Full name"
                    required
                  />
                </div>

                <!-- Gender -->
                <div class="input_field radio_option">
                  <input
                    type="radio"
                    name="gender"
                    id="rd1"
                    value="Male"
                    required
                  />
                  <label id="rlabel1" for="rd1">Male</label>
                  <input
                    type="radio"
                    name="gender"
                    id="rd2"
                    value="Female"
                    required
                  />
                  <label id="rlabel2" for="rd2">Female</label>
                </div>
                <!-- ADMIN PASSWORD -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                  <input
                    type="text"
                    name="pwd"
                    placeholder="Password"
                    required
                  />
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
                    if($_GET['error'] == "useralreadyexists"){
                    echo "<p style='color:red'>User already exists!</p>";
                    }
                    elseif ($_GET['error'] == "invalidname"){
                    echo "<p style='color:red'>Please enter an appropriate name!</p>";
                    }
                    elseif ($_GET['error'] == "hospitalnotexist"){
                    echo "<p style='color:red'>Hospital didn't exists!</p>";
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
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <?php include_once 'footer.php'; ?>
</html>
