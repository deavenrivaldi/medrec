<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Final Test</title>
    <link rel="stylesheet" href="css/dashboard.css" />
    <script
      src="https://kit.fontawesome.com/68e1167060.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <nav class="navbar">
      <div class="max-width">
        <?php if($_SESSION['uid'] == 20211201){
        echo '<div class="utilities">
          <div class="util_btn"> 
            <a href="regHospital.php"><span><i aria-hidden="true" class="fa fa-plus"></i></span>Register Hospital</a> 
          </div> 
          <div class="util_btn"> 
            <a href="regAdmin.php"><span><i aria-hidden="true" class="fa fa-plus"></i></span>Register Admin</a> 
          </div> 
        </div>' ;
        } else {
          echo '<div></div>' ;
        }
        ?>
        <div class="users">
          <a href="changePass.php">Change Password</a>
          <div class="sign_btn"><a href="includes/logout.inc.php">LOGOUT</a></div>
        </div>
      </div>
    </nav>
    <!-- SEARCH SECTION -->
    <section class="home" id="home">
      <div class="home-content">
        <div class="text-1">Welcome,</div>
        <?php
          if(isset($_SESSION['uid'])){
              echo '<div class="text-2">'.$_SESSION["name"].'</div> ';
          }
        ?>
        <!-- Search Bar -->
        <form action="searchResult.php" method="POST">
          <div class="top">
            <input
              type="search"
              class="searchbar"
              name="search"
              placeholder="Type to search..."
            />
            <button class="srch_btn" type="submit" name="submit"><i class="fas fa-search"></i></button>
          </div>
          <div class="bottom">
            <h3>Search by:</h3>

            <label class="radio-container">
              <input type="radio" id="ID" name="by" value="id" checked />
              by Patient ID
            </label>
            <label class="radio-container">
              <input type="radio" id="name" name="by" value="name" />
              by Patient Name
            </label>
          </div>
        </form>
        <!-- End of Search Bar -->
      </div>
      <div class="utilities">
        <div class="util_btn">
          <a href="addPatient.php"
            ><span><i aria-hidden="true" class="fa fa-plus"></i></span> Add
            Patient</a
          >
        </div>
        <h3>OR</h3>
        <div class="util_btn">
          <a href="addRecord.php"
            ><span><i aria-hidden="true" class="fa fa-plus"></i></span> Add
            Record</a
          >
        </div>
      </div>
    </section>
    <?php include_once 'footer.php'; ?>
</html>

