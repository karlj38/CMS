<?php
function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}
function confirmQuery($query)
{
    global $connection;
    if (!$query) {
        die("QUERY FAILED " . mysqli_error($connection));
    } else return true;
}
function insert_categories()
{
    global $connection;
    if (isset($_POST["new_cat"])) {
        $new_cat = escape($_POST["new_cat"]);
        if (!$new_cat) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUE('$new_cat')";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("QUERY FAILED " . mysqli_error($connection));
            }
            header("Location: categories.php");
        }
    }
}

function findAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories ORDER BY cat_title ASC";
    $categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($categories)) :
        $id = $row["cat_id"];
        $title = $row["cat_title"];
?>
        <tr>
            <td><?= $id ?></td>
            <td><a href="../category?category=<?= $id ?>"><?= $title ?></a></td>
            <td class="text-center"><a href="categories?delete=<?= $id ?>" onClick="return confirm('Are you sure you want to delete: \n<?= $title ?>?');">Delete</a></td>
            <td class="text-center"><a href="categories?edit=<?= $id ?>">Edit</a></td>
        </tr>
    <?php
    endwhile;
}

function delete_category()
{
    global $connection;
    if (isset($_GET["delete"])) {
        $delete_cat = escape($_GET["delete"]);
        $query = "DELETE FROM categories WHERE cat_id = {$delete_cat}";
        $deleted = mysqli_query($connection, $query);
        header("Location: categories");
    }
}

function findAllPosts()
{
    global $connection;
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($posts)) :
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

        $cat_query = "SELECT * FROM categories WHERE cat_id = $cat";
        $cats = mysqli_query($connection, $cat_query);
        $row = mysqli_fetch_assoc($cats);
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];
    ?>
        <tr>
            <td><input type="checkbox" name="check[]" value="<?= $id ?>" id="" class="checkbox"></td>
            <td><?= $id ?></td>
            <td><?= $author ?></td>
            <td><a href="../post?id=<?= $id ?>"><?= $title ?></a></td>
            <td><a href="../category?category=<?= $cat_id ?>"><?= $cat_title ?></a></td>
            <td><?= $status ?></td>
            <td><?= $img ? "<img src='../img/$img' width='100px'>" : "" ?></td>
            <td><?= $tags ?></td>
            <td><?= $comment_count ?></td>
            <td><?= $date ?></td>
            <!-- <td><?= $content ?></td> -->
            <td class="text-center"><a href="posts?delete=<?= $id ?>" onClick="return confirm('Are you sure you want to delete: \n<?= $title ?>?');">Delete</a></td>
            <td class="text-center"><a href="posts?source=edit_post&id=<?= $id ?>">Edit</a></td>
        </tr>
    <?php
    endwhile;
}

function delete_post($delete_id)
{
    global $connection;
    $query = "DELETE FROM posts WHERE post_id = $delete_id";
    $deleted = mysqli_query($connection, $query);
    confirmQuery(($deleted));
}

function findAllComments()
{
    global $connection;
    $query = "SELECT * FROM comments ORDER BY comment_id DESC";
    $comments = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($comments)) :
        $comment_id = $row["comment_id"];
        $post_id = $row["comment_post_id"];
        $comment_author = $row["comment_author"];
        $comment_email = $row["comment_email"];
        $comment_date = $row["comment_date"];
        $comment_content = $row["comment_content"];
        $comment_status = $row["comment_status"];

        $post_query = "SELECT * FROM posts WHERE post_id = $post_id";
        $post = mysqli_query($connection, $post_query);
        $row = mysqli_fetch_assoc($post);
        $this_post_title = $row["post_title"];
        $this_post_id = $row["post_id"];
    ?>
        <tr>
            <td><?= $comment_id ?></td>
            <td><a href=" ../post?id=<?= $this_post_id ?>"><?= $this_post_title ?></a></td>
            <td><?= $comment_author ?></td>
            <td><?= $comment_content ?></td>
            <td><?= $comment_email ?></td>
            <td><?= $comment_date ?></td>
            <td><?= $comment_status ?></td>
            <td class="text-center"><a href="comments?approve=<?= $comment_id ?>">Approve</a></td>
            <td class="text-center"><a href="comments?unapprove=<?= $comment_id ?>">Unapprove</a></td>
            <td class="text-center"><a href="comments?delete=<?= $comment_id ?>" onClick="return confirm('Are you sure you want to delete: \n<?= $comment_content ?>?');">Delete</a></td>
        </tr>
    <?php
    endwhile;
}

