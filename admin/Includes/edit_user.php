<?php

if (isset($_GET['p_id'])) {
    $the_user_id = $_GET['p_id'];


    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_user_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_by_id)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];

    }



    // query to update now

    if (isset($_POST['update_user'])) {
        $username = escape($_POST['username']);
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_role = escape($_POST['user_role']);
        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['user_password']);


        if (!empty($user_password)) {
            $query = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $select_user_password_by_id = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($select_user_password_by_id);
            $db_user_password = $row['user_password'];

            if ($db_user_password != $user_password) {

                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost', 10));



                $query = "UPDATE users SET ";
                $query .= "username  = '{$username}', ";
                $query .= "user_firstname = '{$user_firstname}', ";
                $query .= "user_lastname = '{$user_lastname}', ";
                $query .= "user_role = '{$user_role}', ";
                $query .= "user_email   = '{$user_email}', ";
                $query .= "user_password   = '{$hashed_password}'";
                $query .= "WHERE user_id ='{$the_user_id}' ";
                $update_user_query = mysqli_query($connection, $query);

                echo " User Updated: <a href= 'users.php'>View Users?</a>";


            }
        }

    }
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

$fieldsToCheck = ['user_firstname', 'user_lastname', 'user_role','username', 'user_email'];
checkEmptyFields($fieldsToCheck);
?>





<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input value = "<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
      </div>


      <div class="form-group">
       <label for="user_lastname">Lastname</label>
       <input value = "<?php echo $user_lastname; ?>" type="text" class = "form-control" name="user_lastname">
      </div>

      <div class="form-group">
         <label for="username">Username</label>
         <input value = "<?php echo $username; ?>" type="text" class="form-control" name="username">
      </div>




      <div class="form-group">
         <select name="user_role" id="">
            <!-- query to display the users role from the database -->
         <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>

         <?php 
         if($user_role == 'Admin'){
             echo "<option value='Subscriber'>Subscriber</option>";
         }else{
             echo "<option value='Admin'>Admin</option>";
         }
         
         ?>   
         </select>
      </div>




      <div class="form-group">
         <label for="user_email">Email</label>
         <input value = "<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
         
      </div>
      <div class="form-group">
         <label for="user_password">Password</label>
         <input autocomplete= "off" type="passwword" class="form-control" name="user_password">
         
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
      </div>
</form>