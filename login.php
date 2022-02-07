<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap"
      rel="stylesheet"
    />
  </head>
<body>
    <section class="login" id="login">
      <div class="max-width">
        <div class="container">
          <div class="card">
            <div class="title">
              <img src="images/logo.png" alt="logo.inc">
            </div>
            <div class="">
              <form action="includes/login.inc.php" method="POST">
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-user"></i></span>
                  <input
                    type="text"
                    name="uid"
                    placeholder="ENTER USER ID"
                    required
                  />
                </div>
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                  <input
                    type="password"
                    name="pwd"
                    placeholder="ENTER PASSWORD"
                    required
                  />
                </div>
                <input
                  class="button"
                  type="submit"
                  name="submit"
                  value="LOGIN"
                />
              </form>
            </div>
            <?php 
              if (isset($_GET['error'])){
                if($_GET['error'] == "UIDdoesntexists"){
                  echo "<p style='color:red'>User ID doesn't exists!</p>";
                }
                elseif ($_GET['error'] == "wrongpassword"){
                  echo "<p style='color:red'>Incorrect password!</p>";
                }
              }
            ?>
          </div>
          <div class="navigator">
            <span><a href="index.php">Home</a> | <a href="">Forgot Password</a></span>
          </div>
        </div>
      </div>
  </section>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  <?php include_once 'footer.php'; ?>
</body>
</html>