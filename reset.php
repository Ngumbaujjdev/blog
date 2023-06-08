<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
<?php

if(!isset($_GET['email']) && !isset($_GET['token'])){
    redirect('index');
    
}




if($statement=mysqli_prepare($connection,'SELECT username,user_email,token FROM users WHERE  token=?')){
    mysqli_stmt_bind_param($statement,"s",$_GET['token']);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$username,$email,$token);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    // if($_GET['token'] !== $token || $_GET['email'] !==$email){
    //     redirect('index');
    // }
    if(isset($_POST['password']) && isset($_POST['confirm-password'])){
        if($_POST['password'] === $_POST['confirm-password']){
            $password=$_POST['password'];
          $hashed_password= password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));
            if($statement=mysqli_prepare($connection,"UPDATE users SET token='',user_password='{$hashed_password}' WHERE user_email=?")){
                mysqli_stmt_bind_param($statement,"s",$_GET['email']);
                mysqli_stmt_execute($statement);
                if(mysqli_stmt_affected_rows($statement)>=1){
                    // REDIRECT THE USER IF OK 
                    redirect("/BlogSystem/login.php");
                }
                mysqli_stmt_close($statement);
                
            }
           







        }
    }






}



?>



<!-- Page Content -->
<div class="container">
    <?php if(!$verified): ?>
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input id="password" name="password" placeholder="enter password"
                                                class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="password" name="confirm-password" placeholder="enter password"
                                                class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                            value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php redirect("/BlogSystem/login.php"); ?>
    <?php endif; ?>

    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->