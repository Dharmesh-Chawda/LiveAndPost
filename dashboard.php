<?php
    session_start();
?>
<?php include("./inc/header.php") ?>

    <div class="container">
        <p>Welcome <?php echo $_SESSION['username'];?></p>
    </div>
<?php include("./inc/footer.php") ?>


