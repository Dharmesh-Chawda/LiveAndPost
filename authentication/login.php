<!DOCTYPE html>
<html lang="en">

<head>
    <title>Live And Post</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <div class="header">
        <h2>Login</h2>
    </div>

    <form method="post" action="login.php">
        <div class="input-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" name="login" class="btn">Login</button>
        </div>
        <p>
            Don't have an account? <a href="register.php">Register</a>
        </p>
    </form>
</body>

</html>