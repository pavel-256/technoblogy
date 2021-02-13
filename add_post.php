<?php
require_once 'app/helper.php';
session_start(); // to stars session and remember for user

if (!user_auth()) {
    header('location: singin.php');
    exit; ///  signin  return when conection not from your site
}
$page_title = 'Add Post Form ';

$errors = [
    'title' => '',
    'article' => '',
];

if (isset($_POST['submit'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING); //xss attack ( Cross-Site Scripting Attacks )/
    $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); //xss attack ( Cross-Site Scripting Attacks )//
    $category = $_POST['select'];
    $form_valid = true; //// whe press submit +select option

    if (!$title || mb_strlen($title) < 2) {

        $form_valid = false;
        $errors['title'] = '*Title is required for min 2 chars'; //errorss
    }

    if (!$article || mb_strlen($article) < 2) {

        $form_valid = false;
        $errors['article'] = '*Article is required for min 2 chars'; // errors
    }

    if ($form_valid) {
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        $title = mysqli_real_escape_string($link, $title); //sql injection
        $aerticle = mysqli_real_escape_string($link, $article); //sql injections
        mysqli_query($link, "SET NAMES utf8");
        // mysqli_set_charset($link,'utf8');// option
        $uid = $_SESSION['user_id'];
        $sql = "INSERT INTO posts VALUES(null , $uid, '$title', '$article','$category', NOW())";
        $result = mysqli_query($link, $sql); // data base diteils

        if ($result && mysqli_affected_rows($link) > 0) {
            $_SESSION['add_post'] = true;
            header('location: blog.php'); // return to blog page
        }
    }
}

?>

<?php include 'tpl/header.php'?>

<main class="min-h620">
  <div class="container">
    <section id="main-add-post-content">
      <div class="row">
        <div class="col mt-5">
          <h1 class="display-3 text-info">Add Your New Post</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <form action="" method="POST" novalidate="novalidate" autocomplete="off">
            <div class="form-group">
              <label for="title">* Title:</label>
              <input value="<?=old('title')?>" type="text" name="title" id="title" class="form-control">
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
                <textarea class="form-control" name="article" id="article" cols="30" rows="10"><?=old('article')?></textarea>
                <span class="text-danger"><?=$errors['article'];?></span>
              </div>
              <input type="submit" value="Save Post" name="submit" class="btn btn-primary">
              <a class="btn btn-info" href="blog.php">Cancel</a>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>

