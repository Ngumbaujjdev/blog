<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>



    
<!-- The mail function -->
<?php
if (isset($_POST['submit'])) {
    $to = "tonyodolo391@gmail.com";
    $subject = $_POST['subject'];
    $body = wordwrap($_POST['body'], 70);
    $header = "From: ".$_POST['email'];

    // send email
    if (mail($to, $subject, $body, $header)) {
        echo 'Email sent successfully!';
    } else {
        echo 'An error occurred while sending the email.';
    }
}
?>


 
    <!-- Page Content -->
    <div class="container">
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="contact-form" autocomplete="off">
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="text" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your Subject" required>
                        </div>
                         <div class="form-group">
                            <textarea  name="body" id="body" class="form-control"   required></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-contact" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
