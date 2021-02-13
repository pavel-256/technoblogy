<?php
require_once 'app/helper.php';
session_start();
$page_title = 'Blog Page';
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, "SET NAMES utf8");
$sql = "SELECT u.name,up.profile_image,p. *,DATE_FORMAT(p.date,'%d/%m/%Y %H:%i:%s') pdate
        FROM posts p
        JOIN users  u ON u.id = p.user_id
        JOIN users_profile up ON u.id = up.user_id
        ORDER BY p.date DESC";
$result = mysqli_query($link, $sql);

?>
<?php include 'tpl/header.php';?>
<?php include 'blog_main/blog_main.php';
