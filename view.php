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
            $user_id = $_SESSION['id'];
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
        <h1 style="margin-left:20px;margin-bottom:20px;margin-top:20px"><?php echo $title;?></h1>
        <div class="row">
            <div class="col-lg-4">
                <img style="width:300px;height:300px;" src="<?php echo $featured_image?>" >
            </div>
            <div class="col-lg-8">
                <p><?php echo $description;?></p>
                <a href=""><i class="fa fa-bookmark"></i>&nbsp;<?php echo $category;?></a>
                <div class="row">
                        <div class="col-lg-2">
                            <?php 
                                $query = "SELECT * FROM likes WHERE post_id ='$post_id'";
                                $like_result = mysqli_query($conn,$query);
                                $likes =  mysqli_num_rows($like_result);
                                $liked = false;
                                if($likes>0){
                                    while($like= mysqli_fetch_assoc($like_result)){
                                        if($like['user_id']===$user_id){
                                            $liked = true;
                                        }
                                    }
                                }
                            ?>
                            <?php if($liked===true): ?>
                                <a class="like" href="unlike.php?id=<?php echo $post_id?>">
                                    <i style="" class="fa fa-thumbs-up"></i>
                                </a>
                            <?php else: ?>
                                <a class="like" href="like.php?id=<?php echo $post_id?>">
                                    <i style="color:RoyalBlue;" class="fa fa-thumbs-o-up"></i>
                                </a>
                            <?php endif;?>
                            
                            <?php 
                                echo "<span class='like'>".$likes."</span>";
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
                        <label class="col-lg-1 control-label like"><i style="color:RoyalBlue;" class="fa fa-comment-o" aria-hidden="true"></i></label>
                        <div class="col-lg-8">
                            <textarea name="comment" class="form-control" cols="10" rows="1" placeholder="Comment"></textarea>
                            <input type="submit" name= "postcomment" value="Add" class = "btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-6">
                <?php 
                    $comment_query = "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id";
                    $comment_result = mysqli_query($conn,$comment_query);
                    if(mysqli_num_rows($comment_result)>0){
                        ?>
                        <h1>All Comments</h1>
                        <?php
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