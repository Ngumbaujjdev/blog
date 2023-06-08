<!-- table -->
<?php
include "delete_modal.php";


if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $post_value_id){
        $bulk_options=escape($_POST['bulk_options']);
        // switch the values
        switch( $bulk_options){
            case 'published':
                $query="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$post_value_id}";
                $update_to_publish=mysqli_query($connection,$query);
                if(!$update_to_publish){
                    die("unavailable");
                }

                break;
                case 'draft':
                $query="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$post_value_id}";
                $update_to_draft=mysqli_query($connection,$query);
                if(!$update_to_draft){
                    die("unavailable");
                }

                break;
                  case 'delete':
                $query="DELETE FROM posts WHERE post_id={$post_value_id}";
                $delete=mysqli_query($connection,$query);
                if(!$delete){
                    die("unavailable");
                }

                break;
                case 'clone':
                        $query="SELECT * FROM posts WHERE post_id={$post_value_id}";
                            // sending the query
                            $select_posts=mysqli_query($connection,$query);

                            // while loop to  select  all
                            while($row=mysqli_fetch_assoc($select_posts)){
                                $post_author=escape($row['post_author']);
                                $post_user=escape($row['post_user']);
                                $post_title=escape($row['post_title']);
                                $post_category_id=escape($row['post_category_id']);
                                $post_content=escape($row['post_content']);
                                $post_status=escape($row['post_status']);
                                $post_image=escape($row['post_image']);
                                $post_tags=escape($row['post_tags']);
                                 $post_comment_count=escape($row['post_comment_count']);
                                $post_date=escape($row['post_date']);
                            }
 $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status) ";
            //  concatinate the query
 $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
            //  send the query
      $create_post_query = mysqli_query($connection, $query); 
      if(!$create_post_query){
        die("QUERRY FAILED");
      } 
      break;

                
                

        }

    }
}









?>





















<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select options</option>
                <option value="published">publish</option>
                <option value="draft">draft</option>
                <option value="delete">delete</option>
                <option value="clone">clone</option>
            </select>



        </div>
        <div class="col-xs-4">
            <input type="submit" value="Apply" name="submit" class="btn btn-success">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>














        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>category</th>
                <th>content</th>
                <th>Status</th>
                <th>image</th>
                <th>Tags</th>
                <th>
                    comments
                </th>
                <th>
                    date
                </th>

                <th>Edit</th>
                <th>Delete</th>
                <th>View Post</th>
                <th>views</th>


            </tr>
        </thead>
        <tbody>

            <?php 
            $username=currentUser();
                            
                            // 
                            $query="SELECT * FROM posts  ORDER BY post_id DESC";
                            // sending the query
                            $select_posts=mysqli_query($connection,$query);

                            // while loop to  select  all
                            while($row=mysqli_fetch_assoc($select_posts)){
                                $post_id=$row['post_id'];
                                $post_author=$row['post_author'];
                                $post_user=$row['post_user'];
                                $post_title=$row['post_title'];
                                $post_category_id=$row['post_category_id'];
                                $post_content=$row['post_content'];
                                $post_status=$row['post_status'];
                                $post_image=$row['post_image'];
                                $post_tags=$row['post_tags'];
                                $post_comment_count=$row['post_comment_count'];                
                                $post_view_counts=$row['post_views_count'];                
                                $post_date=$row['post_date'];

                                echo "<tr>";
                                ?>
            <td><input class="checkBoxes" type='checkbox' id='selectAllBoxes' name="checkBoxArray[]"
                    value="<?php echo $post_id; ?>"></td>










            <?php
                      echo "<td> {$post_id}</td>";
                                
                                if(!empty($post_author)){
                                    echo "<td> {$post_author}</td>";

                                }elseif(!empty($post_user)){
                                      echo "<td> {$post_user}</td>";

                                }












                                echo "<td> {$post_title}</td>";

                                // query to select the query
                                $query="SELECT * FROM categories WHERE cat_id=$post_category_id";
                                $select_all_categories=mysqli_query($connection,$query);
                                while($row=mysqli_fetch_assoc($select_all_categories)){
                                    $cat_id=$row['cat_id'];
                                    $cat_title=$row['cat_title'];

                                     echo "<td> {$cat_title}</td>";


                                }

                               




                                echo "<td> {$post_content}</td>";
                                echo "<td>{$post_status} </td>";
                                echo "<td><img width='100' src='../images/{$post_image}' alt='image'></td>";
                                echo "<td> {$post_tags}</td>";


                              

        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $send_comment_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($send_comment_query);
        $comment_id = $row['comment_id'];
        $count_comments = mysqli_num_rows($send_comment_query);

                                // SEE ALL POST COMMENTS
                               echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";

                                echo "<td>{$post_date} </td>";
                                // UPDATE POSTS
                                echo "<td><a href='posts.php?source=update_post&p_id={$post_id}'>Edit</a></td>";
                          
                                echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>DELETE</a></td>";
                                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                                echo "<td><a href='posts.php?reset={$post_id}'>{$post_view_counts}</a></td>";
                                echo "</tr>";



                            }

                        
                        
                        
                        
                        
                        
                        ?>


        </tbody>


    </table>
</form>
<?php
                    if(isset($_GET['delete'])){
                        $the_post_id=$_GET['delete'];
                        $query="DELETE FROM posts WHERE post_id={$the_post_id}";
                        $delete_query=mysqli_query($connection,$query);
                        header("Location:posts.php");
                        
                        
                    }
                      if(isset($_GET['reset'])){
                        $the_post_id=$_GET['reset'];
                        $query="UPDATE posts SET post_view_counts=0  WHERE post_id=" .mysqli_real_escape_string($connection,$_GET['reset']) ."";
                        $reset_query=mysqli_query($connection,$query);
                        header("Location:posts.php");
                        
                        
                    }
                    
                    
                    
                    
                    
                    ?>

<script>
$(document).ready(function() {
    $(".delete_link").on('click', function() {
        var id = $(this).attr("rel");
        let deleteUrl = "posts.php?delete=" + id + " ";
        $(".modal_delete_link").attr("href", deleteUrl);

        $("#myModal").modal('show');


    });


});
</script>