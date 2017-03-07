<?php
    require_once("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    require_once(ROOT ."inc/admin/admin_header.php");   
    require_once(ROOT ."inc/admin/admin_navigation.php");
   
    
    //$db = Database::getInstance();
    $db = new Post;
    $user = new User;
    $categories = $db->getCat();
    $name = $_SESSION['name'];
    ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $category = $_POST['category'];
  $tag = trim($_POST['tag']);
  $post_image = $_FILES['file']['name'];
  $post_temp_image = $_FILES['file']['tmp_name'];
  //get author from session variable
   // $sql1 = "SELECT * FROM user WHERE username = ?";
    
    $author = $user->getuserId($name);
  //validate fields
  $valid = new Validation;
  if ($valid->validEmpty($title) || $valid->validEmpty($content) || $valid->validEmpty($tag)) {
    $error_msg = "All fields are required"."<br>";
  }elseif ($valid->validSelect($category)) {
    $error_msg = "Select a category"."<br>";
  }elseif ($valid->validateUploadE($post_image)) {
    $error_msg = "Select an image file"."<br>";
  }elseif ($valid->validateUploadEx($post_image)) {
    $error_msg = "Image file extension not allowed"."<br>";
  }elseif ($valid->validateUploadS($post_image)) {
    $error_msg = "File size shoud be less than 400 kB."."<br>";
  
  }else{
    

    move_uploaded_file($post_temp_image, ROOT."images/" .$post_image);
    
    //create query for inserting data
   
    $post = $db->createPost($title,$content,$category,$author['id'],$tag,$post_image);
    if ($post == TRUE) {
      set_message("Post successfully created");
      header("location:../");
    }
      $error_msg = "Error creating post";
    

  }
}
?>
<h1 class="page-header text-center">Add a New Post</h1>
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
    <label for="title">Post Title</label>
    <input type="text" name="title" class="form-control" value="<?php if(isset($_POST['title'])) echo $_POST['title'];?>">
    </div>
    <div class="form-group">
    <label for="category">Post Category</label>
      <select class="form-control" name="category">
        <option><h3 class="text-center">-- SELECT --</h3></option>
       <?php foreach($categories as $category):?>
        <option value="<?=$category['catid']?>"><?=$category['catname']?></option>
      <?php endforeach;
      ?>
      </select>
    </div>
    <div class="form-group">
    <label for="title">Post Tag</label>
    <input type="text" name="tag" class="form-control" value="<?php if(isset($_POST['tag'])) echo $_POST['tag'];?>">
    </div>
    <div class="form-group">
    <label for="content">Post Content</label>
     <textarea id="txar" name="content" class="form-control"><?php if(isset($_POST['content'])) echo $_POST['content'];?></textarea>
    </div>
    <div class="form-group">
      <label for="post_image">Post Image</label>
        <input type="file" name="file" class="form-control">
    </div>
   <input type="submit" class="btn btn-primary" value="Create Post">
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
    }
    //close database connection
      $db->disconnect();
     ?>
