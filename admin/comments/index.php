<?php
    require_once("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    require_once(ROOT ."inc/admin/admin_header.php");   
    require_once(ROOT ."inc/admin/admin_navigation.php"); 
    $page_header = "Comments";?>
    <!-- Page Content -->
    <div class="container">
<?php $db = new Post;
$all = $db->getComments();//
$total = $db->comCount();
$com_count = 4;
?>
<div class="row">
  <div class="row pagedisplay pull-left">
    <?php $comments = Pagination::do_pagination('.',$total,$com_count,$all);?>
  </div> 
<h1 class="page-header text-center"><?=$page_header?></h1>
<div class="row">
<h4 class="text-center"><?php  display_message(); ?></h4>
  <div class="col-md-12">
    <?php if(!empty($comments)):?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="text-center">Post</th>
          <th class="text-center">Comment</th>
          <th class="text-center">Author</th>
          <th class="text-center">Date Created</th>
          <th class="text-center"></th>
        </tr>
        <tbody>
          <?php foreach($comments as $comment):
                $title = $db->getpost($comment['post']);
                $author = $db->getauthor($comment['post']);//commentator
                ?>
          <tr>
            <td class="text-center"><?=$title['posttitle']?></td>
            <td class="text-center"><?=$comment['comment']?></td>
            <td class="text-center"><?=$author['username']?></td>
            <td class="text-center"><?=formatDate($comment['comDate'])?></td>
          <td class="text-center">
            <a href="index.php?delete=<?=$comment['id']?>" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Are you sure?');"></a></td> 
          </tr>
          <?php endforeach;?>
        </tbody>
      </thead>
    </table>
<?php else:?>
    <div class="alert alert-info text-center">
      <?php echo "<h4>"."No pages to display"."</h4>";?>
    </div>
  <?php endif;?>
  </div>
</div>
  </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    <?php
     if (isset($_GET['delete'])) {
            $id = intval($_GET['delete']);
           
            $db->delcomment($id);
            
            set_message("Post with ID:{$id} successfully deleted");
           
          }
          ?>

  <?php require_once(ROOT ."inc/admin/admin_footer.php");?>
<?php //
     $user = new User;
    if($user->is_loggedin() == "")
    {
    //send to login page
    $user->redirect("../login");
    }elseif ($_SESSION['role'] != 2) {
      $user->redirect("../error");
    }else{
      
    } 
    //close database connection
      $db->disconnect();
    ?>

