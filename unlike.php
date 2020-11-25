<?php 
    session_start();
?>

<?php if(!isset($_SESSION['username'])): ?>
    <?php header("Location:dashboard.php") ?>
<?php else: ?>
    <?php 
        include("./config/db.php");
        $post_id = $_GET['id'];
        $user_id = $_SESSION["id"];
        $query = "DELETE FROM likes WHERE user_id = '$user_id' and post_id = '$post_id'";
        if(mysqli_query($conn, $query)){
            header('Location:view.php?id='.$post_id);
        }else{
            echo "Error while giving a like";
        }
    ?>
<?php endif; ?>