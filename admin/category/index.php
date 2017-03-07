<?php
    require_once("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    include(ROOT ."inc/admin/admin_header.php");   
    include(ROOT ."inc/admin/admin_navigation.php");
    
    $db = new Post;
    $all = $db->getCat();
    $total = $db->catCount();
    $catnum = 2;
    ?>
<h1 class="page-header text-center">Blog Categories</h1>
<div class="row">

<div class="col-md-2">

  </div>
  <div class="col-md-8">
  <div class="row pagedisplay pull-left">
    <?php $categories = Pagination::do_pagination('.',$total,$catnum,$all);?>
  </div>
   <?php display_message();?>
    <?php if (!empty($categories)) {?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="text-center">Category Number</th>
          <th class="text-center">Category Name</th>
          <th class="text-center"><a href="../createCategory" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
        <tbody>
        <?php foreach($categories as $category):
           ?>
          <tr>
            <td class="text-center"><?=$category['catid']?></td>
            <td class="text-center"><?=$category['catname']?></td>
          <td class="text-center"><a href="editcategory.php?edit=<?php echo $category['catid'];?>" class="glyphicon glyphicon-edit btn btn-primary"></a>
            <a href="index.php?delete=<?php echo $category['catid'];?>" class="glyphicon glyphicon-trash btn btn-danger pull-right" onclick="return confirm('Are you sure?');"></a></td> 
          </tr>
          <?php endforeach;?>
        </tbody>
      </thead>
    </table>
<?php }else{?>
    <div class="alert alert-info text-center">
      <?php echo "<h4>"."No categories to display"."</h4>";?>
    </div>
  <?php }?>
  </div>
  <div class="col-md-2">

  </div>
</div>
  </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
 <?php include(ROOT ."inc/admin/admin_footer.php");?>

     <?php 
  //allow only logged in admin

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
