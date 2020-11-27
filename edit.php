<?php 
    session_start();
?>

<?php if(!isset($_SESSION['username'])): ?>
        <?php header('Location:dashboard.php')?>
<?php else: ?>
<?php include("inc/header.php");?>
<?php include("config/db.php")?>
    <?php 
        $id = $_GET['id'];
        $posts_query = "SELECT * FROM posts WHERE id='$id'";
        $posts_result = mysqli_query($conn,$posts_query) or die("error");
        if(mysqli_num_rows($posts_result)>0){
            while($post = mysqli_fetch_assoc($posts_result)){
                $id = $post['id'];
                $title = $post['title'];
                $description = $post['description'];
                $category = $post['category'];
                $featured_image = $post['featured_image'];
                
            }
        }
    ?>
    <div class="container">
        <form action="update.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="id" value=<?php echo $id?>>
        <input type="hidden" name="featured_image" value=<?php echo $featured_image?>>
        <fieldset>
                <legend class="ed-head">Edit Post</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="title" class="col-lg-3 col-form-label">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="title" value=<?php echo $title;?> class="form-control" placeholder="Title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="description" class="col-lg-3 col-form-label">Description</label>
                            <div class="col-lg-9">
                                <textarea name="description" rows="5" cols="10" class="form-control" 
                                placeholder="Description"><?php echo $description;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="category" class="col-lg-3 col-form-label">Category</label>
                            <div class="col-lg-9">
                                <select name="category" class="form-control" >
                                    <option value=<?php echo $category; ?>><?php echo $category; ?></option>
                                    <option value="Enterntainment">Enterntainment</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Politics">Politics</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="featuredImage" class="col-lg-3 col-form-label">Featured Image</label>
                            <div class="col-lg-9">
                                <input type="file" name="featuredImage" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="row">
                                <input type="submit" name="post" value="Update Post" class="btn btn-primary">
                                <a href="dashboard.php" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="form-group row">
                    <div class="col-lg-60">
                        <?php if (isset($_POST['post'])) : ?>
                            <div class="alert alert-dismissible alert-warning">
                                <p>
                                    <?php echo $error; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div> 
            </fieldset>
        </form>
    </div>
<?php endif;?>

<?php include("inc/footer.php");?>