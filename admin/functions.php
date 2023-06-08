<?php
//to redirect to  a page

// ====Database helper functions

function redirect($location){
    global $connection;

     header("Location: $location ");
    exit;        
}
// query for the global connection
function query($query){
    global $connection;
    return mysqli_query($connection,$query);
}
function currentUser(){
    if(isset($_SESSION['username'])){
        return $_SESSION['username'];
    }
    return false;
}
// image place holder
function imagePlaceHolder($image=''){
    if(!$image){
        return 'php.jpg';
    }else{
        return $image;
    }
}
?>


<?php 
function ifItIsmethod($method= null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}
?>

<?php
function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}
// isloggeninid
function loggedInUserId(){
    if(isLoggedIn()){
        $result=query("SELECT * FROM users WHERE username='".$_SESSION['username']. "'");
        $users=mysqli_fetch_array($result);
        return mysqli_num_rows($result) >=1 ?$users['user_id']:false;
       
    }
    return false;
}
function userLikedThisPost($post_id){
   $result= query("SELECT * FROM likes WHERE user_id=".loggedInUserId() ."AND post_id={$post_id}");
   return mysqli_num_rows($result) >=1 ? true :false;
}
?>

<?php
function checkIfUserIsLoggedInAndRedirect($redirectLocation = null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}
?>
<?php 
function getPostlikes($post_id){
    $result=query("SELECT * FROM likes WHERE post_id=$post_id");
    confirmQuery($result);
    echo mysqli_num_rows($result);
}



?>
<?php
function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("Query Failed." . mysqli_error($connection));
    }
}
?>
<?php



?>





<?php
//function to insert the categories into the database  using prepared statement
function insert_categories(){
    global $connection;

    if(isset($_POST['submit'])){
    $cat_title = $_POST['cat_title'];
    
    $statement = mysqli_prepare($connection,"INSERT INTO categories(cat_title) VALUES (?)" );
    mysqli_stmt_bind_param($statement, "s", $cat_title);
        mysqli_stmt_execute($statement);


    if(!$statement){
        die('Query Failed' );

    }
    }
}






// find all categories
function findAllcategories(){
    global $connection;
    $query = "SELECT * FROM categories";
$select_categories_query = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_categories_query )) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

echo "<tr>";
echo "<td>{$cat_id}</td>";
echo "<td>{$cat_title}</td>";
echo "<td><a  onClick = \" javascript: return confirm('Are you sure you want to delete?');\"   href = 'admin_category.php?Delete={$cat_id}'>Delete</a></td>";
echo "<td><a href = 'admin_category.php?Edit={$cat_id}'>Edit</a></td>";
echo "</tr>";

}

}


// Delete Query
function delete_categories(){
    global $connection;

    if(isset($_GET['Delete'])){

        $the_cat_id=$_GET['Delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Locations: admin_category.php");
    
    
    
    
    }
}


?>
<?php

// Users online
function users_online(){
    // instant count using ajax(instant loader)
    if (isset($_GET['usersonline'])) {


        global $connection;
        if(!$connection){
            session_start();
            include("../includes/db.php");


            $session = session_id();
            $time = time();
            $time_out_in_seconds = 3000;
            $time_out = $time - $time_out_in_seconds;
    
    
            // To count the users online
            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $query = mysqli_query($connection, $query);
            $count_users_online_query = mysqli_num_rows($query);
    
            // logic
            if ($count_users_online_query == null) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    
            }
            // Query to display the users online
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $number_of_users_online = mysqli_num_rows($users_online_query);
        }   

    }    //get isset request


}
users_online();
?>


<?php  

//To escape ...more security features 
function escape($string){
    global $connection;


    return mysqli_real_escape_string($connection, trim($string));
}


?>

<?php 
//function to refactor he admin index (recordcount of the different tables in the system) in the dashboard
function recordcount($table){
    global $connection;
    $query = "SELECT * FROM .$table";
    $query = mysqli_query($connection, $query);
    return $recordcount = mysqli_num_rows($query);

}
function count_records($result){
    return mysqli_num_rows($result);
}
function recordcountForUser($table){
     global $connection;
    $query = "SELECT * FROM .$table WHERE user_id=".$_SESSION['user_id']."";
    $query = mysqli_query($connection, $query);
    return $recordcount = mysqli_num_rows($query);
}
function get_all_post_user_comments(){
    global $connection;
    $query="SELECT * FROM comments WHERE user_id=".$_SESSION['user_id']."";
    $get_all_comments=mysqli_query($connection,$query);
    return mysqli_num_rows($get_all_comments);
}
function get_all_post_user_categories(){
    global $connection;
    $query="SELECT * FROM categories WHERE user_id=".$_SESSION['user_id']."";
    $get_all_comments=mysqli_query($connection,$query);
    return mysqli_num_rows($get_all_comments);
}
?>


