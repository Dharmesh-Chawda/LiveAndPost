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
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-6">
                <form action="comment.php" method="POST" class="form-horizontal">
                <input type="hidden" name="id" value="<?php echo $post_id?>">
                    <div class="form-group row">
                        <label class="col-lg-3 control-label">Add Comment</label>
                        <div class="col-lg-9">
                            <textarea name="comment" class="form-control" cols="10" rows="5" placeholder="Comment"></textarea>
                            <input type="submit" name= "postcomment" value="Comment" class = "btn btn-primary">
                            <a href="dashboard.php" class ="btn btn-default">Go Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-6">
                <h1>All Comments</h1>
                <?php 
                    $comment_query = "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id";
                    $comment_result = mysqli_query($conn,$comment_query);
                    if(mysqli_num_rows($comment_result)>0){
                        while($com = mysqli_fetch_assoc($comment_result)){
                            $comment = $com['comment']; 
                            $comment_user_id = $com['user_id'];
                            $user_query = "SELECT * FROM users WHERE id='$comment_user_id'";
                            $user_result= mysqli_query($conn,$user_query) or die("error");
                            if(mysqli_num_rows($user_result)){
                                while($user = mysqli_fetch_assoc($user_result)){
                                    $username = $user['username'];
                                }
                            }
                            ?>
                                <b><?php echo $username ?></b>
                                <p><?php echo $comment;?></p>
                                <hr>
                            <?php
                        }   
                    }
                ?>
            </div>
        </div>
    </div>

<?php endif; ?>
<?php include("inc/footer.php")?>