<?php
require_once 'app/helper.php';
session_start();
$page_title = 'About Us';
?>


<?php
include 'tpl/header.php';
?>
<main class="min-h620">
  <div class="container">
    <section id="main-about-content">
      <div class="row">
        <div class="col my-4 ">
          <h1 class="display-4 text-info ">
            About Technoblogy
          </h1>
          <p class="col  textAbout">Technoblogy was founded in 2019 by a web development student for the mid-course project. The goal of this site is to show surfers blog that talks about cellular, computers and new technology that affects our lives.</p>
        </div>
      </div>
      <div class="card mypicard" style="width: 18rem;">
        <img src="images/me.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <i class="card-text myProfileText">Pavel Lutcenko, The Founder </i><br>
          <a href="https://www.facebook.com/paveliko.ly" target="blank"><i class="fab fa-facebook-square fa-2x"></i></a>
          <a href="https://api.whatsapp.com/send?phone=0544808552"> <i class="fab fa-whatsapp fa-2x text-success"></i></a>
          <i class="fab fa-google fa-2x"></i>
          <i class="fas fa-at fa-2x"></i>
        </div>

      </div>

    </section>
  </div>
</main>
<?php include 'tpl/footer.php';
