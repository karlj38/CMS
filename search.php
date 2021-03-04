<?php
include "includes/db.php";
include "includes/header.php";
include "includes/nav.php";
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            if (isset($_GET["search"])) {
                $search = escape($_GET["search"]);
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published' ORDER BY post_id DESC";
                showPostsSummaries($query);
            }
            ?>


        </div>

        <?php
        include "includes/sidebar.php";
        ?>


    </div>
    <!-- /.row -->

    <hr>
    <?php
    include "includes/footer.php";
    ?>