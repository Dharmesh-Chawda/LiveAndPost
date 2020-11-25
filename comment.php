<?php 
    session_start();
?>

<?php if(!isset($_SESSION['username'])): ?>
    <?php header("Location:dashboard.php") ?>
<?php else: ?>
     <?php 
        include("./config/db.php");
        if(isset($_POST["postcomment"])){
            $comment = $_POST['comment'];
            $user_id = $_SESSION['id'];
            $post_id = $_POST['id'];
            
            if($comment != ""){
                $query = "INSERT INTO comments(post_id,user_id,comment) VALUES ('$post_id', '$user_id', '$comment')";
                $query = $conn->query($query);
                if($query){
                    header("Location:view.php?id=".$post_id);
                }else{
                    
                    echo "Error commenting";
                }
            }
        }
    ?> 
<?php endif; ?>