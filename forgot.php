<?php use PHPMailer\PHPMailer\PHPMailer; ?>

<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>



<!-- security to ensure that not everybody goes to that Page -->
<?php
require "./vendor/autoload.php";
require "./classes/config.php";





if(!$_GET['forgot']){
    redirect("index");
}
if(ifItIsMethod('POST')){
    if(isset($_POST['email'])){
        $email=$_POST['email'];
        // creating a random token
        $length=50;
        $token=bin2hex(openssl_random_pseudo_bytes($length));
        // prepared statement
        if(emailExists($email)){
         $statement= mysqli_prepare($connection,"UPDATE users SET token='{$token}' WHERE user_email=?");
          mysqli_stmt_bind_param($statement,"s",$email);
          mysqli_stmt_execute($statement);
          mysqli_stmt_close($statement);



        //   CONFIGURE PHP MAILER
       $mail = new PHPMailer();
       $mail->isSMTP();
       $mail->Host = Config::SMTP_HOST;
       $mail->Username = Config::SMTP_USER;
       $mail->Password = Config::SMTP_PASSWORD;
       $mail->Port = Config::SMTP_PORT;
       $mail->SMTPSecure = 'tls';
       $mail->SMTPAuth = true;
       $mail->isHTML(true);
    //    for multilanguage set up
       $mail->CharSet = 'UTF-8';


                    $mail->setFrom('joshujohn03@gmail.com', 'Joshua John');
                    $mail->addAddress($email);

                    $mail->Subject = 'This is a test email';

                    $mail->Body = '<p>Please click to reset your password

                    <a href="http://localhost:/blogsystem/reset.php?email='.$email.'&token='.$token.' ">http://localhost:/blogsystem/reset.php?email='.$email.'&token='.$token.'</a>



                    </p>';


                    if($mail->send()){

                        $emailSent = true;

                    } else{

                        echo "NOT SENT";

                    }




          
          
        }
       

        
    }



}





?>


<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <?php if(!isset($emailSent)): ?>


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">




                                <form id="register-form" role="form" autocomplete="off" class="form" method="POST"
                                    action="">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address"
                                                class="form-control" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                            value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->
                            <?php else: ?>
                            <h2>Please Check Your email</h2>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->