<?php
    session_start();
?>
<?php if(!$_SESSION['username']): ?>
    <?php header('Location:../authentication/login.php')?>
<?php endif;?>

<?php 
    include("./config/db.php");
    include("./inc/header.php");
    $id = $_SESSION["id"];
    $query = "SELECT * FROM profile WHERE userId = '$id'";
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
        <h1 style="text-align:center">Admin Dashboard</h1>
    <?php else: ?>
        <h1 style="text-align:center">User Dashboard</h1>
    <?php endif; ?>
    <div class="container">
        <h2 style="text-align:center;"><?php echo $_SESSION['username'];?></h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p style="text-align:center">
                <img src="<?php echo $avatar;?>" alt="Image" style="width:200px;height:200px;border-radius:50%;">
                <h4 style="text-align:center"><?php echo $profession;?></h4>
            </p>
            <h1 style="text-align:center">
                All Posts
            </h1>
        </div>
    </div>
    
    <?php 
        $posts_query = "SELECT * FROM post";
        $posts_result = mysqli_query($conn,$posts_query) or die("error");
        if(mysqli_num_rows($posts_result)>0){
            while($post = mysqli_fetch_assoc($posts_result)){
                $id = $post['id'];
                $title = $post['title'];
                $description = $post['description'];
                $category = $post['category'];
                $featured_image = $post['featuredImage'];
                ?>
                <div class="row"  style="margin:10px 100px;">
                    <div class="col-lg-2">
                            <img style="width: 150px;height:150px;" src="<?php echo $featured_image?>">
                    </div>
                    <div class="col-lg-10">
                          <h1><a href=""><?php echo $title?></a></h1>
                          <p><?php echo $description?></p>  
                          <a href=""><?php echo $category?></a>
                          <div class="row">
                              <div class="col-lg-1">
                                  <a href=view.php?id=<?php echo $id?>>View</a>
                              </div>
                              <div class="col-lg-1">
                                  <a href=edit.php?id=<?php echo $id?>>Edit</a>
                              </div>
                              <div class="col-lg-1">
                                  <a href=delete.php?id=<?php echo $id?>>Delete</a>
                              </div>
                          </div>
                    </div>
                </div>
                <?php
            }
        }
    ?>
    
<?php include("./inc/footer.php") ?>


