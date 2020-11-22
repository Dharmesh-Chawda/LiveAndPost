<!DOCTYPE html>
<html lang="en">

<head>
    <title>Live And Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="col-lg-10">
            <a href="#" class="navbar-brand" style="color:#fff">Live & Post</a>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Settings
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?>
            <?php if($url=='http://localhost/liveandpost/authentication/login.php'): ?>
                <a class="dropdown-item" href="../authentication/register.php">Register</a>
            <?php elseif($url=='http://localhost/liveandpost/authentication/register.php'): ?>
                <a class="dropdown-item" href="../authentication/login.php">Login</a>
            <?php else: ?>
                <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                <a class="dropdown-item" href="profile.php">Edit Profile</a>
                <a class="dropdown-item" href="post.php">Add Post</a>
                <a class="dropdown-item" href="./authentication/logout.php">Logout</a>
            <?php endif; ?>
            </div>
        </div>
    </nav>
</body>