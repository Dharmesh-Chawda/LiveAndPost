<?php 
    include("./inc/header.php");
    include("./config/db.php");
    session_start();
    $title = "";
    $description = "";
    if(isset($_FILES["featuredImage"]) && isset($_POST['post'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        if($title !="" && $description!="" && $category!="" && $_FILES['featuredImage']['size']>0){
            $uploadok = 1;
            $file_name = $_FILES['featuredImage']['name'];
            $file_size = $_FILES['featuredImage']['size'];
            $file_tmp = $_FILES['featuredImage']['tmp_name'];
            $file_type = $_FILES['featuredImage']['type'];
            $target_dir = "assets/featuredImages";
            $target_file = $target_dir.basename($file_name);
            $check = true; 
            $tmp = $file_ext = "";
            if(empty($file_tmp)){
                $error = "Please select an image";
            }else{
                $check = getimageSize($file_tmp);
                $tmp = explode('.',$file_name);
                $file_ext = strtolower(end($tmp));
            }
            if(file_exists($target_file)===true){
                $error = "Sorry file already exists!";
            }
            if($check == false){
                $error = "File is not an image!";
            }
            if(empty($error)==true){
                move_uploaded_file($file_tmp,"assets/featuredImages/".$file_name);
                $url = $_SERVER['HTTP_REFERER'];
                $seg = explode('/',$url);
                $path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
                $full_url = $path.'/'.'assets/featuredImages/'.$file_name;
                $sql = "INSERT INTO posts(title,description,category,featured_image) VALUES ('$title','$description','$category','$full_url')";
                $query = $conn -> query($sql);
                if($query){
                    header('Location:dashboard.php');
                }else{
                    $error= "Failed to Upload Image!";
                }
            }
        }else{
            $error = "Please fill all the details";
        }
    }
?>
<?php if(!isset($_SESSION['username'])): ?>
        <?php header('Location:dashboard.php')?>
<?php else: ?>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <fieldset>
                <legend>Add Post</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="col-lg-3 col-form-label">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="title" class="form-control" placeholder="Title" value =<?php echo $title?>>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description" class="col-lg-3 col-form-label">Description</label>
                            <div class="col-lg-9">
                                <textarea name="description" rows="5" cols="10" class="form-control" placeholder="Description" value=<?php echo $description?>>
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category" class="col-lg-3 col-form-label">Category</label>
                            <div class="col-lg-9">
                                <select name="category" class="form-control">
                                    <option>Select</option>
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
                        <div class="form-group">
                            <label for="featuredImage" class="col-lg-3 col-form-label">Featured Image</label>
                            <div class="col-lg-9">
                                <input type="file" name="featuredImage" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-lg-3">
                                <input type="submit" name="post" value="Add Post" class="btn btn-primary">
                                <button type="reset" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="form-group">
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