<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
<!-- change language -->
<?php
if(isset($_GET['lang']) && !empty($_GET['lang'])){
    $_SESSION['lang']=$_GET['lang'];
    // reload the page according to the data
    if(isset($_SESSION['lang']) && $_SESSION['lang'] !=$_GET['lang']){
        echo "<script type='text/javascript'>location.reload();</script>";
    }
}
    if(isset($_SESSION['lang'])){
        include "includes/languages/".$_SESSION['lang'].".php";
    }else{
         include "includes/languages/en.php";
    }








?>
















<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);

    $error=[
        'username'=>'',
        'email'=>'',
        'password'=>''
    ];
    if(strlen($username) < 4){
        $error['username']='The username should be longer than 4 characters';
    }
     if($username ==''){
        $error['username']='The username cannot be empty';
    }
    if(username_exists($username)){
        $error['username']='The username already exists';
    }

     if($email ==''){
        $error['email']='The email cannot be empty';
    }
    if(emailExists($email)){
        $error['email']='The email already exists<a href="BlogSystem/login.php" class="btn btn-primary">Please Login</a>';
    }
    if($password==''){
        $error['password']='password cannot be empty';
    }
    foreach($error as $key =>$value){
        if(empty($value)){
            unset($error[$key]);
           
            
        }
    }
    if(empty($error)){ 
        register_user($username,$email,$password);
        login_user($username,$password);
    }
   
    
   
   
    
}


?>
<div class="container my-10">
    <div class="row">
        <div class="col-lg-6 p-6 ">
            <div class="form-group">
                <form action="" method="get" class="navbar-form navbar-right" id="Language_form">
                    <select name="lang" class="form-control" onchange="changeLanguage()" id="Language_form">
                        <option value="en"
                            <?php if(isset($_GET['lang']) &&$_SESSION['lang'] =='en'){echo "selected";} ?>>English
                        </option>
                        <option value="es" tion value="en"
                            <?php if(isset($_GET['lang']) &&$_SESSION['lang'] =='es'){echo "selected";} ?>>Spanish
                        </option>
                    </select>
            </div>
            </form>

        </div>
    </div>
</div>



<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1><?php echo REGISTER; ?></h1>
                        <form role="form" action="" method="post" id="" autocomplete="on">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="<?php echo USERNAME; ?>" autocomplete="on"
                                    value="<?php echo isset($username) ? $username: '' ?>">

                                <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>

                            </div>



                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="<?php echo EMAIL; ?>" autocomplete="on"
                                    value="<?php echo isset($email)? $email: '' ?>">
                                <p><?php echo isset($error['email']) ? $error['email']: '' ?></p>
                            </div>


                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="<?php echo PASSWORD; ?>">
                                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-primary btn-lg btn-block"
                                value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>
    <script>
    function changeLanguage() {
        document.getElementById("Language_form").submit()
    }
    </script>


    <?php include "includes/footer.php";?>