<?php require_once("../../inc/config.php");
      require_once(ROOT ."bootstrap.php");?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Php Blog Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=BASE_URL?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    
    <link rel="stylesheet" href="<?=BASE_URL?>assets/css/style.css" media="screen" title="no title" charset="utf-8">

    
</head>

<body class="bg-black">
<?php 
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $db = new User;
    $email = trim($_POST['useremail']);
    $pass = trim($_POST['password']);
    $token = $_POST['token'];
    //validate input fields
    $valid = new Validation;
    if ($valid->validEmpty($email) || $valid->validEmpty($pass)) {
    $error_msg = "All fields are required";
  }elseif ($valid->validEmail($email)) {
    $error_msg = "Invalid email address";
  }else {
    //check correspondence of credentials
    $user = $db->getUser($email,$pass);
    $isvalid = $db->dologin($email,$pass);
    $validity = $valid->validate_token();
    if($isvalid && $validity){
      //create session variables:
        $_SESSION['name'] = $user['username'];
        $_SESSION['role'] = $user['user_role'];
        $_SESSION['logged_in'] = true;
         session_regenerate_id();
         if ($user['user_role'] == 1) {
           $db->redirect(ADMIN ."members/");
          //header("location:../members/");
         }else{
          header("location:../");
         }
                   
    }else{
      $error_msg = "Invalid Credentials";
    }

    $db->disconnect();
  }
}
?>
 
<div class="form-box" id="login-box">
           <div class="header">Sign In</div>
          <div class="alert-danger text-center">
            <?php if (isset($error_msg)) {
              echo $error_msg;
            } ?>
          </div>
          <form action="" method="post">
              <div class="body bg-gray">
                  <div class="form-group">
                      <input type="text" name="useremail" class="form-control" placeholder="User Email"/>
                  </div>
                  <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="Password"/>
                      <input type="hidden" name="token" value="<?=$token?>">
                  </div>
                  <div class="form-group">
                      <input type="checkbox" name="remember_me"/> Remember me
                  </div>
              </div>
              <div class="footer">
                  <button type="submit" class="btn bg-olive btn-block">Sign me in</button>
                 
              </div>
          </form>
          <div class="margin text-center">
            <!--
              <span>Sign in using social networks</span>
              <br/>
              <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
              <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
              <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
           -->
          </div>
      </div>
     </div>

  </body>
</html>
