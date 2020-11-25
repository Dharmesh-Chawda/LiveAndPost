<?php 
    session_start();
?>

<?php if(!isset($_SESSION['username'])): ?>
    <?php header('Location:dashboard.php') ?>
<?php else: ?>
<?php include("inc/header.php");?>
    <div class="container" style="margin:10px 100px;">
        <?php 
            include("./config/db.php");
            $post_id = $_GET['id'];
            $posts_query = "SELECT * FROM posts WHERE id='$post_id'";
            $posts_result = mysqli_query($conn,$posts_query) or die("error");
            if(mysqli_num_rows($posts_result)>0){
                while($post = mysqli_fetch_assoc($posts_result)){
                    $title = $post['title'];
                    $description = $post['description'];
                    $category = $post['category'];
                    $featured_image = $post['featured_image'];
                }
            }
        ?>
        <h1 style="text-align:center"><?php echo $title;?></h1>
        <div class="row">
            <div class="col-lg-4">
                <img style="width:300px;height:300px;" src="<?php echo $featured_image?>" >
            </div>
            <div class="col-lg-8">
                <p><?php echo $description;?></p>
                <a href=""><?php echo $category;?></a>
                <div class="row">
                        <div class="col-lg-2">
                            <?php 
                                $query = "SELECT * FROM likes WHERE post_id ='$post_id'";
                                $like_result = mysqli_query($conn,$query);
                                $likes =  mysqli_num_rows($like_result);
                            ?>
                            <a href="like.php?id=<?php echo $post_id?>" style="background: none;color:#337ab7;border:none;">
                                Like
                            </a>
                            <?php 
                                echo $likes;
                            ?>
                        </div>
                        <div class="col-lg-2">
                            <a href="">Comment</a>
                        </div>                    
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
<?php include("inc/footer.php")?>