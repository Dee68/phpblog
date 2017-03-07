<div class="row"> 
<?php 
$db = new Post;
$all = $db->getPosts();
$comments = $db->getComments();
$total = $db->PostCount();
$post_count = 2;
?>
        <div class="col-lg-8">

  <?php display_message();?>
   <div class="row pagedisplay pull-left">
          <?php 
              $posts = Pagination::do_pagination('.',$total,$post_count,$all);
                 ?>
              </div> 
              <div class="row"> 
              
  <!-- Blog Post -->
<?php foreach($posts as $post):?>
    <?php $id = intval($post['postid']);?>
   
                <!-- Title -->
                <h3 style="text-align:center"><?=$post['posttitle']?></h3>
 
                <!-- Author -->
                <p class="lead">
                    by <a href="posts/post.php?id=<?=$id?>"><?php echo ucfirst($post['username']);?></a>
                </p>


                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=formatDate($post['postdate'])?></p>

               
                <?php
               if (isset($post['postimage'])):?>
                  
                <img class="img-responsive" src="<?=BASE_URL?>images/<?=$post['postimage']?>" alt="">
               <?php endif;?>        
             
                <hr>
  
                <!-- Post Content -->
                <p class="lead">
                <?=shortenText($post['postcontent'])?>  
                </p> 
               <a href="posts/post.php?id=<?=$id?>" class="btn btn-primary">Read More</a>
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
        
              <?php //close database 
              $db->disconnect();?>  
            </div>
            </div>