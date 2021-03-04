<?php
include "includes/adminheader.php";
include "includes/adminnav.php";
delete_category(); ?>

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
                <div class="col-sm-6">
                    <?php insert_categories(); ?>
                    <form action="" method="post">
                        <label for="cat_title">Add Category</label>
                        <div class="form-group">
                            <input type="text" name="new_cat" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Category" class="btn btn-primary">
                        </div>
                    </form>
                    <?php
                    if (isset($_GET["edit"])) {
                        $edit_id = escape($_GET["edit"]);
                        include "includes/update_categories.php";
                    }
                    ?>
                </div>
                <div class="col-sm-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php findAllCategories(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/adminfooter.php" ?>