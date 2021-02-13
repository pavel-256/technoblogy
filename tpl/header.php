<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css_folder/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <title>TechnoBlogy | <?=$page_title?></title>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container">
        <a class="navbar-brand text-white" href="index.php"> <i class="fas fa-plug fa-lg"></i>
          <span id="main_icon">TechnoBlogy</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="blog.php">Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php if (!user_auth()): ?>
              <li class="nav-item">
                <a class="nav-link text-white mr-3" href="signin.php">Sign in</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="signup.php">Sign up</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link text-white " href="my_profile.php"><img width="40" height="40" class="rounded-circle mr-3" src="images/<?=$_SESSION['user_image'];?>" alt=""><?=$_SESSION['user_name'];?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="logout.php">Log Out</a>
              </li>
            <?php endif?>
          </ul>
        </div>
      </div>
    </nav>
  </header>