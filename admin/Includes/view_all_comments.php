<!-- Query to use select options to change comment_status  -->
<?php 
if(isset($_POST['checkBoxArray'])){

foreach($_POST['checkBoxArray'] as $commentValueId){
    $bulk_options = $_POST['bulk_options'];

switch($bulk_options){
// To change comment status to unapproved
case 'Approved':
$query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId} ";
$update_to_approved_status = mysqli_query($connection, $query);
confirmQuery($update_to_approved_status);
break;




//  To change comment status to unapproved
case 'Unapproved':
    $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId} ";
    $update_to_unapproved_status = mysqli_query($connection, $query);
    confirmQuery($update_to_unapproved_status);
break;



//  To delete comment
case 'delete':
$query = "DELETE * FROM comments  WHERE comment_id = {$commentValueId} ";
$delete_comment_query = mysqli_query($connection, $query);
confirmQuery($delete_comment_query);
break;

}
}

}

?>



<form action= "" method = 'post'>
<table class="table table-bordered table-hover">

<div id = "bulkOptionsContainer" class = "col-xs-4">
<select class = "form-control" name= "bulk_options" id="">
    <option value = "">Select Options</option>
    <option value = "published">Approve</option>
    <option value = "draft">Unapprove</option>
    <option value = "delete">Delete</option>
    
</select>
</div>



<div class="col-xs-4">
    <input type="submit" name="submit" class= "btn btn-success" value = "Apply"> 
   
</div>





































<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th><input id ="selectAllBoxes" type = "checkbox"></th>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comments</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response to(Post)</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>
                                
                               
                            </tr>
                        </thead>
                        <tbody>


<?php

$query = "SELECT * FROM comments";
$select_comments_query = mysqli_query($connection,$query);

while ($row = mysqli_fetch_assoc($select_comments_query)) {
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content'];
    $comment_email = $row['comment_email'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
    ?>


    <td><input class ='checkBoxes' type = 'checkbox' name='checkBoxArray[]' value='<?php   echo $comment_id;  ?>'></td>;


    <?php
    echo "<td>  $comment_id</td>";
    echo "<td>{$comment_author}</td>";
    echo "<td>{$comment_content}</td>";
    echo "<td>{$comment_email}</td>";
    echo "<td>{$comment_status}</td>";

    $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
    $select_comment_post_id_query = mysqli_query($connection,$query);  
    while($row = mysqli_fetch_assoc($select_comment_post_id_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
        echo "<td><a href = '../post.php?p_id=$post_id'>{$post_title}</a></td>";
    }

    echo "<td>{$comment_date}</td>";
    echo "<td><a href = 'comments.php?Approve=$comment_id'>Approve</a></td>";
    echo "<td><a href = 'comments.php?Unapprove=$comment_id'>Unapprove</a></td>";
    echo "<td><a onClick = \" javascript: return confirm('Are you sure you want to delete?');\"  href = 'comments.php?delete=$comment_id'>Delete</a></td>";
    echo "</tr>";



}
?>    
                       
                    </tbody>
                    </table>

                    <!-- To delete a comment -->

<?php
if(isset($_GET['delete'])){
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id =$the_comment_id";
    $delete_comments_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}
?>

<!-- query to Unapprove comments -->

<?php
if(isset($_GET['Unapprove'])){
    $the_comment_id = $_GET['Unapprove'];
    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id =$the_comment_id";
    $Unapprove_comments_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}
?>

<!-- query to Approve comments -->

<?php
if(isset($_GET['Approve'])){
    $the_comment_id = $_GET['Approve'];
    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id =$the_comment_id";
    $Approve_comments_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}
?>








