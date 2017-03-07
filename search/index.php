<?php
require_once("../inc/config.php");
require_once(ROOT ."bootstrap.php");
$title = "Search";
$db = new Post;
$pages = $db->getPages();
require_once(ROOT."inc/public/front_header.php"); 
require_once(ROOT ."inc/public/front_navigation.php");
?>
<?php

$comments = $db->getComments();

  ?>
<?php if (isset($_REQUEST['submit'])) {
    $search = $_GET['search'];
    $posts = $db->getPostTag($search);

}
?>

   <!-- Page Content -->
  <div class="container">

   <div class="row">

  <div class="col-md-8">
  
              <div class="row"> 
     <?php 
if (empty($search)) {
    echo "<div class='alert alert-info text-center'><h2>"."input a search term."."</h2></div>";
}
elseif (!empty($posts) && !empty($search)) {?>
<?php foreach ($posts as $post):
      $Author = $db->getpostauthor($post['author']);?>

                <h3 style="text-align:center"><?=$post['posttitle']?></h3>
                <!-- Author -->
                <p class="lead">
                    by <a href="<?=BASE_URL?>posts/post.php?id=<?=$post['postid']?>"><?php echo ucfirst($Author['username']);?></a>
                </p>


                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=formatDate($post['postdate'])?></p>
                 <?php
               if (isset($post['postimage'])):?>
                  
                <img class="img-responsive" src="<?=BASE_URL?>images/<?=$post['postimage']?>" alt="">
               <?php endif;?>        
             
                <hr>
                 <p class="lead">
                <?=shortenText($post['postcontent'])?>  
                </p> 
               <a href="<?=BASE_URL?>posts/post.php?id=<?=$post['postid']?>" class="btn btn-primary">Read More</a>
                <hr>
<?php endforeach;?>
<?php }else{
    echo "<div class='alert alert-warning text-center'><h2>"."No results marches search term."."</h2></div>";
}
?>
</div>
  </div>
  <?php require_once(ROOT ."inc/public/front_sidebar.php"); ?>
</div>
</div>

<?php require_once(ROOT ."inc/public/front_footer.php"); ?>
