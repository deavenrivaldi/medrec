<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report</title>

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="css/report.css" />
  </head>
  <body>
    <section>
      <div class="max-width">
        <div class="container">
          <div class="card">
            <div class="title">
              <h2>MEDICAL REPORT</h2>
            </div>
            <div class="">
              <form action="includes/addRecord.inc.php" method="POST">
                <!-- PATIENT ID -->
                <div class="select_option">
                  <select
                    class="w-100"
                    name="patient_id"
                    id="patient_id"
                    data-live-search="true"
                    data-size="7"
                    required
                  >
                  <option style="display:none">Patient's ID</option>
                  <?php
                      $connection = mysqli_connect('localhost', 'deaven', '12345', 'medrec');
                      $sql1 = "SELECT patient_id, full_name FROM patient_info ORDER BY full_name asc;";
                      $result1 = mysqli_query($connection, $sql1);
                      while($row1 = mysqli_fetch_assoc($result1)):;
                      ?>
                      <option value="<?php echo $row1['patient_id']?>"><?php echo $row1['patient_id'].", ".$row1['full_name'];?></option>
                  <?php endwhile; ?>
                  </select>
                </div>
                <!--Checkup Date -->
                <div>Checkup date</div>
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-calendar"></i></span>
                  <input
                    type="date"
                    name="checkup_date"
                    placeholder="Checkup date"
                    required
                  />
                </div>
                <!-- All doctor's specialty -->
                <div class="select_option">
                  <select
                    class="w-100"
                    name="doctor"
                    id="doctor"
                    data-live-search="true"
                    data-size="7"
                    required
                  >
                    <!-- https://id.wikipedia.org/wiki/Dokter_spesialis#Sub-spesialis_/_konsultan -->
                    <option style="display:none">Select doctor's specialization</option>
                    <?php 
                      $connection = mysqli_connect('localhost', 'deaven', '12345', 'medrec');
                      $sql1 = "SELECT DISTINCT category FROM doctor_specialization;";
                      $label_result = mysqli_query($connection, $sql1);
                      //$label_row = mysqli_fetch_array($label_result);
                      while($label_row = mysqli_fetch_assoc($label_result)){
                    ?>
                        <optgroup label=<?php echo $label_row['category'] ?>>
                    <?php
                        $sqla = "SELECT honorary, specialization FROM doctor_specialization WHERE category='$label_row[category]';";
                        $resulta = mysqli_query($connection, $sqla);    
                        while($rowa = mysqli_fetch_assoc($resulta)){ ?>
                          <option value="<?php echo $rowa["honorary"]?>"><?php echo $rowa["specialization"]?></option>
                    <?php    } ?>
                        </optgroup>
                    <?php  } ?>   
                  </select>
                </div>
                <!-- All possible medical actions -->
                <div class="select_option">
                  <select
                    class="w-100"
                    name="action"
                    id="action"
                    data-live-search="true"
                    data-size="5"
                    required
                  >
                    <!-- https://www.alomedika.com/tindakan-medis -->
                    <option style="display:none">Select medical action</option>
                    <option value="discharge">Discharge</option>
                    <option value="medical check-up">Medical check up</option>
                    <option value="operasi">Operasi</option>
                    <option value="rawat inap">Rawat inap</option>
                    <option value="rawat jalan">Rawat jalan</option>
                    <option value="swab test">Swab test</option>
                    <option value="test pack">Test pack</option>
                  </select>
                </div>
                <!-- All possible diagnosis -->
                <div class="select_option">
                  <select
                    class="w-100"
                    name="diagnosis"
                    id="diagnosis"
                    data-live-search="true"
                    data-size="5"
                  >
                    <!--  -->
                    <option style="display:none" value="">Select diagnosis</option>
                    <?php 
                      $connection = mysqli_connect('localhost', 'deaven', '12345', 'medrec');
                      $sql1 = "SELECT DISTINCT category FROM diagnosis_list;";
                      $label_result = mysqli_query($connection, $sql1);
                      //$label_row = mysqli_fetch_array($label_result);
                      while($label_row = mysqli_fetch_assoc($label_result)){
                    ?>
                        <optgroup label=<?php echo $label_row['category'] ?>>
                    <?php
                        $sqla = "SELECT diagnosis, value FROM diagnosis_list WHERE category='$label_row[category]' ORDER BY diagnosis asc;";
                        $resulta = mysqli_query($connection, $sqla);    
                        while($rowa = mysqli_fetch_assoc($resulta)){ ?>
                          <option value="<?php echo $rowa["value"]?>"><?php echo $rowa["diagnosis"]?></option>
                    <?php    } ?>
                        </optgroup>
                    <?php  } ?>   
                  </select>
                </div>
                <!-- NOTE -->
                <div class="input_field">
                  <span><i aria-hidden="true" class="fa fa-comment-alt"></i></span>
                  <input
                    type="text"
                    name="note"
                    placeholder="Note"
                  />
                </div>
                <input
                  class="button"
                  type="submit"
                  name="submit"
                  value="SUBMIT"
                />
              </form>
            </div>
            <?php 
                if (isset($_GET['error'])){
                    if($_GET['error'] == "patientnotregistered"){
                    echo "<p style='color:red'>Patient is not registered!</p>";
                    }
                    elseif ($_GET['error'] == "invalidnote"){
                    echo "<p style='color:red'>Note must only contain alphabets and numbers!</p>";
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
