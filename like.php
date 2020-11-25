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
        $query = "INSERT INTO likes(post_id,user_id) VALUES ('$post_id','$user_id')";
        $result = $conn->query($query);
        if($result){
            header('Location:view.php?id='.$post_id);
        }else{
            echo "Error while giving a like";
        }
    ?>
<?php endif; ?>