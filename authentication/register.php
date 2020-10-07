<?php
include("../config/db.php");
$errors = "";
$username = "";
$password = "";
$email = "";
if (isset($_POST["register"])) {

    if ($_POST['username'] != "") {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        if ($username == "") {
            $errors .= 'Please enter a valid name.<br/><br/>';
        }
    } else {
        $errors .= 'Please enter a Username.<br/><br/>';
    }

    if ($_POST['email'] != "") {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if ($email == "" || filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
            $errors .= 'Please enter a valid email.<br/><br/>';
        }
    } else {
        $errors .= 'Please enter your email address.<br/><br/>';
    }

    if ($_POST["password"] != "") {
        $password = $_POST["password"];
    } else {
        $errors .= "Please enter a password.<br/><br/>";
    }

    if (!$errors) {
        $password_hash = sha1($password);
        $sql = "INSERT INTO users (username, email, password,user_role) VALUES ('$username', '$email', '$password_hash',1)";
        $query = $conn->query($sql);
        if ($query) {
            $errors = "";
            $username = "";
            $password = "";
            $email = "";
            header('Location:login.php');
        } else {
            $error = "Failed to register";
        }
    }
}
?>
<?php include("../inc/header.php") ?>
<div class="container">
    <form action="register.php" method="POST" class="form-horizontal">
        <fieldset>
            <legend>Regitration</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-lg-2 col-form-label">Username</label>
                        <div class="col-lg-10">
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="col-lg-2 col-form-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
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
                                    <?php echo $errors; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php include("../inc/footer.php") ?>