<?php 
// function to check status then return the record count then display in the graph
function checkStatus($table, $column , $status){
    global $connection;
$query = "SELECT * FROM $table WHERE $column = '$status'";
$query = mysqli_query($connection, $query);
return $count = mysqli_num_rows($query);

}
function checkStatusForSpecificUser($table, $column , $status){
    global $connection;
$query = "SELECT * FROM  $table  WHERE $column = '$status' AND user_id=".$_SESSION['user_id']."";
$get_user_status = mysqli_query($connection, $query);
return  mysqli_num_rows($get_user_status);

}
?>








<?php
// new registration system
// check whether a user is an admin or not
function is_Admin(){
global $connection;
if(isLoggedIn()){
$query = "SELECT user_role FROM  users WHERE user_id = ".$_SESSION['user_id']."";
$select_users_by_user_role = mysqli_query($connection , $query);
    confirmQuery($select_users_by_user_role);

    $row = mysqli_fetch_assoc($select_users_by_user_role);

    if($row['user_role'] == 'Admin'){
        return true;

    }else {
        return false;
    }
}
return false;
}
?>


<?php
//check if a username exists
function username_exists($username){
        global $connection;
        $query = "SELECT username FROM  users WHERE user_id=".$_SESSION['user_id']."";
        $check_username = mysqli_query($connection , $query);
        confirmQuery($check_username);

        if(mysqli_num_rows($check_username) > 1){
        return true; 

        }else {
        return false;
        }
}





// Check if email exists
function emailExists($email){
global $connection;
$query="SELECT user_email FROM users WHERE user_email='$email'";
$result=mysqli_query($connection,$query);

if(!$result){
die("QUERRY FAILED");
}
if(mysqli_num_rows($result)>1){
return true;
}else{
return false;
}

}


function get_username(){

        return isset( $_SESSION['username']) ? $_SESSION['username'] :null;
    
}

?>



<?php
//function to  register a user
function register_user($username,$email,$password){
    global $connection;
            // prevent sql injection
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);

            // To encrypt passwords
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost', 10));

            // query to insert into the database
    
            $query = "INSERT IGNORE INTO users (username, user_email, user_password, user_role) ";
            $query .= "VALUES ('{$username}', '{$email}', '{$password}', 'Subscriber')";

            $register_user_query = mysqli_query($connection, $query);
            confirmQuery($register_user_query);

        }
?>




<?php 
//function to  login a user
function login_user($username, $password)
 {

     global $connection;

     $username = trim($username);
     $password = trim($password);

     $username = mysqli_real_escape_string($connection, $username);
     $password = mysqli_real_escape_string($connection, $password);


     $query = "SELECT * FROM users WHERE username = '{$username}' ";
     $select_user_query = mysqli_query($connection, $query);
     if (!$select_user_query) {

         die("QUERY FAILED" . mysqli_error($connection));

     }


     while ($row = mysqli_fetch_array($select_user_query)) {

         $db_user_id = $row['user_id'];
         $db_username = $row['username'];
         $db_user_password = $row['user_password'];
         $db_user_firstname = $row['user_firstname'];
         $db_user_lastname = $row['user_lastname'];
         $db_user_role = $row['user_role'];


         if (password_verify($password,$db_user_password)) {

             $_SESSION['user_id'] = $db_user_id;
             $_SESSION['username'] = $db_username;
             $_SESSION['firstname'] = $db_user_firstname;
             $_SESSION['lastname'] = $db_user_lastname;
             $_SESSION['user_role'] = $db_user_role;
             if($_SESSION['user_role']=='admin'){
             redirect("/blogsystem/admin");
             }else{
                redirect("/blogsystem");

             }


         } else {


             return false;



         }



     }

     return true;

 }

?>