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
                $source = (isset($_GET["source"])) ? $_GET["source"] : "";
                switch ($source) {
                    case "add_user":
                        include "includes/adduser.php";
                        break;
                    case "edit_user":
                        include "includes/edituser.php";
                        break;
                    case "34":
                        echo "working";
                        break;
                    default:
                        include "includes/allusers.php";
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

<?php include "includes/adminfooter.php" ?>