<?php
if (isset($_GET["id"])) {
    $user_id = escape($_GET["id"]);
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $user = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($user);
    $username = $row["username"];
    $pass = $row["password"];
    $fName = ucwords($row["firstname"]);
    $lName = ucwords($row["lastname"]);
    $role = $row["role"];
    $email = $row["email"];
    $img = $row["user_image"];
}

if (isset($_POST["update_user"])) {
    $update_id = escape($_GET["id"]);
    $update_first_name = escape($_POST["first_name"]);
    $update_last_name = escape($_POST["last_name"]);
    $update_username = escape($_POST["username"]);
    $update_email = escape($_POST["email"]);
    $update_password = escape($_POST["password"]);
    $update_password = password_hash($update_password, PASSWORD_BCRYPT);
    $update_role = escape($_POST["role"]);
    $update_img = escape($_FILES["img"]["name"]);
    $update_img_tmp = escape($_FILES["img"]["tmp_name"]);
    move_uploaded_file($update_img_tmp, "../img/$update_img");
    if (empty($update_img)) {
        $query = "SELECT * FROM users WHERE user_id = $update_id";
        $get_old_img = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($get_old_img);
        $update_img = $row["user_image"];
    }

    $query = "UPDATE users SET ";
    $query .= "username = '$update_username', ";
    $query .= "password = '$update_password', ";
    $query .= "firstname = '$update_first_name', ";
    $query .= "lastname = '$update_last_name', ";
    $query .= "role = '$update_role', ";
    $query .= "email = '$update_email', ";
    $query .= "user_image = '$update_img'";
    $query .= "WHERE user_id = $update_id";
    // echo $query;
    $update_user = mysqli_query($connection, $query);
    confirmQuery($update_user);
    header("Location: users");
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="" class="form-control" value="<?= $fName ?>" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="" class="form-control" value="<?= $lName ?>" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="" class="form-control" value="<?= $username ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="" class="form-control" value="<?= $email ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="">User Role</label>
        <div>
            <input type="radio" name="role" id="sub" value="subscriber" <?= $role == 'subscriber' ? "checked" : "" ?>>
            <label for="sub">Subscriber</label>
        </div>
        <div>
            <input type="radio" name="role" id="editor" value="editor" <?= $role == 'editor' ? "checked" : "" ?>>
            <label for="editor">Editor</label>
        </div>
        <div>
            <input type="radio" name="role" id="admin" value="admin" <?= $role == 'admin' ? "checked" : "" ?>>
            <label for="admin">Admin</label>
        </div>
    </div>
    <div class="form-group">
        <label for="img">Profile Image</label>
        <img src="../img/<?= $img ?>" alt="" width="100px" style="display:block">
        <input type="file" name="img" id="" class="form-control" value="<?= $img ?>">
    </div>
    <button type="submit" name="update_user" class="btn btn-success">Edit User</button>
</form>