<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Update Category</label>
        <?php

// to get the cat title on the input before we update
if(isset($_GET['Edit'])){
$cat_id=$_GET['Edit'];
}
$statement = mysqli_prepare($connection,"SELECT cat_id, cat_title FROM categories WHERE cat_id = ?");
mysqli_stmt_bind_param($statement,"i", $cat_id);
mysqli_stmt_execute($statement);
mysqli_stmt_bind_result($statement, $cat_id, $cat_title);

while(mysqli_stmt_fetch($statement)) {

?>

        <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title" required>


        <?php } mysqli_stmt_close($statement); ?>
        <!-- Update Query -->
        <?php

if(isset($_POST['update_category'])){
$the_cat_title=$_POST['cat_title'];

$statement = mysqli_prepare($connection,"UPDATE categories SET cat_title = ? WHERE cat_id = ?");
    mysqli_stmt_bind_param($statement, "si" , $the_cat_title , $cat_id);
    mysqli_stmt_execute($statement);
    
    if(!$statement) {
        die("Statment Failed" . mysqli_stmt_error($connection));
    }
    
    mysqli_stmt_close($statement);
    redirect("admin_category.php");



}
?>





    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update">
    </div>

</form>