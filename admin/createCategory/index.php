<?php
    require_once("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    include(ROOT ."inc/admin/admin_header.php");   
    include(ROOT ."inc/admin/admin_navigation.php");
    $db = Database::getInstance();
    ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $catname = trim($_POST['catname']);
  //validate fields
  $valid = new Validation;
  if ($valid->validEmpty($catname)) {
    $error_msg = "This is a required field"."<br>";
  }elseif ($valid->validCorrect($catname)) {
    $error_msg = "Only alphabets and spaces allowed"."<br>";
  }else{
    //insert data to database table
    $sql = "INSERT INTO category(catname) VALUES(?)";
    $params = [$catname];
    $category = $db->create($sql,$params);
    if ($category) {
      set_message("Category successfully created");
      $db->redirect("../category");
    }
  }
  
    
}
?>
<h1 class="page-header text-center">Add a New Category</h1>
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
      <?php if (isset($success)): ?>
    <div class="alert alert-success">
      <?php echo $success; ?>
    </div>
      <?php endif; ?>
    <div class="form-group">
    <label for="catname">Category</label>
    <input type="text" name="catname" class="form-control" value="<?php if(isset($_POST['catname'])) echo $_POST['catname'];?>">
    </div>
    
   <input type="submit" class="btn btn-primary" value="Create Category"> 
    </form>
  </div>
  <div class="col-md-2">

  </div>
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