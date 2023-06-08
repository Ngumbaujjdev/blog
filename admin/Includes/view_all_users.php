<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Administrator</th>
                                <th>Subscriber</th>
                                <th>Edit</th>
                                <th>Delete</th>
                               
                            </tr>
                        </thead>
                        <tbody>

<!-- Query to display the users from db -->
<?php

$query = "SELECT * FROM users";
$select_users_query = mysqli_query($connection,$query);

while ($row = mysqli_fetch_assoc($select_users_query)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
   
    



    echo "<tr>";
    echo "<td> $user_id</td>";
    echo "<td>{$username}</td>";
    echo "<td>{$user_firstname}</td>";

    // $query = "SELECT * FROM categories where cat_id = {$post_category_id }";
    // $select_categories_by_id = mysqli_query($connection, $query);
    // while($row = mysqli_fetch_assoc($select_categories_by_id)){
    //     $cat_id = $row['cat_id'];
    //     $cat_title = $row['cat_title'];

    //     echo "<td>{$cat_title}</td>";
    // }


    echo "<td>{$user_lastname}</td>";
    // echo "<td><img width  = '100' src = '../images/$post_image' alt=''image></td>";
    // echo "<td>{$post_tags}</td>";

    echo "<td>{$user_email}</td>";
    echo "<td>{$user_role}</td>";

    echo "<td><a href = 'users.php?Change_to_Admin=$user_id'>Administrator</a></td>";
    echo "<td><a href = 'users.php?Change_to_Subscriber=$user_id'>Subscriber</a></td>";


    echo "<td><a href = 'users.php?source=edit_user&p_id={$user_id}'>Edit</a></td>";
    echo "<td><a   onClick = \" javascript: return confirm('Are you sure you want to delete?');\"  href = 'users.php?delete={$user_id}'>Delete</a></td>";
    echo "</tr>";




}
 

?>
                        
                    </tbody>
                    </table>


                    <!--  To delete a post-->

<?php

if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'Admin'){
            $user_id = mysqli_real_escape_string($connection, $_GET['delete']);

        }
    }


    $query = "DELETE FROM users WHERE user_id = {$user_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Locations: view_all_users.php");

}


?>




<!-- query to  change a users role to admin -->

<?php
if(isset($_GET['Change_to_Admin'])){
    $the_user_id = $_GET['Change_to_Admin'];
    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id =$the_user_id";
    $Change_role_to_Admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
}
?>

<!-- query to  change a users role to subscriber -->

<?php
if(isset($_GET['Change_to_Subscriber'])){
    $the_user_id = $_GET['Change_to_Subscriber'];
    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id =$the_user_id";
    $Change_role_to_Subscriber_query= mysqli_query($connection, $query);
    header("Location: users.php");
}
?>



