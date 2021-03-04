<?php
if (isset($_GET["delete"])) {
    if (isset($_SESSION["user_role"])) {
        if ($_SESSION["user_role"] == "admin") {
            $userID = escape($_GET["delete"]);
            delete_user($userID);
        }
    }
}

?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php findAllUsers(); ?>

    </tbody>
</table>