<?php 
require_once("../inc/config.php");
require_once(ROOT ."bootstrap.php");
$title = "Posts";
$db = new Post;
$pages = $db->getPages();
require_once(ROOT."inc/public/front_header.php"); 
require_once(ROOT ."inc/public/front_navigation.php"); 
?>

    <div class="container">

        <div class="row">
<!-- Blog Post Content Column -->
          <div class="col-lg-8">
    <?php 
     //$db = new Post;
     $comments = $db->getComments();
     if (isset($_GET['category'])) {
       $category = intval($_GET['category']);
     }
    $posts = $db->getpostCat($category);
?>
  <?php if($posts) {?>          
  <!-- Blog Post -->
<?php foreach($posts as $post):?>
    <?php $id = intval($post['postid']);
       $username = $db->getpostauthor($post['author']);

       ?>
                <!-- Title -->
                <h1><?=$post['posttitle']?></h1>
 
                <!-- Author -->
                <p class="lead">
                    by <a href="<?=BASE_URL?>posts/post.php?id=<?=$id?>"><?php echo ucfirst($username['username']);?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=formatDate($post['postdate'])?></p>

                <hr>
                 <?php if(isset($post['postimage'])):?>
                <!-- Preview Image -->
                <img class="img-responsive" src="<?=BASE_URL?>images/<?=$post['postimage']?>" alt="">         
               <?php endif;?>
                <hr>
  
                <!-- Post Content -->
                <p class="lead">
                <?=shortenText($post['postcontent'])?>  
                </p> 
               <a href="<?=BASE_URL?>posts/post.php?id=<?=$id?>" class="btn btn-primary">Read More</a>
                <hr>

                <!-- Blog Comments -->
         <?php foreach($comments as $comment):?>
            <?php if($comment['post'] == $id){
                    $Author = $db->getauthor($comment['post']);?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" width="50" height="50" src="<?=BASE_URL?>images/avatar.png" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?=$Author['username']?>
                            <small><?=formatDate($comment['comDate'])?></small>
                        </h4>
                        <?=$comment['comment']?>
                    </div>
                </div>
                <?php }else{

                    }?>
             <?php endforeach;?>   

                
      <?php endforeach;?>
       <?php }else{
        echo "<div class='alert alert-info'>"."No post to display in this category"."</div>";
        }?>
              <?php //close database 
              $db->disconnect();?>  
            </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include(ROOT ."inc/public/front_sidebar.php"); ?>

        </div>
        <!-- /.row -->

     <?php include(TEMPLATE_FRONT ."footer.php"); ?>
