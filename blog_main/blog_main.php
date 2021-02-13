<main class="min-h620">
  <div class="container">
    <section id="main-about-content">
      <div class="row">
        <div class="col my-4 ">
          <h1 class="display-3 text-info ">
            <?=$page_title?>
          </h1>
          <?php if (user_auth()): ?>
            <a class="btn btn-info" href="add_post.php"><i class="fas fa-plus"></i>Add New Post</a>
          <?php else: ?>
            <a href="signup.php"> Create acount and add post </a>
          <?php endif;?>
        </div>
      </div>
      <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <div class="row">
          <div class="col-12 mt-5 ">
            <h2 class='text-info ins'>-My Blog Posts-</h2>
            <div class="row">
              <?php while ($post = mysqli_fetch_assoc($result)): ?>
                <div class="col-12 mt-5 ">
                  <div class="card">
                    <div class="card-header card_header_blog">
                      <img width="70" src="images/<?=$post['profile_image'];?>" class="rounded-circle mr-3">
                      <span class="bloger_name"><?=htmlentities($post['name']);?></span>
                      <span class="float-right ml-5"><?=$post['pdate'];?></span>
                      <span class="float-right ">Category:&nbsp;<?=$post['category'];?></span>
                    </div>
                    <div class="card-body card_body_blog">
                      <h4><?=htmlentities($post['title']);?></h4>
                      <p><?=str_replace("\n", "<br>", htmlentities($post['article']));?></p>
                      <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                        <div class="float-right">
                          <div class="dropdown">
                            <a class="  text-decoration-none text-info" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-h fa-3x"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="edit_post.php?pid=<?=$post['id'];?>"><i class="fas fa-user-edit"></i>Edit</a>
                              <a class="delete-post-btn  dropdown-item" href="delete_post.php?pid=<?=$post['id'];?>"><i class="fas fa-trash-alt"></i>Delete</a>
                            </div>
                          </div>
                        </div>
                      <?php endif;?>
                    </div>
                  </div>
                </div>
              <?php endwhile;?>
            </div>
          <?php endif;?>
          </div>
    </section>
  </div>
</main>
<?php
include 'tpl/footer.php';
// session for the toastr alerts part
if (isset($_SESSION['toastr'])): ?>
  <script>
 toastr["success"]("Your profile have been updated successfully ")
  </script>
<?php unset($_SESSION['toastr']); // update profile toastr
endif?>

<?php
if (isset($_SESSION['add_post'])): ?>
<script>     // add post toastr
toastr["success"](" Your post have been added successfully")
</script>
<?php unset($_SESSION['add_post']);
endif?>

<?php
if (isset($_SESSION['update_post'])): ?>
  <script>   // update post toastr
  toastr["success"](" Your post have been edited successfully ")
  </script>
<?php unset($_SESSION['update_post']);
endif?>

<?php
if (isset($_SESSION['delete_post'])): ?>
  <script>   // delete post toastr
  toastr["success"](" Your post have been deleted successfully")
  </script>
<?php unset($_SESSION['delete_post']);
endif?>

