<?php
include "includes/adminheader.php";
include "includes/adminnav.php";
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to admin
                    <small>Author</small>
                </h1>
                <!-- <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol> -->
                <?php
                $source = (isset($_GET["source"])) ? escape($_GET["source"]) : "";
                switch ($source) {
                    case "add_post":
                        include "includes/addpost.php";
                        break;
                    case "edit_post":
                        include "includes/edit_post.php";
                        break;
                    case "34":
                        echo "working";
                        break;
                    default:
                        include "includes/allposts.php";
                        break;
                }

                ?>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<?php include "includes/adminfooter.php" ?>