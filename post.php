<?php
include"includes/db.php";
?>

<?php
include"includes/header.php";
?>
<?php
include"includes/navigation.php";
?>
<style>
.like,
.unlike {
    font-size: 28px;
}
</style>


<?php
if (isset($_POST['liked'])) {
    //set post variable
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    //fectching the post
    $query = "select * from posts where post_id = $post_id";
    $postResult = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($postResult);
    

        //update  the post table with incrementing likes in the likes column
        $likes = $_POST['likes'];
        // Retrieve the current likes count for the post
        $query = "SELECT likes FROM posts WHERE post_id = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $post_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $currentLikes = $row['likes'];

        // increment the likes count
        $newLikes = $currentLikes + 1;

        // Update the likes column with the new value
        $query = "UPDATE posts SET likes = ? WHERE post_id = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ii", $newLikes, $post_id);
        mysqli_stmt_execute($stmt);

        // Clean up
        mysqli_stmt_close($stmt);


    //create a like for the post(inserting into the likes table)
    mysqli_query($connection, "insert into likes(user_id, post_id) VALUES($user_id, $post_id)");


}




if(isset($_POST['unliked'])) {
    //set post variable
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    //fectching the post
    $query = "select * from posts where post_id = $post_id";
    $postResult = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($postResult);


    //Delete the likes then decrement
    mysqli_query($connection, "delete from likes where post_id=$post_id and user_id=$user_id");
    

            //update  the post table with decrement likes in the likes column
            $likes = $_POST['likes'];
            // Retrieve the current likes count for the post
            $query = "SELECT likes FROM posts WHERE post_id = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "i", $post_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $currentLikes = $row['likes'];

            // Decrement the likes count
            $newLikes = $currentLikes - 1;

            // Update the likes column with the new value
            $query = "UPDATE posts SET likes = ? WHERE post_id = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "ii", $newLikes, $post_id);
            mysqli_stmt_execute($stmt);

            // Clean up
            mysqli_stmt_close($stmt);

}
?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">

            <?php

if(isset($_GET['p_id'])){

$the_post_id = $_GET['p_id'];



$update_statement = mysqli_prepare($connection, "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?");

mysqli_stmt_bind_param($update_statement, "i", $the_post_id);

mysqli_stmt_execute($update_statement);

// mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);



if(!$update_statement) {

die("query failed" );
}


if(isset($_SESSION['username']) && is_admin($_SESSION['username']) ) {


 $stmt1 = mysqli_prepare($connection, "SELECT post_title, post_user, post_date, post_image, post_content,likes FROM posts WHERE post_id = ?");


} else {
$stmt2 = mysqli_prepare($connection , "SELECT post_title, post_user, post_date, post_image, post_content,likes FROM posts WHERE post_id = ? AND post_status = ? ");

$published = 'published';



}



if(isset($stmt1)){

mysqli_stmt_bind_param($stmt1, "i", $the_post_id);

mysqli_stmt_execute($stmt1);

mysqli_stmt_bind_result($stmt1, $post_title, $post_user, $post_date, $post_image, $post_content,$likes);

$stmt = $stmt1;


}else {


mysqli_stmt_bind_param($stmt2, "is", $the_post_id, $published);

mysqli_stmt_execute($stmt2);

mysqli_stmt_bind_result($stmt2, $post_title, $post_user, $post_date, $post_image, $post_content,$likes);

$stmt = $stmt2;


}



            while(mysqli_stmt_fetch($stmt)) {


            ?>

            <h1 class="page-header">
                <!--  -->

            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a
                    href="author_posts.php?author=<?php echo $post_user ?>&p_id=<?php echo $the_post_id  ?>"><?php echo $post_user ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="/blogsystem/images/<?php echo imagePlaceholder($post_image); ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <hr>
            <!-- like post and unlike post feature -->


            <?php } ?>
            <!-- end of the while loop -->


            <div class="row" id="">
                <?php
                $query="SELECT * FROM likes WHERE post_id=$the_post_id  " ;
                $query .="  AND user_id=".$_SESSION['user_id']."";
                $find_if_user_liked=mysqli_query($connection,$query);
                $amount_of_likes_in_the_post_for_the_user=mysqli_num_rows($find_if_user_liked);
               $user_already_liked=$amount_of_likes_in_the_post_for_the_user ==1&& isset($_SESSION['user_id']);
               $user_has_not_liked=$amount_of_likes_in_the_post_for_the_user < 1 && isset($_SESSION['user_id']);
                

                ?>

                <?php if($user_has_not_liked): ?>
                <!-- user has not liked the post -->
                <marquee direction="up" scrollamount="2">Like Now</marquee>

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p class="text-center">
                        <a href="" class="like" class="btn btn-custom"><span
                                class="glyphicon glyphicon-heart-empty"></span></a>
                    </p>
                </div>
                <?php else:?>
                <!-- user has liked the post -->
                <marquee direction="up" scrollamount="2">Already Liked</marquee>

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <a href="" class="unlike" class="btn btn-custom"><span
                            class="glyphicon glyphicon-thumbs-down"></span></a>

                </div>
                <?php endif;  ?>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p class="text-center">
                        <button class="btn btn-primary btn-large">
                            <?php echo $likes; ?>
                            <?php 
                                if($likes ==1){
                                    echo "Like";
                                }else{
                                    echo "Likes";
                                }
 

                                 ?>
                        </button>

                    </p>
                </div>
            </div>



            <!-- Blog Comments -->

            <?php 

if(isset($_POST['create_comment'])) {

$the_post_id = $_GET['p_id'];
$comment_author = $_POST['comment_author'];
$comment_email = $_POST['comment_email'];
$comment_content = $_POST['comment_content'];


if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date)";

    $query .= "VALUES ($the_post_id ,'{$comment_author}', '{$comment_email}', '{$comment_content }', 'unapproved',now())";

    $create_comment_query = mysqli_query($connection, $query);

    if (!$create_comment_query) {
        die('QUERY FAILED' . mysqli_error($connection));

    }


}


}




