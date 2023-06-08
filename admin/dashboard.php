<?php include "Includes/admin_header.php" ?>

<div id="wrapper">


    <!-- Navigation -->

    <?php include "Includes/admin_navigation.php" ?>

    <!-- /.navbar-collapse -->


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">


                    <h1 class="page-header">
                        Welcome to Admin Dashboard
                        <small><?php echo strtoupper( get_username()); ?></small>
                    </h1>





                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <!-- Query to count the total number of posts -->
                                            <div class='huge'><?php echo $posts_count_query = recordcount('posts');?>
                                            </div>
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>




                        <!-- comments widget -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <!-- Query to count the total number of comments -->
                                            <div class='huge'>
                                                <?php echo $comments_count_query = recordcount('comments');?> </div>
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>




                        <!-- users widget -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">

                                            <!-- Query to count the total number of users -->
                                            <div class='huge'><?php echo $users_count_query = recordcount('users');?>
                                            </div>


                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <!-- categories widget -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">

                                            <!-- Query to count the total number of categories -->
                                            <div class='huge'>
                                                <?php echo $categories_count_query = recordcount('categories');?> </div>
                                            <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="admin_category.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">




                        <!-- Query to display published posts -->
                        <?php
$published_posts_count_query =  checkStatus('posts', 'post_status' , 'published');
?>




                        <!-- Query to display draft posts -->
                        <?php
$draft_posts_count_query = checkStatus('posts', 'post_status' , 'draft');
?>

                        <!-- Query to display approved comments -->
                        <?php

$Approved_comments_count_query = checkStatus('comments', 'comment_status' , 'Approved');
?>


                        <!-- Query to display unapproved comments -->
                        <?php

$Unapproved_comments_count_query = checkStatus('comments', 'comment_status' , 'Unapproved');
?>


                        <!-- Query to display Subscribers -->
                        <?php

$Subscribers_count_query = checkStatus('users', 'user_role' , 'Subscriber');
?>

                        <!-- Query to display Administrators -->
                        <?php

$Admin_count_query = checkStatus('users', 'user_role' , 'Admin');
?>












                        <!-- Dashboard chat -->
                        <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],
                                //   to display the data dynamically
                                <?php
          $element_text = ['All Posts',  'Published Posts' , 'Draft Posts','Comments','Approved Comments', 'Unapproved Comments', 'Users','Subscribers','Admin','Categories'];
          $element_count = [$posts_count_query,$published_posts_count_query, $draft_posts_count_query,  $comments_count_query,$Approved_comments_count_query,  $Unapproved_comments_count_query, $users_count_query,  $Subscribers_count_query, $Admin_count_query, $categories_count_query];

          for ($i = 0; $i < 10; $i++){
            echo "['{$element_text[$i]}', {$element_count[$i]}],";
          }
  
          ?>
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                        </script>
                        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


                    </div>






                    <!-- /.row -->
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "Includes/admin_footer.php" ?>