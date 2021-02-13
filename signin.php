<?php
require_once 'app/helper.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('location: ./');
    exit;
} // when log in auto to home page evertime afer another site
$page_title = 'Sign in page'; // header.php affect to title
$errors = [ // errors apiar when wrong or not
    'email' => '',
    'password' => '',
    'submit' => '',
];

// If Client click on submit button
if (isset($_POST['submit'])) {

    if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {
        // Collect client data to variables
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); //xss attack ( Cross-Site Scripting Attacks )//
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); //xss attack ( Cross-Site Scripting Attacks )//

        if (!$email) {
            // email and pass check write or empty
            $errors['email'] = '* A valid email is required';
        } elseif (!$password) {
            $errors['password'] = '* Please enter your password';
        } else {
            // conection  to our data badsse to the table we want
            $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
            $email = mysqli_real_escape_string($link, $email); // sql injection
            $password = mysqli_real_escape_string($link, $password); // sql injection
            $sql = "SELECT u.*,up.profile_image FROM users u
      JOIN users_profile up ON u.id = up.user_id
      WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($link, $sql);
            // if the user write ok data he trans to home page and use the name and id in header.php create session to user browaser
            if ($result && mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                // data from $_SERVER and $user = mysqli_fetch_assoc($result)
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR']; // ip check
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT']; //os check
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_image'] = $user['profile_image'];
                    $_SESSION['welcome_back'] = true;
                    header('location:./');
                    exit;
                } else {

                    $errors['submit'] = '* Wrong email or password';
                }
            } else {
                $errors['submit'] = '* Wrong email or password';
            }
        }
    }
    $token = csrf();
} else {

    $token = csrf();
}

?>
<?php
include 'tpl/header.php';
?>
<main class="min-h620">
  <div class="container">
    <section id="main-top-content">
      <div class="row">
        <div class="col mt-3 ">
          <h1 class="display-3 text-info ">
            Sign in with your acount
          </h1>
        </div>
      </div>
    </section>
    <section id="sign-in-content">
      <div class="row">
        <div class="col-lg-6 mt-3">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate">
            <input type="hidden" name="csrf_token" value="<?=$token;?>">
            <div class="form-group">
              <label for="email">*Email:</label>
              <!--dont delete every time reload-->
              <input type="email" value="<?=old('email')?>" name="email" id="email" class="form-control">
              <span class="text-danger"><?=$errors['email'];?></span>
            </div>
            <div class="form-group">
              <label for="email">*Password:</label>
              <input type="password" name="password" id="password" class="form-control">
              <span class="text-danger"><?=$errors['password'];?></span>
            </div>
            <input type="submit" value="Singnin" class="btn btn-info" name="submit">
            <span class="text-danger"><?=$errors['submit'];?></span>

          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include 'tpl/footer.php';
