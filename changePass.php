<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Password</title>
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
              <h2>CHANGE PASSWORD</h2>
            </div>
            <div class="">
              <form action="includes/changePass.inc.php" method="POST">
                <!-- OLD PASS -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-unlock"></i></span>
                  <input
                    type="password"
                    name="old_pass"
                    placeholder="Old password"
                    required
                  />
                </div>
                <!-- NEW PASS -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-user-lock"></i></span>
                  <input
                    type="password"
                    name="new_pwd"
                    placeholder="New password"
                    required
                  />
                </div>
                <!-- REPEAT NEW PASS -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                  <input
                    type="password"
                    name="repeat_pwd"
                    placeholder="Repeat new password"
                    required
                  />
                </div>
                <input
                  class="button"
                  type="submit"
                  name="change"
                  value="CHANGE PASSWORD"
                />
              </form>
            </div>
              <?php 
                if (isset($_GET['error'])){
                    if($_GET['error'] == "passwordsdontmatch"){
                    echo "<p style='color:red'>New password don't match!</p>";
                    }
                    elseif($_GET['error'] == "oldpasswordsdontmatch"){
                    echo "<p style='color:red'>Old password invalid!</p>";
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
