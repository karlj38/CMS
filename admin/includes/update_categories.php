<?php
if (isset($_GET["edit"])) :
    $query = "SELECT * FROM categories WHERE cat_id = $edit_id";
    $edit = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($edit);
    $id = $row["cat_id"];
    $title = $row["cat_title"];
?>
    <form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Edit Category</label>
            <input type="text" name="update_title" value="<?= $title ?>" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Edit Category" class="btn btn-primary">
        </div>
    </form>
<?php
endif;

if (isset($_POST["update_title"])) {
    $update_title = escape($_POST["update_title"]);
    $query = "UPDATE categories SET cat_title = '$update_title' WHERE cat_id = $edit_id;";
    $updated = mysqli_query($connection, $query);
    if (!$updated) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
    header("Location: categories.php");
}

?>