<?php 
    session_start();
?>

<?php if(!isset($_SESSION['username'])): ?>
    <?php header('Location:dashboard.php') ?>
<?php else: ?>
    <?php 
        include("./config/db.php");
        $id = $_GET["id"];
        $query = "DELETE FROM posts WHERE id='$id'";
        $result = mysql_query($conn,$query) or die("error");
        if( mysql_query($conn,$query)){
            header('Location:dashboard.php');
        }else{
            header('Location:dashboard.php');
        }
    ?>
<?php endif; ?>