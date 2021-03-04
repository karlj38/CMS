<?php
if (isset($_POST["update_post"])) {
    $update_id = escape($_GET["id"]);
    $update_title = ucwords(escape($_POST["post_title"]));
    $update_cat = escape($_POST["post_cat"]);
    $update_author = ucwords(escape($_POST["post_author"]));
    // $update_date = $_POST["post_date"];
    $update_content = escape($_POST["post_content"]);
    $update_img = $_FILES["post_img"]["name"];
    $update_img_tmp = $_FILES["post_img"]["tmp_name"];
    $update_tags = escape($_POST["post_tags"]);
    $update_status = escape($_POST["post_status"]);
    // $update_comment_count = $_POST["post_comment_count"];
    move_uploaded_file($update_img_tmp, "../img/$update_img");
    if (empty($update_img)) {
        $query = "SELECT * FROM posts WHERE post_id = $update_id";
        $get_old_img = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($get_old_img);
        $update_img = $row["post_img"];
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '$update_title', ";
    $query .= "post_category_id = $update_cat, ";
    $query .= "post_author = '$update_author', ";
    $query .= "post_content = '$update_content', ";
    $query .= "post_img = '$update_img', ";
    $query .= "post_tags = '$update_tags', ";
    $query .= "post_status = '$update_status', ";
    $query .= "post_date = now() ";
    $query .= "WHERE post_id = $update_id";
    // echo $query;
    $update_post = mysqli_query($connection, $query);
    if (confirmQuery($update_post)) {
        echo "<p class='bg-success'>Post updated. <a href='../post?id=$update_id'>View Post</a></p>";
    }
}

if (isset($_GET["id"])) {
    $post_id = escape($_GET["id"]);
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $post = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($post);
    $id = $row["post_id"];
    $title = $row["post_title"];
    $cat = $row["post_category_id"];
    $author = $row["post_author"];
    $date = $row["post_date"];
    $content = $row["post_content"];
    $img = $row["post_img"];
    $tags = $row["post_tags"];
    $status = $row["post_status"];
    $comment_count = $row["post_comment_count"];
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" value="<?= $title ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_cat">Post Category</label>
        <select name="post_cat" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $categories = mysqli_query($connection, $query);
            confirmQuery($categories);
            while ($row = mysqli_fetch_assoc($categories)) {
                $id = $row["cat_id"];
                $title = $row["cat_title"];
                $selected = ($id === $cat) ? "selected" : "";
                echo "<option value='$id' $selected>$title</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" value="<?= $author ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Post Status</label>
        <div class="">
            <input type="radio" name="post_status" id="pub" value="published" <?= $status == "published" ? "checked" : "" ?>>
            <label for="pub">Published</label>
        </div>
        <div class="">
            <input type="radio" name="post_status" id="draft" value="draft" <?= $status == "draft" ? "checked" : "" ?>>
            <label for="draft">Draft</label>
        </div>
    </div>
    <div class="form-group">
        <label for="post_img">Post Image</label>
        <img src="../img/<?= $img ?>" alt="post image" width="100px" style="display:block">
        <input type="file" name="post_img" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" value="<?= $tags ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="editor" name="post_content" class="form-control"><?= $content ?></textarea>
    </div>
    <button type="submit" name="update_post" class="btn btn-primary">Edit Post</button>
</form>