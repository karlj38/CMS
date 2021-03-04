<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms">MYCMS</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "SELECT * FROM categories";
                $categories = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($categories)) {
                    $title = $row["cat_title"];
                    $id = $row["cat_id"];
                    echo "<li><a href='category?category=$title'>{$title}</a></li>";
                }
                ?>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <a href="registration">Register</a>
                </li>
                <?php
                if (isset($_SESSION["user_role"])) {
                    echo "<li>
                        <a href='admin'>Admin</a>
                    </li>";
                    if (isset($_GET["id"])) {
                        $id = escape($_GET["id"]);
                        echo "<li>
                            <a href='admin/posts?source=edit_post&id=$id'>Edit</a>
                        </li>";
                    }
                }
                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>