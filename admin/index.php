<?php include "includes/adminheader.php";
include "includes/adminnav.php";
$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$draftposts = mysqli_query($connection, $query);
$draftcount = mysqli_num_rows($draftposts);
$query = "SELECT * FROM posts WHERE post_status = 'published'";
$pubposts = mysqli_query($connection, $query);
$pubcount = mysqli_num_rows($pubposts);
$query = "SELECT * FROM posts";
$allposts = mysqli_query($connection, $query);
$postcount = mysqli_num_rows($allposts);
$query = "SELECT * FROM comments";
$allcomments = mysqli_query($connection, $query);
$commentcount = mysqli_num_rows($allcomments);
$query = "SELECT * FROM comments WHERE comment_status = 'approved'";
$appcomments = mysqli_query($connection, $query);
$appcommentcount = mysqli_num_rows($appcomments);
$query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$dappcomments = mysqli_query($connection, $query);
$dappcommentcount = mysqli_num_rows($dappcomments);
$query = "SELECT * FROM users";
$allusers = mysqli_query($connection, $query);
$usercount = mysqli_num_rows($allusers);
$query = "SELECT * FROM users WHERE role = 'subscriber'";
$subs = mysqli_query($connection, $query);
$subcount = mysqli_num_rows($subs);
$query = "SELECT * FROM users WHERE role = 'admin'";
$admins = mysqli_query($connection, $query);
$admincount = mysqli_num_rows($admins);
$query = "SELECT * FROM users WHERE role = 'editor'";
$editors = mysqli_query($connection, $query);
$editorcount = mysqli_num_rows($editors);
$query = "SELECT * FROM categories";
$catQuery = mysqli_query($connection, $query);
$catcount = mysqli_num_rows($catQuery);
$query = "SELECT COUNT(post_title) AS 'Posts', categories.cat_title as 'Category' FROM posts ";
$query .= "INNER JOIN categories ON posts.post_category_id=categories.cat_id GROUP BY 2;";
$postsByCat = mysqli_query($connection, $query);
// confirmQuery(($postsByCat));
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="page-wrapper" style="min-height: calc(100vh - 50px)">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome
                    <small><?= $_SESSION["firstname"] ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?= $postcount ?></div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?= $commentcount ?></div>
                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?= $usercount ?></div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?= $catcount ?></div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div id="columnchart_posts" class="col-lg-3 col-md-6  justify-content-center" style="height: 500px;"></div>
            <div id="columnchart_comments" class="col-lg-3 col-md-6  justify-content-center" style="height: 500px;"></div>
            <div id="columnchart_users" class="col-lg-3 col-md-6  justify-content-center" style="height: 500px;"></div>
            <div id="columnchart_categories" class="col-lg-3 col-md-6  justify-content-center" style="height: 500px;"></div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawPostsChart);
    google.charts.setOnLoadCallback(drawCommentsChart);
    google.charts.setOnLoadCallback(drawUsersChart);
    google.charts.setOnLoadCallback(drawCatChart);

    function drawPostsChart() {
        var data = google.visualization.arrayToDataTable([
            ["", "Published Posts", "Draft Posts"],
            <?= "['Posts', $pubcount, $draftcount]" ?>
        ]);
        var options = {
            chart: {
                // title: 'MYCMS Posts',
                // subtitle: '',
            },
            legend: {
                position: "none"
            },
            isStacked: true,
            vAxis: {
                // format: "#"
            }
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_posts'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

    function drawCommentsChart() {
        var data = google.visualization.arrayToDataTable([
            ["", "Approved Comments", "Unapproved Comments"],
            <?= "['Comments', $appcommentcount, $dappcommentcount]" ?>
        ]);
        var options = {
            chart: {
                // title: 'MYCMS Posts',
                // subtitle: '',
            },
            legend: {
                position: "none"
            },
            isStacked: true,
            vAxis: {
                // format: "#"
            }
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_comments'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

    function drawUsersChart() {
        var data = google.visualization.arrayToDataTable([
            ["", "Subscribers", "Editors", "Admin"],
            <?= "['Users', $subcount, $editorcount, $admincount]" ?>
        ]);
        var options = {
            chart: {
                // title: 'MYCMS Posts',
                // subtitle: '',
            },
            legend: {
                position: "none"
            },
            isStacked: true,
            vAxis: {
                // format: "#"
            }
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_users'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

    function drawCatChart() {
        var data = google.visualization.arrayToDataTable([
            <?php
            $labels = "['', ";
            $counts = "['Categories', ";
            while ($row = mysqli_fetch_assoc($postsByCat)) {
                $label = $row["Category"];
                $count = $row["Posts"];
                $labels .= "'$label', ";
                $counts .= "$count, ";
            }
            $labels .= "], ";
            $counts .= "]";
            echo $labels;
            echo $counts;
            ?>
        ]);
        var options = {
            chart: {
                // title: 'MYCMS Posts',
                // subtitle: '',
            },
            legend: {
                position: "none"
            },
            isStacked: true,
            vAxis: {
                // format: "#"
            }
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_categories'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
<?php include "includes/adminfooter.php" ?>