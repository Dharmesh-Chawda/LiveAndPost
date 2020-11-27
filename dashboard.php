<?php
    session_start();
?>
<?php if(!$_SESSION['username']): ?>
    <?php header('Location:login.php')?>
<?php endif;?>

<?php 
    include("./config/db.php");
    include("./inc/header.php");
    $id = $_SESSION["id"];
    $query = "SELECT * FROM profile WHERE user_id = '$id'";
    $result = mysqli_query($conn,$query) or die('error');
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row["id"];
            $avatar = $row["avatar"];
            $profession = $row["profession"];
        }
    }else{
        $url = $_SERVER['PHP_SELF'];
        $seg = explode('/',$url);
        $path = "http://localhost".$seg[0].'/'.$seg[1];
        $avatar = $path.'/img/profile_pic.png';
        $profession = "";
    }
?>
    <?php if($_SESSION['user_role']==1):?>
        <h2 class="dash-head">Admin Dashboard</h2>
    <?php else: ?>
        <h2 class="dash-head">User Dashboard</h2>
    <?php endif; ?>

    <div class="profile">
        <div class="member text-center">
            <div class="card">
                <figure>
                    <img src="<?php echo $avatar;?>" class="" alt="card image">
                </figure>
                <hr>
                <h4><?php echo $_SESSION['username'];?></h4>
                <p><?php echo $profession;?></p>
            </div>
        </div>
    </div>
    
    <?php 
        $posts_query = "SELECT * FROM posts";
        $posts_result = mysqli_query($conn,$posts_query) or die("error");
        if(mysqli_num_rows($posts_result)>0){
            
                ?>  
                <h1 style="margin-left:100px;margin-bottom:30px">
                    All Posts
                    <hr> 
                </h1>   



                        <?php 
                            while($post = mysqli_fetch_assoc($posts_result))
                            {
                            $id = $post['id'];
                            $title = $post['title'];
                            $description = $post['description'];
                            $category = $post['category'];
                            $featured_image = $post['featured_image'];
                        ?>


                <div class="proj-content">
                    <div class="row post-box"> 

                        <div class="col-md-3">
                            <div class="post-icon">
                                <img style="height:60%;width:100%" src="<?php echo $featured_image?>">
                            </div>
                        </div>

                        <div class="col-md-9">

                            <div class="post-listing-details">
                                <h4 class="post-title">
                                    <a><?php echo $title?></a>
                                </h4>
                                <div class="post-description">
                                    <p><?php echo substr($description,0,300)."...";?></p>
                                </div>
                                <div class="post-date">
                                <a href=""><a href=""><i class="fa fa-bookmark"></i>&nbsp;<?php echo $category?></a><br><br>

                                    <div class="row">
                                        <div class="col-lg-1">
                                            <a class="btn btn-primary" href=view.php?id=<?php echo $id?>>View</a>
                                        </div>
                                        <?php if(isset($_SESSION['username']) && $_SESSION['user_role']==1):?>
                                        <div class="col-lg-1">
                                            <a class="btn btn-primary" href=edit.php?id=<?php echo $id?>>Edit</a>
                                        </div>
                                        <div class="col-lg-1">
                                            <a class="btn btn-primary" href=delete.php?id=<?php echo $id?>>Delete</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>


                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>

            </div>
                <?php
            }
        }
    ?>

    
<?php include("./inc/footer.php") ?>


