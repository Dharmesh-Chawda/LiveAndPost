
    <?php
        session_start();
        include("../config/db.php");
        $email = "";
        $password = "";
        
        if(isset($_POST['login']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($email != "" && $password != "")
            {
                $passwdd = sha1($password);
                $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$passwdd'";
                $result = mysqli_query($conn, $sql) or die('Error');
                if(mysqli_num_rows($result) >0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $id = $row['id'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $user_role = $row['user_role'];

                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        $_SESSION['user_role'] = $user_role;
                        header('Location:../dashboard.php');
                    }
                }
                else
                {
                    $error = "Username or Password is Incorrect!";
                }
            }
            else
            {
                $error = "Please fill all the details";
            }
        }

    ?>

    <?php include("../inc/header.php") ?>
    <?php if(isset($_SESSION['username'])): ?>
        <?php header('Location:../dashboard.php')?>
    <?php else: ?>
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-horizontal">
                <fieldset>
                    <legend>Login</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="col-lg-2 col-form-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value=<?php echo $email;?>>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="col-lg-2 col-form-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" name="password" class="form-control" placeholder="Password" value = <?php echo $password; ?>>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <input type="submit" name="login" value="Login" class="btn btn-primary">
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="form-group">
                        <div class="col-lg-60">
                            <?php if (isset($_POST['login'])) : ?>
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
    <?php endif; ?>
    <?php include("../inc/footer.php") ?>

