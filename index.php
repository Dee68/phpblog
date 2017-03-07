<?php 
require_once("inc/config.php");
require_once("bootstrap.php");
$page_header = "Php Blog";
$db = new Post;
$pages = $db->getPages();
include(TEMPLATE_FRONT ."header.php"); 
?>
<?php include(TEMPLATE_FRONT ."navigation.php"); ?>
   <!-- Page Content -->
    <div class="container">

        
<!-- Blog Post Content Column -->
     <?php include(TEMPLATE_FRONT ."content.php"); ?>

            <!-- Blog Sidebar Widgets Column -->
        <?php include(TEMPLATE_FRONT ."sidebar.php"); ?>

      
        <!-- /.row -->

     <?php include(TEMPLATE_FRONT ."footer.php"); ?>?>
