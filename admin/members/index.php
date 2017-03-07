<?php 
require_once("../../inc/config.php");
require_once(ROOT ."bootstrap.php");
require_once(ROOT ."inc/admin/admin_header.php");   
require_once(ROOT ."inc/admin/admin_navigation.php");    
?>
      
      
    <!-- Page Content -->
    <div class="container">
<?php
$db = new Post;
$all = $db->getPosts();
$total = $db->PostCount();
$post_count = 3;
?>
        
  <div class="row">
   <div class="row pagedisplay pull-left">
    <?php 
    $posts = Pagination::do_pagination('.',$total,$post_count,$all);?>
    </div> 
  <h1 class="page-header text-center">List of Posts</h1>
<div class="row">
<h4 class="text-center"><?php  display_message(); ?></h4>
  <div class="col-md-12">
    <?php if (!empty($posts)) {?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="text-center">Post Title</th>
          <th class="text-center">Post Author</th>
          <th class="text-center">Post Category</th>
          <th class="text-center">Post Image</th>
          <th class="text-center">Date Created</th>
          <th class="text-center"><a href="<?=ADMIN?>createPost" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
        <tbody>
        <?php foreach($posts as $post):?>
          <tr>
            <td class="text-center"><?=$post['posttitle']?></td>
            <td class="text-center"><?=$post['username']?></td>
            <td class="text-center"><?=$post['catname']?></td>
            <td class="text-center">
            <?php if(isset($post['postimage'])):?>
            <img src="<?=BASE_URL?>images/<?=$post['postimage']?>" class="img-responsive" width="50">
            <?php endif;?>
            </td>
            <td class="text-center"><?=formatDate($post['postdate'])?></td>
            
              <td class="text-center">
              <a href="<?=ADMIN?>post/editPost.php?edit=<?php echo $post['postid'];?>" class="glyphicon glyphicon-edit btn btn-primary"></a>
            </td> 
           
          
          </tr>
          <?php endforeach;?>
        </tbody>
      </thead>
    </table>
<?php }else{?>
    <div class="alert alert-info text-center">
      <?php echo "<h4>"."No posts to display"."</h4>";?>
    </div>
  <?php }?>
  </div>
</div>
  </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
 
  <?php require_once(ROOT ."inc/admin/admin_footer.php"); ?>
<?php
    $user = new User;
    if($user->is_loggedin() == "")
    {
    //send to login page
    $user->redirect("login");
    }
             $db->disconnect();
 ?>
 