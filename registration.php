<?php include "includes/db.php";
include "includes/header.php";
include "includes/nav.php";
$result = "";
if (isset($_POST["submit"])) {
    $newUsername = escape($_POST["username"]);
    $newEmail = escape($_POST["email"]);
    $newPassword = escape($_POST["password"]);
    $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $query = "INSERT INTO users(username, password, email) ";
    $query .= "VALUES('$newUsername', '$newPassword', '$newEmail')";
    $new_user = mysqli_query($connection, $query);
    if (confirmQuery($new_user)) {
        $result = "<p class='bg-success'>Registration submitted successfully.</p>";
    }
}
?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block form-group" value="Register">
                            </div>
                        </form>
                        <?= $result ?>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <hr>

    <?php include "includes/footer.php"; ?>