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
                Main Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC";
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