<?php
if (isset($_GET["delete"])) {
    delete_comment((escape($_GET["delete"])));
}
if (isset($_GET["approve"])) {
    approve_comment((escape($_GET["approve"])));
}
if (isset($_GET["unapprove"])) {
    unapprove_comment((escape($_GET["unapprove"])));
}
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Post</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Date</th>
            <th>Status</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php findAllComments(); ?>

    </tbody>
</table>