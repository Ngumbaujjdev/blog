    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/blogsystem">Content Management System</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                $query = "SELECT * FROM categories";
                $select_categories_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_categories_query )) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];




// Active links on the categories reg and contact         
                    $category_class = '';
                    $registration_class = '';
                    $contact_class = '';
                    $login_class = '';
                    $pageName = basename($_SERVER['PHP_SELF']);
                    $registration = '/blogsystem/registration';
                    $contact = '/blogsystem/contact';
                    $login = '/blogsystem/login';

                    if (isset($_GET['category']) && $_GET['category'] == $cat_id){

                        $category_class = 'active';

                        
                    }else if($pageName == $registration){
                        $registration_class = 'active';
                    }else if($pageName == $contact){
                        $contact_class = 'active';
                    }else if ($pageName == $login) {
                        $login_class = 'active';
                    }
                        

                echo "<li><a href='/blogsystem/category/{$cat_id}'>{$cat_title}</a></li>";
                }   
                ?>



                    <li>
                        <?php if(isLoggedIn()): ?>
                    <li>
                        <a href="/blogsystem/Admin">Admin</a>
                    </li>
                    <li>
                        <a href="/blogsystem/includes/logout.php">Log Out</a>
                    </li>


                    <?php else: ?>
                    <li class='<?php echo $registration_class ?>'>
                        <a href="/blogsystem/registration">Register</a>
                    </li>
                    <li class='<?php echo $login_class ?>'>
                        <a href="/blogsystem/login">Login</a>
                    </li>
                    <?php endif; ?>



                    </li>





                    <li class='<?php echo $contact_class ?>'>
                        <a href="/blogsystem/contact">Contact</a>
                    </li>






                    <?php
if(isset($_SESSION['user_role'])){
if(isset($_GET['p_id'])){

$the_post_id = $_GET['p_id'];
echo "<li><a href='/blogsystem/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
}
} 
?>



                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>