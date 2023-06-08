<?php include "./includes/db.php"; ?>
<?php include "./includes/header.php"; ?>
<?php include"./functions.php" ?>
<?php
// isloggeninid

if(userLikedPost(195)){
    echo "ALREADY LIKED THE POST";
}else{
    echo "NOT YET LIKED THE POST";
}


?>