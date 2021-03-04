<?php
include "includes/db.php";
include "includes/header.php";
include "includes/nav.php";
$cat_title = escape($_GET["category"]);
$query = mysqli_query($connection, "SELECT cat_id FROM categories WHERE cat_title = '$cat_title'");
$row = mysqli_fetch_assoc($query);
$cat_id = $row["cat_id"];
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?= $cat_title ?>
                <small>Secondary Text</small>
            </h1>

            <?php

            $query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status = 'published' ORDER BY post_id DESC";
            showPostsSummaries($query);
            ?>

            <!-- First Blog Post -->

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