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
                <a class="navbar-brand" href="../">PhpBlog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="../">Home</a>
                    </li>
                    <li>
                        <a href="<?=BASE_URL?>contact">Contact</a>
                    </li>
                    <?php foreach ($pages as $page):?>
                    <?php if($page['is_published'] == 1):?>
                    <li>
                        <a href="<?=BASE_URL?><?=$page['slug']?>"><?=$page['title']?></a>
                    </li>
                    <?php endif;?>
                <?php endforeach;?>
                </ul>
                <!-- right align -->
                <ul class="nav navbar-nav navbar-right">
                   <li>
                        <a href="../signup">Signup</a>
                    </li> 
                    <li>
                        <a href="../admin/login">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>