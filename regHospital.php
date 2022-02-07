<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register hospital</title>
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
              <h2>REGISTER HOSPITAL</h2>
            </div>
            <div class="">
              <form action="includes/regHospital.inc.php" method="POST">
                <!-- HOSPITAL NAME -->
                <div class="input_field">
                  <span
                    ><i aria-hidden="true" class="fa fa-hospital"></i
                  ></span>
                  <input
                    type="text"
                    name="hospital"
                    placeholder="Hospital name"
                    required
                  />
                </div>
                <!-- MANAGER NAME -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-briefcase"></i></span>
                  <input
                    type="text"
                    name="manager"
                    placeholder="Manager name"
                    required
                  />
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
                    if($_GET['error'] == "hospitalalreadyexists"){
                    echo "<p style='color:red'>Hospital already exists!</p>";
                    }
                    elseif ($_GET['error'] == "invalidhospitalname"){
                    echo "<p style='color:red'>Please enter an appropriate hospital name!</p>";
                    }
                    elseif ($_GET['error'] == "invalidname"){
                    echo "<p style='color:red'>Please enter an appropriate name!</p>";
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