<?php
require_once("../inc/config.php");
require_once(ROOT ."bootstrap.php");
$title = "About";
$db = new Post;
$pages = $db->getPages();
require_once(ROOT."inc/public/front_header.php"); 
require_once(ROOT ."inc/public/front_navigation.php");
?>
<?php
$page = $db->getPageT(strtoupper($title));

  ?>


   <!-- Page Content -->
  <div class="container">
   <br>
      <br>
   <div class="row">
  <div class="col-md-8">
  
      <h3 style=""><?=$page['title']?></h3>
      <p class="lead"><?=$page['body']?>.</p> 
      <br>
      <br> 
      <br>
      <br> 
      <br>
      <br>     
   </div>
   <?php require_once(ROOT ."inc/public/front_sidebar.php"); ?>
</div>
  
</div>

<?php require_once(ROOT ."inc/public/front_footer.php"); ?>
