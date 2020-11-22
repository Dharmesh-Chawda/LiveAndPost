<?php
    session_start();
?>
<?php if(!$_SESSION['username']): ?>
    <?php header('Location:../authentication/login.php')?>
<?php endif;?>
<?php include("./inc/header.php") ?>

    <div class="container">
        <p>Welcome <?php echo $_SESSION['username'];?></p>
    </div>
<?php include("./inc/footer.php") ?>


