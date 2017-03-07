<?php require_once("../inc/config.php");
      require_once(ROOT ."inc/register/header.php");
      require_once(ROOT ."bootstrap.php");

      if($_SERVER['REQUEST_METHOD'] == "POST"){
        //$db = User::getInstance();
        $db = new User;
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $pass = trim($_POST['password']);
        $pass1 = trim($_POST['password2']);
        //apply custom validation to form
        $valid = new Validation;
        if ($valid->validEmpty($name) || $valid->validEmpty($email) || $valid->validEmpty($pass) || $valid->validEmpty($pass1)) {
          $error_msg = "All fields are required"."<br />";
        }elseif ($valid->validCorrect($name)) {
          $error_msg = "Only alphabets and spaces allowed"."<br />";
        }elseif ($valid->validEmail($email)) {
          $error_msg = "Invalid Email address"."<br />";
        }elseif ($pass != $pass1) {
          $error_msg = "The password must match"."<br />";
        }else{
         //encrypt password
          $pass = password_hash($pass, PASSWORD_DEFAULT);
          $user = $db->register($name,$email,$pass);
          if ($user) {
            $success = "you have successfully registered. you can now login";
            set_message($success);
            $db->redirect("../");
          }else{
            $error_msg = "Error creating user";
          }
          $db->disconnect();
        }
      }
?>
<form method="post" action="">
<div class="body bg-gray">
                  <!-- show validation errors here -->
                  
                <div class="alert-danger text-center">
              <?php if (isset($error_msg)) {
                echo "<h3>" .$error_msg ."</h3>";
              } ?></div>
             
                    <div class="form-group">
                      <input type="text" name="name" class="form-control" placeholder="User Name">
                    </div>
                    <div class="form-group">
                      
                         <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                    
                    <div class="form-group">
                      
                       <input type="password" name="password" class="form-control" placeholder="password">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password2" class="form-control" placeholder="Retype password">
                    </div>
                </div>
                <div class="footer">
                 <input type="submit" class="btn bg-olive btn-block" value="Sign me up">
                </div>
                </form>
          
      <?php require_once(ROOT ."inc/register/footer.php")?>