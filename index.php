<?php
include("config/db.php");

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    if ($username != '' && $email != '' && $password != '') {
        $password_hash = sha1($password);
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        $query = $conn->query($sql);
        if ($query) {
            header('Location:login.php');
        } else {
            $error = "Failed to register";
        }
    } else {
        $error = "Please fill all details";
    }
}
?>
<?php include("inc/header.php") ?>
<div class="container">
    <form action="index.php" method="POST" class="form-horizontal">
        <fieldset>
            <legend>Regitration</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-lg-2 col-form-label">Username</label>
                        <div class="col-lg-10">
                            <input type="text" name="username" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="col-lg-2 col-form-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="col-lg-2 col-form-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="submit" name="register" value="Register" class="btn btn-primary">
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-lg-60">
                        <?php if (isset($_POST['register'])) : ?>
                            <div class="alert alert-dismissible alert-warning">
                                <p>
                                    <?php echo $error; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php include("inc/footer.php") ?>