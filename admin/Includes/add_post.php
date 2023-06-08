<?php
if(isset($_POST['create_post'])){

   $post_title        = escape($_POST['title']);
   $post_user       = escape($_POST['post_user']);
   $post_category_id  = escape($_POST['post_category']);
   $post_status       = escape($_POST['post_status']);

   $post_image        = $_FILES['image']['name'];
   $post_image_temp   = $_FILES['image']['tmp_name'];


   $post_tags         =escape($_POST['post_tags']);
   $post_content      = escape($_POST['post_content']);
   $post_date         = escape(date('d-m-y'));
   $user_id           =escape($_SESSION['user_id']);

// To move the image to the server location from the temporary location
   move_uploaded_file($post_image_temp, "../images/$post_image");

$query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status,user_id) ";            
$query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}',{$user_id}) ";
$create_post_query = mysqli_query($connection, $query);
confirmQuery($create_post_query);

// Since there is no id (new post being created) use this function to pull the last ID created in that table
$the_post_id = mysqli_insert_id($connection);
// Update notification
echo "<p class= 'bg-success'> Post Created: <a href= '../post.php?p_id={$the_post_id}'>View Post</a> Or <a href='posts.php'>Edit More Posts </a> </p>";
}


?>








<!-- To validate -->
<?php
function checkEmptyFields($fields) {
    $emptyFields = [];

    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $emptyFields[] = $field;
        }
    }

    if (!empty($emptyFields)) {
        echo "<h3>Fields cannot be empty</h3>" ;
    }
}

$fieldsToCheck = ['title', 'post_category', 'post_status', 'post_image', 'post_content', 'post_tag', 'post_user'];
checkEmptyFields($fieldsToCheck);
?>




<form action="" method="post" enctype="multipart/form-data">

    <!-- enctype is used to send different types of form data -->
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="title">Category</label>

        <select name="post_category" id=" ">
            <?php
        
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection,$query);
        confirmQuery($select_categories);

        

        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<option value='$cat_id'>{$cat_title}</option>";
        }
        
        ?>

        </select>

    </div>



    <div class="form-group">
        <label for="title">Users</label>
        <select name="post_user" id=" ">
            <?php
        
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection,$query);
        confirmQuery( $select_users);

        while ($row = mysqli_fetch_assoc( $select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];

            echo "<option value='{$username}'>{$username}</option>";
        }
        
        ?>

        </select>

    </div>






    </div>





    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">published</option>
            <option value="draft">Draft</option>
        </select>
    </div>



    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control " name="post_content" id="body" cols="30" rows="10">
         </textarea>
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Create Post">
    </div>


</form>
<script>
ClassicEditor
    .create(document.querySelector('#body'))
    .catch(error => {
        console.error(error);
    });
</script>