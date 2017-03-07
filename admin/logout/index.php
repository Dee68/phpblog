<?php
include("../../inc/config.php");
include("../../bootstrap.php");
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['role'])) {
  session_destroy();
  header("location:../login/");
}
header("location:../login/");
 ?>