?>


            <!-- Posted Comments -->



            <!-- Comments Form -->
            <div class="well">
                <?php
            //   GET CURRENT USER DETAILS SO THAT ITS NOT EVERY ONE CAN COMMENT
            $user_id=$_SESSION['user_id'];
            $statement=mysqli_prepare($connection,"SELECT username,user_email FROM users WHERE user_id=?");
            mysqli_stmt_bind_param($statement,"i",$user_id);
            mysqli_stmt_execute($statement);
            mysqli_stmt_bind_result($statement,$username,$user_email);
            while(mysqli_stmt_fetch($statement)){       
              ?>
                <h4>Leave a Comment:</h4>
                <form action="#" method="post" role="form">

                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" placeholder="<?php echo $username; ?>" value="<?php echo $username; ?>"
                            autocomplete="on" name="comment_author" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="Author">Email</label>
                        <input type="email" placeholder="<?php echo $user_email; ?>" value="<?php echo $user_email; ?>"
                            autocomplete="on" name="comment_email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>
            <!-- end of while loop -->
            <?php }?>

            <?php 
            // to get user details of the logged in user



    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
    $query .= "AND comment_status = 'approved' ";
    $query .= "ORDER BY comment_id DESC ";
    $select_comment_query = mysqli_query($connection, $query);
    if(!$select_comment_query) {

        die('Query Failed' . mysqli_error($connection));
     }
    while ($row = mysqli_fetch_array($select_comment_query)) {
    $comment_date   = $row['comment_date']; 
    $comment_content= $row['comment_content'];
    $comment_author = $row['comment_author'];
        
        ?>


            <!-- Comment -->
            <div class="media">
                <?php 
                $user_id=$_SESSION['user_id'];
                $query="SELECT image FROM users WHERE user_id=?";
                $statement=mysqli_prepare($connection,$query);
                mysqli_stmt_bind_param($statement,"i",$user_id);
                mysqli_stmt_execute($statement);
                mysqli_stmt_bind_result($statement,$image);
                while(mysqli_stmt_fetch($statement)){
                
                
                ?>

                <a class="pull-left" href="#">
                    <img class="media-object" style="width:100px; height:100px;" src="./images/<?php echo $image; ?>"
                        alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author;   ?>
                        <small><?php echo $comment_date;   ?></small>
                    </h4>

                    <?php echo $comment_content;   ?>

                </div>
            </div>
            <?php }?>



            <?php } }    else {


    header("Location: index.php");


    }
        ?>



        </div>



        <!-- Blog Sidebar Widgets Column -->


        <?php include "includes/sidebar.php";?>


    </div>
    <!-- /.row -->

    <hr>



    <?php include "includes/footer.php";?>

    <script>
    $(document).ready(function() {

        $("[data-toggle='tooltip']").tooltip();
        var post_id = <?php echo $the_post_id; ?>;
        var user_id = <?php echo loggedInUserId(); ?>;

        // LIKING

        $('.like').click(function() {
            $.ajax({
                url: "/blogsystem/post.php?p_id=<?php echo $the_post_id; ?>",
                type: 'post',
                data: {
                    'liked': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }
            });
        });

        // UNLIKING
        $('.unlike').click(function() {

            $.ajax({

                url: "/blogsystem/post.php?p_id=<?php echo $the_post_id; ?>",
                type: 'post',
                data: {
                    'unliked': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }
            });
        });
    });
    </script>