<?php 
require_once("../../inc/config.php");
require_once(ROOT ."bootstrap.php");
require_once(ROOT ."inc/admin/admin_header.php");   
require_once(ROOT ."inc/admin/admin_navigation.php");    
?>
<?php
$user = new User;
$name = $_SESSION['name'];
$curuser = $user->getuserId($name);//all data of logged in user
$valid = new Validation;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//get values from fields
	$name = trim($_POST['uname']);
	$fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$addrs = trim($_POST['addrs']);
	$user_image = $_FILES['file']['name'];
	$user_temp_image = $_FILES['file']['tmp_name'];
	//validate fields
	if ($valid->validateUploadE($user_image)) {
		$error_msg = "Upload your profile image with these extensions:(jpg,png)"."<br>";
	}elseif ($valid->validateUploadEx($user_image)) {
		$error_msg = "Extension not allowed"."<br>";
	}elseif ($valid->validateUploadS($user_image)) {
		$error_msg =  "File size shoud be less than or equal to 400 kB."."<br>";
	}else{
		//update profile
		move_uploaded_file($user_temp_image, ROOT."images/".$user_image);
		$profile = $user->userUpdate($fname,$lname,$addrs,$user_image,$name);
		if ($profile) {
			set_message("profile successfully updated");
			header("Refresh:2; url= .");
		}else{
			$error_msg = "Error updating profile";
		}
	}
}
?>
<!-- Page Content -->
    <div class="container">
    <div class="row">
    <?php if (isset($error_msg)): ?>
    <div class="alert alert-danger">
      <?php echo $error_msg; ?>
    </div>
      <?php endif; ?>
     <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
    	<!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="<?=BASE_URL?>images/<?=$curuser['userimage']?>" class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          <input type="file" class="form-control" name="file">
        </div>
      </div>
       <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3 class="text-center">Personal info</h3>
           <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <input class="form-control" type="text" value="<?=$name?>" name="uname">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php if(isset($curuser['firstname']))echo $curuser['firstname'] ?>" name="fname">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php if(isset($curuser['lastname']))echo $curuser['lastname'] ?>" name="lname">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Address:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php if(isset($curuser['address']))echo $curuser['address'] ?>" name="addrs">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="email" value="<?=$curuser['email']?>" name="email">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes" name="submit">
              <span></span>
              <a href="<?=ADMIN?>" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    </div>
  <?php require_once(ROOT ."inc/admin/admin_footer.php"); ?>
