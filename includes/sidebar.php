<?php
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);
?>
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search" method="get">
            <div class="input-group">
                <input name="search" type="text" class="form-control" required>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <?php if (!isset($_SESSION["user_role"])) : ?>
        <!-- Login Well -->
        <div class="well">
            <h4>Login</h4>
            <form action="includes/login" method="post">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Login</button>
                    </span>
                </div>

            </form>
            <!-- /.input-group -->
        </div>
    <?php endif; ?>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-xs-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($categories)) {
                        $cat = $row["cat_id"];
                        $title = $row["cat_title"];
                        echo "<li><a href='category?category=$title'>{$title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>