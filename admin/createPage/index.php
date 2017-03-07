<?php
    require_once("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    require_once(ROOT ."inc/admin/admin_header.php");   
    require_once(ROOT ."inc/admin/admin_navigation.php");
   
    
    //$db = Database::getInstance();
    $db = new Post;
    $user = new User;
    $valid = new Validation;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      //retriev values from form
     $title =trim($_POST['title']);
     $slug =trim($_POST['slug']);
     $published =trim($_POST['published']);
     $content =trim($_POST['content']);
     //validate fields
     if ($valid->validEmpty($title)||$valid->validEmpty($slug)||$valid->validEmpty($content)) {
       $error_msg = "All fields are required";
     }elseif ($valid->validCorrect($title)) {
      $error_msg = "Only alphabets and spaces allowed";
     }else{
      $page = $db->creatPage($title,$published,$content,$slug);
      if ($page) {
        set_message("Page successfully created");
        header("Refresh:3; url= http://localhost/phpblog/admin/pages/");
      }else{
        $error_msg = "Error creating page";
      }
     }
    }
    ?>

<h1 class="page-header text-center">Add a New Page</h1>
<div class="row">
  <div class="col-md-2">

  </div>
  <div class="col-md-8">
    <form method="post" action="" enctype="multipart/form-data">
     <?php if (isset($error_msg)): ?>
    <div class="alert alert-danger">
      <?php echo $error_msg; ?>
    </div>
      <?php endif; ?>
      <?php if (isset($success)): ?>
    <div class="alert alert-success">
      <?php echo $success; ?>
    </div>
      <?php endif; ?>
    <div class="form-group">
    <label for="title">Page Title</label>
    <input type="text" name="title" class="form-control" value="<?php if(isset($_POST['title'])) echo htmlspecialchars($_POST['title']);?>">
    </div>
    <div class="form-group">
    <label for="category">Published</label>
      
      <input type="radio" name="published" value="1" checked="true">Yes
      <input type="radio" name="published" value="0">NO
    </div>
    <div class="form-group">
    <label for="title">Post Slug</label>
    <input type="text" name="slug" class="form-control" value="<?php if(isset($_POST['slug'])) echo htmlspecialchars($_POST['slug']);?>">
    </div>
    <div class="form-group">
    <label for="content">Page Content</label>
     <textarea id="txar" name="content" class="form-control"><?php if(isset($_POST['content'])) echo htmlspecialchars($_POST['content']);?></textarea>
    </div>
    
   <input type="submit" class="btn btn-primary" value="Create Page">
   <a href="<?=BASE_URL?>admin" class="btn btn-danger">Cancel</a> 
    </form>
  </div>
  <div class="col-md-2">

  </div>
</div>
<?php include(ROOT ."inc/admin/admin_footer.php");?>
<?php 
  //allow only logged in users

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
