<?php
include "db.php";
include "../admin/includes/functions.php";
session_start();

if (isset($_POST["login"])) {
    $login = escape($_POST["username"]);
    $pass = escape($_POST["password"]);
    $query = "SELECT * FROM users WHERE username = '$login'";
    $user = mysqli_query($connection, $query);
    confirmQuery($user);
    $row = mysqli_fetch_assoc($user);
    if ($row) {
        $username = $row["username"];
        $hash = $row["password"];
        $first_name = $row["firstname"];
        $last_name = $row["lastname"];
        $user_role = $row["role"];

        if (password_verify($pass, $hash)) {
            $_SESSION["username"] = ucwords($username);
            $_SESSION["firstname"] = ucwords($first_name);
            $_SESSION["lastname"] = ucwords($last_name);
            $_SESSION["fullname"] = ucwords("$first_name $last_name");
            $_SESSION["user_role"] = $user_role;
            header("Location: ../admin");
            return;
        }
    }
    header("Location: ../");
}
