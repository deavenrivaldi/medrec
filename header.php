<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Final Test</title>
    <link rel="stylesheet" href="css/index.css" />
    <script
      src="https://kit.fontawesome.com/68e1167060.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
    <body>
    <header>
    <nav class="navbar">
      <div class="max-width">
        <div class="logo">
          <img src="images/logo.png" alt="logo-img" />
        </div>
        <?php
            if(isset($_SESSION['uid'])){
                echo '<div class="sign_btn"><a href="includes/logout.inc.php">LOG OUT</a></div>';
            }
            else{
                echo '<div class="sign_btn"><a href="login.php">LOGIN</a></div>';
            }
        ?>
      </div>
    </nav>
    </header>
