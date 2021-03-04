<?php
if (isset($_GET["delete"])) {
    delete_post((escape($_GET["delete"])));
}

if (isset($_POST["check"])) {
    $option = escape($_POST["bulk"]);
    foreach ($_POST["check"] as $selectedId) {
        if ($option === "delete") {
            delete_post($selectedId);
        } else {
            $query = "UPDATE posts SET post_status = '$option' WHERE post_id = $selectedId";
            $update_post = mysqli_query($connection, $query);
        }
    }
}

?>
<form action="" method="post">
    <div class="row">
        <div id="bulkOptionContainer" class="col-xs-4 form-group">
            <select name="bulk" id="" class=" form-control">
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <button type="submit" class="btn btn-success" value="apply">Apply</button>
            <a class="btn btn-primary" href="posts?source=add_post">Add new</a>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllPosts"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php findAllPosts(); ?>
        </tbody>
    </table>
</form>