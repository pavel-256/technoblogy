<?php
require_once 'app/helper.php';
session_start();

if (!user_auth()) {
    header('location: login.php');
    exit;
}

$page_title = 'Update profile';

$errors = [
    'name' => '',
    'password' => '',
    'submit' => '',
    'image_size' => '',
    'image_type' => '',
];

$id = $_SESSION['user_id'];
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
//PREVENT GIBBERISH IN CASE OF HEBREW POST ↓
mysqli_set_charset($link, 'utf8');

$sql = "SELECT u.name,u.password FROM users u
JOIN users_profile up ON u.id=up.user_id
WHERE u.id=$id "; /// query to data base for user ditails

$result = mysqli_query($link, $sql);
$user = mysqli_fetch_assoc($result);

$sql_for_posts = "SELECT title, article, id FROM posts WHERE user_id=$id ORDER BY id DESC  LIMIT 3 ";

$result_posts = mysqli_query($link, $sql_for_posts);

if (isset($_POST['submit'])) {

    if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING); ///xss attack
        $name = mysqli_real_escape_string($link, $name); /// sql ijection
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); ///xss attack
        $password = mysqli_real_escape_string($link, $password); /// sql ijection
        $form_valid = true;
        $profile_image = 'default_profile.png';
        define('MAX_FILE_SIZE', 1024 * 1024 * 2); //MAX FILE SIZE FOR THE IMAGE(DIFFERENT FROM PHP.INI)

        if (!preg_match("/[a-zA-Z0-9-א-ת]/", $name)) {
            $errors['name'] = '*Only English\Hebrew letters and numbers 0-9 allowed';
            $form_valid = false;
        } /// regular expration validation name

        if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 70) {

            $errors['name'] = '* Name is required for min 2 chars and max 70';
            $form_valid = false;
        }

        if (!$password || strlen($password) < 6 || strlen($password) > 20) {
            $errors['password'] = '* Password is required for min 6 chars and max 20';
            $form_valid = false;
        }

        if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {
            // $_FILE  diteils
            if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= MAX_FILE_SIZE) {

                if (isset($_FILES['image']['name'])) {

                    $allowed_ex = ['jpg', 'jpeg', 'png', 'gif', 'bmp']; // finals allowed
                    $ditails = pathinfo($_FILES['image']['name']);
                    if (in_array(strtolower($ditails['extension']), $allowed_ex)) {
                        if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) { // uploaded file tru HTTP POST
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
            $password = password_hash($password, PASSWORD_BCRYPT); // password encoraption
            $sql = "UPDATE users SET name='$name',password = '$password' WHERE id=$id";
            $result = mysqli_query($link, $sql);
            /// query to data base to update user ditails
            $sql2 = "UPDATE users_profile SET profile_image='$profile_image' WHERE user_id=$id";
            $result2 = mysqli_query($link, $sql2);

            /// session creation for updated ditails
            $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_image'] = $profile_image;
            $_SESSION['toastr'] = true;
            header('location: blog.php');
        }
    }
    $token = csrf();
} else { //xss attack ( Cross-Site Scripting Attacks )

    $token = csrf();
}

?>

<?php include 'tpl/header.php'?>
<main class="min-h620">
  <div class="container">
    <section id="main-top-content">
      <div class="row">
        <div class="col mt-3 ">
          <h2 class="display-3 text-info ">
          <?=$name ?? $user['name'] . ' ' . 'Profile'?>
          </h2>
        </div>
      </div>
      <div class="col-lg-6 float-right">

        <h2 class='text-info text-left display-5 p-0 m-0'>Your recent Posts</h2>

        <?php if (mysqli_num_rows($result_posts) > 0): ?>

          <?php while ($post = mysqli_fetch_assoc($result_posts)): ?>
            <a href="blog.php" class='text-decoration-none text-info '>
              <div class="card p-0 m-0 mt-3">
                <div class="card-header  text-info">
                  <span class='float-left'>
                    <?=$post['title']?>
                  </span>
                </div>
                <div class="card-body">
                  <p class='text-left article'>
                    <?=$post['article']?>
                  </p>
                </div>
              </div>
            </a>
          <?php endwhile?>
        <?php else: ?>
          <p class='text-white pt-5 mt-5'>No posts to show. Click <a href="blog.php" class='text-white'>Start writing</a> </p>
        <?php endif;?>

      </div>
    </section>
    <section id="sign-in-content">
      <div class="row">
        <div class="col-lg mt-3">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?=$token;?>">
            <div class="form-group">
              <label for="name">*Name:</label>
              <input type="name" value='<?=$name ?? $user['name']?>' name="name" id="name" class="form-control ">
              <span class="text-danger"><?=$errors['name'];?></span>
            </div><!--name-->
            <div class="form-group">
              <label for="email">*Password:</label>
              <input type="password" name="password" id="password" class="form-control">
              <span class="text-danger"><?=$errors['password'];?></span>
              <div class="form-group"><!--password errors-->
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
              </div>  <!--image size and type file errors-->
              <div class="text-danger float-right"> <?=$errors['image_size']?> </div>
              <div class="text-danger float-right"> <?=$errors['image_type']?> </div>
              <input type="submit" value="Update" class="btn btn-info" name="submit">
              <span class="text-danger"><?=$errors['submit'];?></span>
          </form>
        </div>
      </div>
    </section>
    <div align='center'>
      <span class="nav-item">
        <a class="nav-link text-white " href="my_profile.php"><img width="350" height="350" class="rounded-circle mr-3" src="images/<?=$_SESSION['user_image'];?>" alt=""></a>
      </span>
    </div>
  </div>
</main>

<?php include 'tpl/footer.php';
