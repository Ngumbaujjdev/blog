<?php

 include "Includes/admin_header.php"; 
 ?>

<div id="wrapper">

    <!-- Navigation -->

    <?php
         include "Includes/admin_navigation.php";
          ?>

    <!-- /.navbar-collapse -->


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">


                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                    <div class="col-xs-6">

                        <?php

                       insert_categories();

                        ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>

                        </form>
                        <!-- Update and Includes -->
                        <?php
                            if(isset($_GET['Edit'])){
                                $cat_id = $_GET['Edit'];

                                include "Includes/update_category.php";
                            }

                            ?>




                    </div> <!-- Add Category Form-->


                    <!-- to create a table on the side -->
                    <div class="col-xs-6">


                        <table class="table table-bordered table hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>

                            <!-- query to display all the categories in the database
 -->
                            <?php
findAllcategories()
?>

                            <!-- Delete query -->
                            <?php

delete_categories()


?>




                        </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php 
        include "Includes/admin_footer.php";
         ?>