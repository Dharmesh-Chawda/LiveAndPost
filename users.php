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


        <h1 class="user-head">All Users</h1>

    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul id="users">
                        
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
                            <li class="user-box">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div>
                                            <img class="user-icon" src="<?php echo $avatar?>">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="user-listing-details">
                                            <div class="user-description">
                                                <h2><?php echo $username?></h2>
                                                <p><?php echo $email?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <?php 
                        }
                    }
                ?>
                
            </ul>
          </div> 
        </div>
    </div>
<?php endif; ?>
<?php include("./inc/footer.php") ?>
