<?php
require_once 'app/helper.php';
session_start();
session_destroy();
header('location: signin.php');
