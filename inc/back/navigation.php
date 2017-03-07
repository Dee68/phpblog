<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--
                <a class="navbar-brand" href="#">CMS</a>
              -->
                <a href="<?=ADMIN?>" class="navbar-brand">PhpBlog CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php if (isset($_SESSION['name']) && ($_SESSION['role'] == 2)){?> 
                    <li><a href="<?=ADMIN?>">Dashboard</a></li>
                    <li><a href="<?=ADMIN?>category/">Categories</a></li>
                    <li><a href="<?=ADMIN?>comments/">Comments</a></li>
                    <li><a href="<?=ADMIN?>pages/">Pages</a></li>
                <?php }else{?>
                <li><a href="./">Posts</a></li>
                <?php }?>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                <li><a href="/phpblog" class="glyphicon glyphicon-home" target="_blank"></a></li>
                   <?php //if (isset($_SESSION['name'])):?>       
                     
                    <li class="dropdown">
                          
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        
								<i class="glyphicon glyphicon-user"></i>
								<span class="caret"></span>  <?php echo "Welcome   " .ucfirst($_SESSION['name']);?>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?=ADMIN?>profile/index.php?name=<?=$_SESSION['name']?>">Profile</a></li>
								<li><a href="logout">Logout</a></li>
							</ul>
                              
						</li>
                    <?php //endif;?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>