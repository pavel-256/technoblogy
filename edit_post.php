<?php
require_once 'app/helper.php';
session_start();

if (!user_auth()) {
    header('location: singin.php');
    exit;
}

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {

    $pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);

    if ($pid) {
        $uid = $_SESSION['user_id'];
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        mysqli_query($link, "SET NAMES utf8");

        $pid = mysqli_real_escape_string($link, $pid);
        $sql = "SELECT * FROM  posts WHERE id  = $pid AND user_id = $uid ";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) == 1) {

            $post = mysqli_fetch_assoc($result);
        } else {

            header('location: blog.php');
        }
    } else {

        header('location: blog.php');
        exit;
    }
} else {

    header('location: blog.php');
    exit;
}

$page_title = 'Edit Post Form ';

$errors = [
    'title' => '',
    'article' => '',
];

if (isset($_POST['submit'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $category = $_POST['select'];
    $form_valid = true;

    if (!$title || mb_strlen($title) < 2) {

        $form_valid = false;
        $errors['title'] = '*Title is required for min 2 chars';
    }

    if (!$article || mb_strlen($article) < 2) {

        $form_valid = false;
        $errors['article'] = '*Article is required for min 2 chars';
    }

    if ($form_valid) {

        $title = mysqli_real_escape_string($link, $title);
        $aerticle = mysqli_real_escape_string($link, $article);
        $sql = "UPDATE posts SET title = '$title', article = '$article',category = '$category'
        WHERE id = $pid  ";
        $result = mysqli_query($link, $sql);
        $_SESSION['update_post'] = true;
        header('location: blog.php');
    }
}

?>

<?php include 'tpl/header.php'?>

<main class="min-h620">
  <div class="container">
    <section id="main-add-post-content">
      <div class="row">
        <div class="col mt-5">
          <h1 class="display-3 text-info">Edit Your Post</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <form action="" method="POST" novalidate="novalidate" autocomplete="off">
            <div class="form-group">
              <label for="title">* Title:</label>
              <input value="<?=$post['title'];?>" type="text" name="title" id="title" class="form-control">
              <span class="text-danger"><?=$errors['title'];?></span>
              <label for="pet-select">*Choose a category:</label>

              <select name="select" id="select" name="select">
                <option value="Computers">Computers</option>
                <option value="Cell Phones">Cell Phones</option>
                <option value="Electric Scooters">Electric Scooters</option>
                <option value="Other">Other</option>
              </select>
              <div class="form-group">
                <label for="article">* Article:</label>
                <textarea class="form-control" name="article" id="article" cols="30" rows="10"><?=$post['article'];?></textarea>
                <span class="text-danger"><?=$errors['article'];?></span>
              </div>
              <input type="submit" value="Udate post" name="submit" class="btn btn-primary">
              <a class="btn btn-info" href="blog.php">Cancel</a>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include 'tpl/footer.php';
