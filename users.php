<?php 
    session_start();
?>

<?php if(!isset($_SESSION['username'])): ?>
    <?php header('Location:dashboard.php') ?>
<?php else: ?>
    <?php 
        include("inc/header.php");
        include("./config/db.php");
    ?>

    <div class="container">
        <h1 style="text-align:center"">All Users</h1>
        <?php 
            $sql = "SELECT * FROM users INNER JOIN profile ON users.id = profile.user_id and profile.user_role = '0'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)){
                while($user = mysqli_fetch_array($result)){
                    $id = $user['id'];
                    $username = $user['username'];
                    $email = $user['email'];
                    $avatar = $user['avatar'];
                    ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="<?php echo $avatar?>" alt ="Profile Pic" style = "height:200px;width:200px;border-radius:50%">
                        </div>
                        <div class="col-lg-8">
                            <h2><?php echo $username?></h2>
                            <p><?php echo $email?></p>
                        </div>
                    </div>
                    <hr>
                    <?php 
                }
            }
        ?>
    </div>
<?php endif; ?>