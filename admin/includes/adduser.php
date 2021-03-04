<?php
if (isset($_POST["add_user"])) {
    // echo print_r($_FILES);
    $first_name = ucwords(escape($_POST["first_name"]));
    $last_name = ucwords(escape($_POST["last_name"]));
    $username = escape($_POST["username"]);
    // $date = date("d-m-y");
    $email = escape($_POST["email"]);
    $password = escape($_POST["password"]);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $role = escape($_POST["role"]);
    $img = escape($_FILES["img"]["name"]);
    $img_temp = escape($_FILES["img"]["tmp_name"]);

    move_uploaded_file($img_temp, "../img/$img");
    $query = "INSERT INTO users(username, password, firstname, lastname, role, email, user_image) ";
    $query .= "VALUES('$username', '$password', '$first_name', '$last_name', '$role', '$email', '$img')";
    // echo $query;
    $new_user = mysqli_query($connection, $query);
    confirmQuery($new_user);
    header("Location: /cms/admin/users");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">User Role</label>
        <div>
            <input type="radio" name="role" id="sub" value="subscriber" checked>
            <label for="sub">Subscriber</label>
        </div>
        <div>
            <input type="radio" name="role" id="editor" value="editor">
            <label for="editor">Editor</label>
        </div>
        <div>
            <input type="radio" name="role" id="admin" value="admin">
            <label for="admin">Admin</label>
        </div>
    </div>
    <div class="form-group">
        <label for="img">Profile Image</label>
        <input type="file" name="img" id="" class="form-control">
    </div>
    <button type="submit" name="add_user" class="btn btn-success">Add User</button>
</form>