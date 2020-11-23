<?php include("inc/header.php");?>
    <div class="container" style="margin:10px 100px;">
        <?php 
            include("./config/db.php");
            $id = $_GET['id'];
            $posts_query = "SELECT * FROM post WHERE id='$id'";
            $posts_result = mysqli_query($conn,$posts_query) or die("error");
            if(mysqli_num_rows($posts_result)>0){
                while($post = mysqli_fetch_assoc($posts_result)){
                    $id = $post['id'];
                    $title = $post['title'];
                    $description = $post['description'];
                    $category = $post['category'];
                    $featured_image = $post['featuredImage'];
                    
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
                            <a href="">Like </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="">Dislike</a>
                        </div>
                        <div class="col-lg-2">
                            <a href="">Comment</a>
                        </div>                    
                </div>
            </div>
        </div>
    </div>

<?php include("inc/footer.php")?>