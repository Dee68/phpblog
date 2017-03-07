<?php 
require_once("../inc/config.php");
require_once(ROOT ."bootstrap.php");
$title = "Post";
$db = new Post;
$pages = $db->getPages();
require_once(ROOT."inc/public/front_header.php"); 
require_once(ROOT ."inc/public/front_navigation.php"); 
?>

   <!-- Page Content -->
    <div class="container">

        <div class="row">
<!-- Blog Post Content Column -->
          <div class="col-lg-8">
          <?php
          //$db = new Post;
          if (isset($_GET['id'])) {
          	$id = intval($_GET['id']);
          }
          $single = $db->getPostId($id);
          ?>
         
                <!-- Title -->
                <h1><?=$single['posttitle']?></h1>
 
                <!-- Author -->
                <p class="lead">
                    by <a href="post.php?id=<?=$single['postid']?>"><?php echo ucfirst($single['username']);?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=formatDate($single['postdate'])?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?=BASE_URL?>images/<?=$single['postimage']?>" alt="">         

                <hr>

                <!-- Post Content -->
                <p class="lead"><?=$single['postcontent']?></p>
                
                <hr>

                <?php
                     $user = new User;
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                	$author = trim($_POST['author']);
                	$comment = trim($_POST['comment']);
                	$post = $single['postid'];
                	$name = $user->getuserName($author);
                	$commentator = $user->getuserId($author);
                	//validate fields
                	$valid = new Validation;
                	if ($valid->validEmpty($author)||$valid->validEmpty($comment)) {
                		$error = "All fields are required";
                	}elseif ($name) {
                		//insert comment to database
                		$enter = $db->createComments($comment,$post,$commentator['id']);
                		if ($enter) {
                			//redirect to home page
                			$user->redirect(BASE_URL);
                		}else{
                			$error = "Error inserting comments";
                		}

                	}else{
                		$error = "you have to be a registered member to leave comments";
                	}
                }

                ?>

                <!-- Comments Form -->
                <div class="well">
                <?php if (isset($error)) {
                        echo'<p style="color:red">'.$error.'</p>';
                    }?>
                    <h4>Leave a Comment:</h4>
                    
                    <form role="form" method="post" action="">
                    
                      <div class="form-group">
                            <input class="form-control" name="author" placeholder="Enter your name.">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>
          </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include(ROOT ."inc/public/front_sidebar.php"); ?>

        </div>
        <!-- /.row -->

     <?php include(TEMPLATE_FRONT ."footer.php"); ?>
