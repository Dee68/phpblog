<?php
require_once("../inc/config.php");
require_once(ROOT ."bootstrap.php");
$title = "Contact";
$db = new Post;
$pages = $db->getPages();
require_once(ROOT."inc/public/front_header.php"); 

 $db =Database::getInstance();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //echo "it works";
   $fullname = trim($_POST['fn']);
    $email = trim($_POST['e']);
    $message = trim($_POST['m']);
    //
        $to = $email;
        $subject = "PhpBlog contact form submission";
        $From = "admin@gmail.com";
        $message = str_replace("\n.", "\n..", $message);
        $body = "Name: $fullname\nEmail: $email\nmessage: $message";
        $headers = "From: ".$From;
        if ($to && $subject && $body) {
            mail($to, $subject, $body,$headers);
            echo "Message successfully sent, We will contact you soonest";
            header("Refresh:3; url=http://localhost/phpblog");
        }else{
            $error_message =  "All fields are required";
        }
   
}

?>
<?php require_once(ROOT ."inc/public/front_navigation.php"); ?>

   <!-- Page Content -->
  <div class="container">

   <div class="row">
   <div class="col-md-12">
   <div class="col-md-2"></div>
   <div class="col-md-8">
   
   
                        <?php
                            if (isset($error_message)) {
                                echo '<p style="color:red;">' . $error_message . '</p>';
                            }
                            display_message();
                        ?>

   <div class="page-header"><h2 class="text-center">Contact Form</h2></div>
<form  id="contactForm"  method="post" action="">
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Full Name:</label>
                                <input type="text" class="form-control" id="fn" name="fn">
                                <span style="color:red;"><?php if(isset($error_name))echo $error_name;?></span>
                            </div>
                        </div>
                        
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Email Address:</label>
                                <input type="email" class="form-control" id="e" name="e">
                                <span style="color:red;"><?php if(isset($error_email))echo $error_email;?></span>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Message:</label>
                        <textarea rows="10" cols="100" class="form-control" id="m" name="m" maxlength="999" style="resize:none"></textarea>
                        <span style="color:red;"><?php if(isset($error_text))echo $error_text;?></span>
                            </div>
                        </div>
                        <div class="control-group form-group" style="display: none;">
                            <div class="controls">
                                <label>Address:</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <p>Humans: please leave this field blank.</p>
                        </div>
                        <div id="status"></div>
                        <!-- For success/fail messages -->
                        <input type="submit" id="btn" class="btn btn-primary" value="Send Message">
                    </form>
                   
</div>
<div class="col-md-2"></div>
</div>
</div>
</div>
<?php require_once("../inc/public/front_footer.php"); ?>
