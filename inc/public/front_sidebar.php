    <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form method="GET" action="<?=BASE_URL?>search/">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                    <?php $db = Database::getInstance();
                        $Categories = $db->getAll("SELECT * FROM category",[]);
                        foreach($Categories as $Category):?>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="<?=BASE_URL?>posts/posts.php?category=<?=$Category['catid']?>"><?php echo $Category['catname'];?></a>
                                </li>
                                
                            </ul>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <!--
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
                -->

            </div>