function delete_comment($delete_id)
{
    global $connection;
    $query = "SELECT comment_post_id FROM comments WHERE comment_id = $delete_id";
    $get_post_id = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($get_post_id);
    $post_id = $row["comment_post_id"];

    $query = "DELETE FROM comments WHERE comment_id = $delete_id";
    $deleted = mysqli_query($connection, $query);
    confirmQuery(($deleted));
    if (confirmQuery($deleted)) {
        $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $post_id";
        $update_count = mysqli_query($connection, $query);
        confirmQuery($update_count);
    }
}

function approve_comment($comment_id)
{
    global $connection;
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
    $update_comment = mysqli_query($connection, $query);
    confirmQuery($update_comment);
}
function unapprove_comment($comment_id)
{
    global $connection;
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";
    $update_comment = mysqli_query($connection, $query);
    confirmQuery($update_comment);
}

function findAllUsers()
{
    global $connection;
    $query = "SELECT * FROM users ORDER BY role";
    $users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($users)) :
        $user_id = $row["user_id"];
        $username = $row["username"];
        $user_first_name = $row["firstname"];
        $user_last_name = $row["lastname"];
        $user_email = $row["email"];
        $user_role = $row["role"];
        $user_img = $row["user_image"];
    ?>
        <tr>
            <td><?= $user_id ?></td>
            <td><?= $username ?></td>
            <td><?= $user_first_name ?></td>
            <td><?= $user_last_name ?></td>
            <td><?= $user_email ?></td>
            <td><?= $user_role ?></td>
            <td><?= $user_img ? "<img src='../img/$user_img' width='100px'>" : "" ?></td>
            <td class=""><a href="users?delete=<?= $user_id ?>" onClick="return confirm('Are you sure you want to delete: \n<?php echo "$username ($user_first_name $user_last_name)" ?>?');">Delete</a></td>
            <td class=""><a href="users?source=edit_user&id=<?= $user_id ?>">Edit</a></td>
        </tr>
        <?php
    endwhile;
}

function delete_user($delete_id)
{
    global $connection;
    $query = "DELETE FROM users WHERE user_id = $delete_id";
    $deleted = mysqli_query($connection, $query);
    confirmQuery(($deleted));
}

function showPostsSummaries($query)
{
    global $connection;
    $posts = mysqli_query($connection, $query);
    $rows = mysqli_fetch_all($posts, MYSQLI_ASSOC);
    // print_r($rows);

    if (empty($rows)) {
        echo "<h1>No posts to display</h1>";
    } else {
        foreach ($rows as $row) :
            $id = $row["post_id"];
            $title = ucwords($row["post_title"]);
            $author = ucwords($row["post_author"]);
            $date = $row["post_date"];
            $image = $row["post_img"];
            $content = $row["post_content"];
            $content = strlen($content) < 100 ? $content : substr($row["post_content"], 0, 100) . "...";
        ?>
            <h2>
                <a href="post?id=<?= $id ?>"><?= $title ?></a>
            </h2>
            <p class="lead">
                by <a href="#"><?= $author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $date ?></p>
            <hr>
            <?php
            if ($image) {
                echo "<a href='post?id=$id'>
                        <img class='img-responsive' src='img/$image' alt=''>
                        </a>
                    <hr>";
            }
            ?>
            <p><?= $content ?></p>
            <a class="btn btn-primary" href="post?id=<?= $id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
    <?php
        endforeach;
    };
}

function showPost($query)
{
    global $connection;
    $post = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($post);
    $title = ucwords($row["post_title"]);
    $author = ucwords($row["post_author"]);
    $date = $row["post_date"];
    $image = $row["post_img"];
    $content = $row["post_content"];
    ?>
    <h1 class="page-header">
        <?= $title ?>
        <!-- <small>Secondary Text</small> -->
    </h1>

    <!-- <h2>
        <a href="#"><?= $title ?></a>
    </h2> -->
    <p class="lead">
        by <a href="index.php"><?= $author ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $date ?></p>
    <hr>
    <?php
    if ($image) {
        echo "<img class='img-responsive' src='img/$image' alt=''>
                    <hr>";
    }
    ?>
    <p><?= $content ?></p>
    <?php
}


function showComments($query)
{
    global $connection;

    $get_comments = mysqli_query($connection, $query);
    confirmQuery($get_comments);
    while ($row = mysqli_fetch_assoc($get_comments)) :
        $comment_date = $row["comment_date"];
        $comment_author = $row["comment_author"];
        $comment_content = $row["comment_content"];
    ?>
        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?= $comment_author ?>
                    <small><?= $comment_date ?></small>
                </h4>
                <p><?= $comment_content ?></p>
            </div>
        </div>
<?php endwhile;
}
