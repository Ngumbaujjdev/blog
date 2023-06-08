<!-- To add new user -->
<?php
if(isset($_POST['create_user'])){

$user_firstname        = escape($_POST['user_firstname']);
$user_lastname        = escape($_POST['user_lastname']);
$username                = escape($_POST['username']);
$user_role        = escape($_POST['user_role']);
$user_email       = escape($_POST['user_email']);
$user_password        = escape($_POST['user_password']);
$user_password = escape(password_hash($user_password, PASSWORD_BCRYPT, array('cost', 10)));



$query = "INSERT INTO users( username, user_firstname, user_lastname, user_role,user_email,user_password) ";
             
$query .= "VALUES('{$username}','{$user_firstname }','{$user_lastname }','{$user_role }','{$user_email}', '{$user_password}') ";

$create_user_query = mysqli_query($connection, $query);
   confirmQuery($create_user_query);

   echo " User Created: "." ". "<a href= 'users.php'>View Users?</a>";

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
     
     <!-- enctype is used to send different types of form data -->
      <div class="form-group">
         <label for="user_firstname">Firstname</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>
       <div class="form-group">
       <label for="user_lastname">Lastname</label>
       <input  type="text" class = "form-control" name="user_lastname">
      </div>

      <div class="form-group">
         <label for="username">Username</label>
         <input type="text" class="form-control" name="username">
      </div>




      <div class="form-group">
         <select name="user_role" id="">






         <option value="Subscriber">Select Role</option>
             <option value="Admin">Admin</option>
             <option value="Subscriber">Subscriber</option>
            
            <!-- $query = "SELECT * FROM users ";
            $display_user_role_query = mysqli_query($connection , $query);

            while($row  = mysqli_fetch_assoc( $display_user_role_query)){
                $user_id = $row['user_id'];
                $user_role = $row['user_role'];

                echo "<option value = '$user_id' >{$user_role}</option>"; -->
                    

             
         </select>
      </div>





      
      <div class="form-group">
         <label for="user_email">Email</label>
         <input type="email" class="form-control" name="user_email">
         
      </div>

      <div class="form-group">
         <label for="user_password">Password</label>
         <input autocomplete="off" type="password" class="form-control" name="user_password">
      </div>
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="New User">
      </div>


</form>




















