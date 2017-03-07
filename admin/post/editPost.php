<?php
    include("../../inc/config.php");
    require_once(ROOT ."bootstrap.php");
    include(ROOT ."inc/admin/admin_header.php");   
    include(ROOT ."inc/admin/admin_navigation.php");
    $page_header = "Update Post";
    
    ?>
<?php
 $db = new Post;
 $categories = $db->getCat();
 $valid = new Validation;
 if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  }
  $post = $db->getPost($id);
  $posttitle = $post['posttitle'];
  $postcont = $post['postcontent'];
  $author = $post['id'];//user id
  $posttag = $post['posttag'];
  $catname = $post['catname'];//
  $catid = $post['category'];
  $pimage = $post['postimage'];
  //
  if (isset($_POST['edit'])) {
    $title = trim($_POST['title']);//from form
    $content = trim($_POST['content']);//from form
    $category = $_POST['category'];//from form
    $tag = trim($_POST['tag']);
    $post_image = $_FILES['file']['name'];
    $post_temp_image = $_FILES['file']['tmp_name'];
    //validate upload image
     if ($valid->validateUploadE($post_image)) {
       $error_msg = "Please select an image file";
     }elseif ($valid->validateUploadEx($post_image)) {
       $error_msg = "Extension not allowed";
     }elseif ($valid->validateUploadS($post_image)) {
       $error_msg = "File size shoud be less than 400 kB <br />";
     }else{
      
      if (move_uploaded_file($post_temp_image, ROOT ."images/" .$post_image)) {
        $newpost = $db->postupdate($title,$content,$category,$author,$tag,$post_image,$id);
         if ($newpost == FALSE) {
          set_message("Post succesfully updated");
          header("location:../");
    }
    $error_msg = "Error updating post";
      }
   
      
     }  
  }


?>
<h1 class="page-header text-center"><?=$page_header?></h1>
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
    <label for="title">Post Title</label>
    <input type="text" name="title" class="form-control" value="<?php if(isset($posttitle)) echo $posttitle;?>">
    </div>
    <div class="form-group">
    <label for="category">Post Category</label>
      <select class="form-control" name="category">
        <option value="<?=$catid?>"><?=$catname?></option>
       <?php foreach($categories as $category):?>
        <option value="<?php echo $category['catid'];?>"><?=$category['catname']?></option>
      <?php endforeach;?>
      </select>
    </div>
    <div class="form-group">
    <label for="title">Post Tag</label>
    <input type="text" name="tag" class="form-control" value="<?php if(isset($posttag)) echo $posttag;?>">
    </div>
    <div class="form-group">
    <label for="content">Post Content</label>
     <textarea id="txar" name="content"><?php if(isset($postcont)) echo $postcont;?></textarea>
    </div>
    <div class="form-group">
      <label for="post_image">Post Image</label>
        <input type="file" name="file" class="" value="<?php if(isset($pimage)) echo $pimage;?>"><?php if(isset($post['postimage'])):?>
        <img src="<?=BASE_URL?>images/<?=$post['postimage']?>" class="img-responsive" width="50">
      <?php endif;?>
    </div>
   <input type="submit" class="btn btn-primary" name="edit" value="Update Post"> 
   <a href="<?=BASE_URL?>admin" class="btn btn-danger">Cancel</a> 
    </form>
  </div>
  <div class="col-md-2">

  </div>
</div>

<?php include(ROOT ."inc/admin/admin_footer.php");?>
<?php //restricting access to edit posts not created by user
    if (!isset($_SESSION['name'])) {
       header("location:../login");
     }elseif (($_SESSION['name'] != $post['username']) &&($_SESSION['role'] !=2)) {
       header("location:../error");
     }else{

     } ?>
<?php $db->disconnect();?>