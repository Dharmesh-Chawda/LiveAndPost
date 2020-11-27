<!DOCTYPE html>
<html lang="en">

<head>
    <title>Live And Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style/viewstyle.css">
    <link rel="stylesheet" type="text/css" href="style/indexstyle.css">

</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="dashboard.php">Live & Post</a>
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <?php $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?>
                <?php if($url=='http://localhost/liveandpost/login.php'): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php elseif($url=='http://localhost/liveandpost/register.php'): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="profile.php">Edit Profile</a>
                    </li>
                    
                    <?php if(isset($_SESSION["username"]) && $_SESSION['user_role']==1):?>
                        <li class="nav-item active">
                            <a class="nav-link" href="post.php">Add Post</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="users.php">All Users</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item active">
                
                </li>
            </ul>
        </div>
    </nav>