<?php
include "includes/db.php";
include "includes/header.php";
include "includes/nav.php";
$post_id = escape($_GET["id"]);

if (isset($_POST["add_comment"])) {
    $comment_author = ucwords(escape($_POST["comment_author"]));
    $comment_email = escape($_POST["comment_email"]);
    $comment_content = escape($_POST["comment_content"]);
    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
    $query .= "VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now()) ";
    $new_comment = mysqli_query($connection, $query);
    confirmQuery($new_comment);
    if (confirmQuery($new_comment)) {
        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
        $update_count = mysqli_query($connection, $query);
        confirmQuery($update_count);
    }
}
$query = "SELECT * FROM posts WHERE post_id = $post_id";
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php showPost($query); ?>
            <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="comment_author">Name</label>
                        <input type="text" name="comment_author" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" name="comment_email" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <textarea name="comment_content" class="form-control" rows="3" placeholder="Enter your comment" required></textarea>
                    </div>
                    <button type="submit" name="add_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER by comment_id DESC";
            showComments($query);
            ?>
        </div>

        <?php
        include "includes/sidebar.php"
        ?>


    </div>
    <!-- /.row -->

    <hr>
    <?php
    include "includes/footer.php"
    ?>