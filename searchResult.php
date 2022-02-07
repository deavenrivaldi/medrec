<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Result</title>
    <link rel="stylesheet" href="css/search.css" />
    <script
      src="https://kit.fontawesome.com/68e1167060.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <nav class="navbar">
      <div class="max-width">
        <div class="logo"><a href="dashboard.php"><img src="images/logo.png" alt="logo.inc" /></a></div>
        <div class="sign_btn"><a href="index.php">LOGOUT</a></div>
      </div>
    </nav>
    <!-- RESULT SECTION -->
    <section class="result" id="result">
      <div class="result-content">
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
              <input type="radio" id="ID" name="by" value="id" checked/>
              by Patient ID
            </label>
            <label class="radio-container">
              <input type="radio" id="name" name="by" value="name" />
              by Patient Name
            </label>
          </div>
        </form>
        <!-- End of Search Bar -->
        <!-- Result list  -->
        <?php
            if(isset($_POST['submit'])){
                $connection = mysqli_connect('localhost', 'deaven', '12345', 'medrec');
                $search = mysqli_real_escape_string($connection, $_POST['search']);
                $filter = $_POST['by'];
                
              //check if filtered by id
              if($filter == 'id'){
                $sql = "SELECT * FROM patient_info WHERE patient_id = '$search'";
                $result = mysqli_query($connection, $sql);
                $queryResult = mysqli_num_rows($result);

                if ($queryResult > 0){ 
                    echo "<div class='result-title'>".$queryResult." results for '$search'</div>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='result-card'>
                                <div class='col-left'>
                                    <img src='patients_img/" . $row['image_url'] . "' alt='pp' />
                                </div>
                                <div class='col-right'>
                                    <p>".$row['full_name']."</p>
                                    <p>".$row['patient_id']."</p>
                                    <p>".$row['gender']."</p>
                                    <p>".$row['address']."</p>
                                    <div class='link'>
                                      <a href='record.php?id=". $row['patient_id'] ."'>Show More...</a>
                                    </div>
                                </div>
                              </div>";
                    }
                } 
                else{
                    echo "<div class='result-title'>There are no results matching your search!</div>";
                }
              } 
              //check if filtered by name
              elseif($filter == 'name')  {
                $sql = "SELECT * FROM patient_info WHERE full_name LIKE '%$search%' ORDER BY full_name";
                $result = mysqli_query($connection, $sql);
                $queryResult = mysqli_num_rows($result);

                if ($queryResult > 0){
                    echo "<div class='result-title'>".$queryResult." results for '$search'</div>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='result-card'>
                                <div class='col-left'>
                                    <img src='patients_img/" . $row['image_url'] . "' alt='pp' />
                                </div>
                                <div class='col-right'>
                                    <p>".$row['full_name']."</p>
                                    <p>".$row['patient_id']."</p>
                                    <p>".$row['gender']."</p>
                                    <p>".$row['address']."</p>
                                    <div class='link'>
                                      <a href='record.php?id=". $row['patient_id'] ."'>Show More...</a>
                                    </div>
                                </div>
                              </div>";
                    }
                } 
                else{
                    echo "<div class='result-title'>There are no results matching your search!</div>";
                }
              }
            } else{
              header('location: dashboard.php');
              exit();
            }
        ?>
      </div>
    </section>
    <?php include_once 'footer.php'; ?>
</html>