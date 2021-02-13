<?php

require_once 'app/helper.php';
session_start();

if (isset($_SESSION['user_id'])) {
    /// if conected send user to home page
    header('location: ./');
    exit;
}

$page_title = 'Sign up page';

$errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'submit' => '',
    'image_size' => '',
    'image_type' => '',
];

if (isset($_POST['submit'])) {

    if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {
        /// security
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING); ///xss attack
        $name = mysqli_real_escape_string($link, $name); /// sql ijection
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); ///xss attack
        $email = mysqli_real_escape_string($link, $email); /// sql ijection
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); ///xss attack
        $password = mysqli_real_escape_string($link, $password); /// sql ijection
        $form_valid = true;
        $profile_image = 'default_profile.png';
        define('MAX_FILE_SIZE', 1024 * 1024 * 2);

        if (!preg_match("/[a-zA-Z0-9-א-ת]/", $name)) {
            $errors['name'] = '*Only English\Hebrew letters and numbers 0-9 allowed';
            $form_valid = false; // regular exprasions
        }

        if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 70) {

            $errors['name'] = '* Name is required for min 2 chars and max 70';
            $form_valid = false;
        }

        if (!$email) {
            $errors['email'] = '* A valid email is required';
            $form_valid = false;
        } elseif (email_exist($link, $email)) {
            $errors['email'] = '* Email is taken';
            $form_valid = false; // email errorrs
        }

        if (!$password || strlen($password) < 6 || strlen($password) > 20) {
            $errors['password'] = '* Password is required for min 6 chars and max 20';
            $form_valid = false; // password max min lenght and errors
        }

        if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {
            // $_FILE  diteils
            if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= MAX_FILE_SIZE) {

                if (isset($_FILES['image']['name'])) {
                    // image upload validation
                    $allowed_ex = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                    $ditails = pathinfo($_FILES['image']['name']);
                    if (in_array(strtolower($ditails['extension']), $allowed_ex)) {
                        if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
                            $profile_image = date('Y.m.d.H.i.s') . '-' . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $profile_image);
                        }
                    } else {
                        $form_valid = false;
                        $errors['image_type'] = '*Only jpg-jpeg-png-gif-bmp file';
                    }
                }
            } else {
                $form_valid = false;
                $errors['image_size'] = '* Max file size is 2mb';
            }
        }

        if ($form_valid) {

            $password = password_hash($password, PASSWORD_BCRYPT); // password Encryption
            $sql = "INSERT INTO users VALUES(null, '$name', '$email', '$password')";
            $result = mysqli_query($link, $sql); // query to our database

            if ($result && mysqli_affected_rows($link) > 0) {

                $new_user_id = mysqli_insert_id($link);
                $sql = "INSERT INTO users_profile VALUES(null,$new_user_id,'$profile_image')";
                $result = mysqli_query($link, $sql); //query to our database- profile image

                if ($result && mysqli_affected_rows($link) > 0) {

                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['user_id'] = $new_user_id;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_image'] = $profile_image;
                    header('location: blog.php');
                    exit;
                }
            }
        }
    }
    // for security  //xss attack ( Cross-Site Scripting Attacks )
    $token = csrf();
} else {

    $token = csrf();
}

?>


<?php include 'tpl/header.php'?>
<main class="min-h620">
  <div class="container">
    <section id="main-top-content">
      <div class="row">
        <div class="col mt-3 ">
          <h1 class="display-3 text-info ">
            Sign up for new acount
          </h1>
        </div>
      </div>
    </section>
    <section id="sign-in-content">
      <div class="row">
        <div class="col-lg-6 mt-3">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?=$token;?>">
            <div class="form-group"><!-- for security  //xss attack ( Cross-Site Scripting Attacks )-->
              <label for="name">*Name:</label>
              <input type="name" value="<?=old('name')?>" name="name" id="name" class="form-control ">
              <span class="text-danger"><?=$errors['name'];?></span>
            </div>
            <div class="form-group">
              <label for="email">*Email:</label>
              <input type="email" value="<?=old('email')?>" name="email" id="email" class="form-control">
              <span class="text-danger"><?=$errors['email'];?></span>
            </div>
            <div class="form-group">
              <label for="email">*Password:</label>
              <input type="password" name="password" id="password" class="form-control">
              <span class="text-danger"><?=$errors['password'];?></span>
              <div class="form-group">
                <label for="image">Profile Image:</label>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="image-field" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>
              <div class="text-danger float-right"> <?=$errors['image_size']?> </div>
              <div class="text-danger float-right"> <?=$errors['image_type']?> </div>
              <input type="submit" value="Singnup" class="btn btn-info" name="submit">
              <span class="text-danger"><?=$errors['submit'];?></span>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include 'tpl/footer.php'?>
