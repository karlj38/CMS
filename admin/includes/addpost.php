<?php
if (isset($_POST["add_post"])) {
    // echo print_r($_FILES);
    $title = ucwords(escape($_POST["post_title"]));
    $cat = escape($_POST["post_cat_id"]);
    $author = ucwords(escape($_POST["post_author"]));
    $date = date("d-m-y");
    $content = escape($_POST["post_content"]);
    $img = $_FILES["post_img"]["name"];
    $img_temp = $_FILES["post_img"]["tmp_name"];
    $tags = escape($_POST["post_tags"]);
    $status = escape($_POST["post_status"]);

    move_uploaded_file($img_temp, "../img/$img");
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_content, post_img, post_tags, post_status) ";
    $query .= "VALUES($cat, '$title', '$author', now(), '$content', '$img', '$tags', '$status')";
    // echo $query;
    $new_post = mysqli_query($connection, $query);
    confirmQuery($new_post);
    header("Location: /cms/admin/posts");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_cat">Post Category</label>
        <!-- <input type="text" name="post_cat_id" id="" class="form-control"> -->
        <select name="post_cat_id" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $categories = mysqli_query($connection, $query);
            confirmQuery($categories);
            while ($row = mysqli_fetch_assoc($categories)) {
                $id = $row["cat_id"];
                $title = $row["cat_title"];
                echo "<option value='$id'>$title</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" id="" class="form-control" value="<?= $_SESSION["fullname"] ?>">
    </div>
    <div class=" form-group">
        <label for="">Post Status</label>
        <div>
            <input type="radio" name="post_status" id="pub" value="published">
            <label for="pub">Published</label>
        </div>
        <div>
            <input type="radio" name="post_status" id="draft" value="draft">
            <label for="draft">Draft</label>
        </div>
    </div>
    <div class="form-group">
        <label for="post_img">Post Image</label>
        <input type="file" name="post_img" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="editor" name="post_content" id="" class="form-control"></textarea>
    </div>
    <button type="submit" name="add_post" class="btn btn-success">Add Post</button>
</form>