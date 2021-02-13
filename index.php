<?php
require_once 'app/helper.php';
session_start();
$page_title = 'Home Page';
?>

<?php
include 'tpl/header.php';
?>
<main class="min-h620">
  <div class="container">
    <section id="main-top-content">
      <div class="row">
        <div class="col-12 text-center my-5 ">
          <h1 class="display-3 text-info"> Welcome To Technology Blog</h1>
          <p>An original home for technology news and reviews, Engadget produces the internet's most compelling videos, reviews, features and breaking news about the people, products and ideas shaping our world.</p>
          <p class="mt-4">
            <a href="signup.php" class="btn btn-outline-info btn-lg joinusButton mt-3 ">Join Us</a>
          </p>
        </div>
      </div>
    </section>
    <section id="main-center-content">
      <div class="row">
        <div class="col-md-4 ">
          <a href="computers.php">
            <h2 class="text-info">Computers</h2>
          </a>
          <p> All the innovations and news in the field of laptops and home pc, computer equipment and accessories,brands computer crafting and more.</p>
          <p class="zoom"><img src="images/computer2.jpg" width="340px" height="200px" class="card-img-top"></p>
        </div>
        <div></div>
        <div class="col-md-4">
          <a href="cell_phones.php">
            <h2 class="text-info">Cell Phones</h2>
          </a>
          <p> All the news and innovations in the field of cellular phones, new phones, brands, companies, development phones and more. <br></p>
          <p class="zoom"><img src="images/cell.jpg" width="340px" height="200px" class="card-img-top "></p>
        </div>
        <div class="col-md-4">
          <a href="electric_scooters.php" onclick="pavel()">
            <h2 class="text-info"> Electric Scooters</h2>
          </a>
          <p> All news and innovations in electric scooters, equipment, safety accessories, proper battery maintenance tips, new models and more.</p>
          <p class="zoom"><img src="images/scooter2.png" width="340px" height="200px" class="card-img-top"></p>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include 'tpl/footer.php';
if (isset($_SESSION['welcome_back'])): ?>
  <script>   // welcome back user toastr
  toastr["success"]('Welcome Back')
  </script>
<?php unset($_SESSION['welcome_back']);
endif?>
