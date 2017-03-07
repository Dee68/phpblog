<?php
    require_once("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    require_once(ROOT ."inc/admin/admin_header.php");   
    require_once(ROOT ."inc/admin/admin_navigation.php");
   
    $db = new Post;
    $user = new User;
    $valid = new Validation;
    if (isset($_GET['id'])) {
      $id = intval($_GET['id']);
    }
      $page = $db->getPage($id);
      $title = $page['title'];
      $slug = $page['slug'];
      $body = $page['body'];
      $published = $page['is_published'];
      if (isset($_POST['edit'])) {
        $pagetitle = trim(($_POST['title']));
        $pageslug = trim($_POST['slug']);
        $pagebody = trim($_POST['content']);
        $radio = $_POST['published'];
        //validate fields
        if ($valid->validEmpty($pagetitle)||$valid->validEmpty($pageslug)||$valid->validEmpty($pagebody)) {
          $error_msg = "All fields are required";
        }elseif ($valid->validCorrect($pagetitle)) {
          $error_msg = "Only alphabets and spaces allowed";
        }else{
          //update page
          $newpage = $db->updatePage($pagetitle,$radio,$pagebody,$pageslug,$id);
          if ($newpage == FALSE) {
            set_message("Page sucessfully updated");
            header("Refresh:3; url= .");
            
          }else{
            $error_msg = "Error updating page";
          }
        }
      }
    ?>

<h1 class="page-header text-center">Update Page</h1>
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
     
    <div class="form-group">
    <label for="title">Page Title</label>
    <input type="text" name="title" class="form-control" value="<?php if(isset($title)) echo htmlspecialchars($title);?>">
    </div>
    <div class="form-group">
    <label for="category">Published</label>
      
      <input type="radio" name="published" value="1" checked="true">Yes
      <input type="radio" name="published" value="0">NO
    </div>
    <div class="form-group">
    <label for="title">Post Slug</label>
    <input type="text" name="slug" class="form-control" value="<?php if(isset($slug)) echo htmlspecialchars($slug);?>">
    </div>
    <div class="form-group">
    <label for="content">Page Content</label>
     <textarea id="txar" name="content" class="form-control"><?php if(isset($body)) echo htmlspecialchars($body);?></textarea>
    </div>
    
   <input type="submit" class="btn btn-primary" value="Update Page" name="edit">
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
