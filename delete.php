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
        if( mysqli_query($conn,$query)){
            $query = "DELETE FROM likes WHERE post_id='$id'";
            if(mysqli_query($conn,$query)){
                $query = "DELETE FROM comments WHERE post_id='$id'";
                if(mysqli_query($conn,$query)){
                    header('Location:dashboard.php');
                }else{
                    header('Location:dashboard.php');
                }
            }else{
                header('Location:dashboard.php');
            }
        }else{
            header('Location:dashboard.php');
        }
    ?>
<?php endif; ?>