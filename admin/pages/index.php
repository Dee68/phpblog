<?php
    include("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    require_once(ROOT ."inc/admin/admin_header.php");   
    require_once(ROOT ."inc/admin/admin_navigation.php"); ?>
    <!-- Page Content -->
    <div class="container">
<?php 
$db = new Post;
$user = new User;
$pages = $db->getPages();

?>

        <div class="row">
<h1 class="page-header text-center">Pages Created</h1>
<div class="row">
<?php display_message();?>
  <div class="col-md-12">
  <?php if(!empty($pages)){?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="text-center">Page Title</th>
          <th class="text-center">is_Published</th>
          <th class="text-center">Date Created</th>
          <th><a href="<?=ADMIN?>createPage" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
        <tbody>
         <?php foreach($pages as $page):?>
         <?php if($page['is_published']==1):
              $pageicon = 'glyphicon glyphicon-ok';?>
            <?php else:
              $pageicon ='glyphicon glyphicon-remove'; ?>
            <?php endif;?> 
          <tr>
            <td class="text-center"><?=$page['title']?></td>
            <td class="text-center"><span class="<?=$pageicon?>"></span></td>
            <td class="text-center"><?=formatDate($page['created_date'])?></td>
          <td class="text-center"><a href="<?=ADMIN?>pages/editpage.php?id=<?=$page['pageid']?>" class="glyphicon glyphicon-edit btn btn-primary"></a>
            <a href="<?=ADMIN?>pages/index.php?delete=<?=$page['pageid']?>" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Are you sure?');"></a></td>
          </tr>
           <?php endforeach;?>
        </tbody>
      </thead>
    </table>
<?php }else{?>
    <div class="alert alert-info text-center">
      <?php echo "<h4>"."No pages to display"."</h4>";?>
    </div>
  <?php }?>
  </div>
</div>
  </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
   <?php 
   if (isset($_GET['delete'])) {

            $id = intval($_GET['delete']);
            
            $db->delPage($id);
            
            set_message("Post with ID:{$id} successfully deleted");
            header("Refresh:2; url=.");
           
          }
          ?>

  <?php include(ROOT ."inc/admin/admin_footer.php");?>
<?php //
    if($user->is_loggedin() == "")
    {
    //send to login page
    $user->redirect("../login");
    }elseif ($_SESSION['role'] != 2) {
      $user->redirect("../error");
    }else{
      
    } 
    //close database connection
      $user->disconnect();
    ?>

