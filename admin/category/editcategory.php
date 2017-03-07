<?php
    require_once("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    include(ROOT ."inc/admin/admin_header.php");   
    include(ROOT ."inc/admin/admin_navigation.php");
    $db = Database::getInstance();
    ?>
<?php
if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $sql = "SELECT * FROM category WHERE catid=?";
  $params = [$id];
  $category = $db->getOne($sql,$params);
  $catname = $category['catname'];
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postcat = trim($_POST['catname']);
    $sql1 = "UPDATE category SET catname=? WHERE catid=?";
    $params1 = [$postcat,$id];
    $cat = $db->updateData($sql1,$params1);
    if ($cat == FALSE) {
      set_message("category successfully updated");
      $db->redirect("index.php");
    }
   $error_msg = "Error updating category";
  }
  
?>
<h1 class="page-header text-center">Edit Category</h1>
<div class="row">
  <div class="col-md-2">

  </div>
  <div class="col-md-8">
    <form method="post" action="">
     <?php if (isset($error_msg)): ?>
    <p style="color:red;">
      <?php echo $error_msg; ?>
    </p>
      
      <?php endif; ?>
    <div class="form-group">
    <label for="catname">Category</label>
    <input type="text" name="catname" class="form-control" value="<?php if(isset($catname)) echo $catname;?>">
    </div>
    
   <input type="submit" class="btn btn-primary" value="Update Category"> 
    </form>
  </div>
  <div class="col-md-2">

  </div>
</div>
<?php include(ROOT ."inc/admin/admin_footer.php");?>
<?php 
  //allow only logged in users

    $user = new User;
    if($user->is_loggedin() == "")
    {
    //send to login page
    $user->redirect("../login");
    }
    //close database connection
      $db->disconnect();
     ?>
