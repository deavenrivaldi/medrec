<!DOCTYPE html>
<html lang="en">
    <?php include_once 'header.php';?>

    <!-- SEARCH SECTION -->
    <section class="home" id="home">
      <div class="upper">
        <div class="home-content">
          <div class="text-1">
            MedRec~
          </div>
          <div class="text-2">Lorem ipsum dolor sit amet.</div>
          <form action="login.php">
            <input type="text" class="searchbar" name="search" placeholder="Type to search...">
            <button class="srch_btn"><i class="fas fa-search"></i></button>
          </form>
        </div>
        <img src="images/doctor.png" alt="doctor-img" />
      </div>
      <div class="middle">
        <img src="images/text1.png" alt="text1" />
        <div class="home-content">
          <div class="text-3">EDIT and ADD medical records DIRECTLY</div>
          <div class="try_btn"><a href="#home">Try Now!</a></div>
        </div>
      </div>
      <div class="lower">
        <div class="home-content">
          <div class="text-4">SAFE and EASY to SEARCH record</div>
          <div class="try_btn"><a href="#home">Try Now!</a></div>
        </div>
        <img src="images/text2.png" alt="text2" />
      </div>
    </section>

    <?php include_once 'footer.php'; ?>
</html>
