<?php 
    include("./inc/header.php");
    include("./config/db.php");
    session_start();
    if(isset($_POST['profile'])){
        $profession = $_POST['profession'];
        if($profession != "" && isset($_FILES['avatar'])){
            $uploadok = 1;
            $file_name = $_FILES['avatar']['name'];
            $file_size = $_FILES['avatar']['size'];
            $file_tmp = $_FILES['avatar']['tmp_name'];
            $file_type = $_FILES['avatar']['type'];
            $target_dir = "assets/uploads";
            $target_file = $target_dir.basename($file_name);
            $check = getimageSize($file_tmp);
            $tmp = explode('.',$file_name);
            $file_ext = strtolower(end($tmp));

            $extensions = array('jpeg','jpg','png');
            if(in_array($file_ext,$extensions)==false){
                $error = "Please choose the image which has the extension as jpeg,jpg or png";
            }
            if(file_exists($target_file)===true){
                $error = "Sorry file already exists!";
            }
            if($check == false){
                $error = "File is not an image!";
            }
            if(empty($error)==true){
                move_uploaded_file($file_tmp,"assets/uploads/".$file_name);
                $url = $_SERVER['HTTP_REFERER'];
                $seg = explode('/',$url);
                $path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
                $full_url = $path.'/'.'assets/uploads/'.$file_name;
                $id = $_SESSION['id'];
                $user_role = $_SESSION['user_role'];
                $sql = "INSERT INTO profile(profession,avatar,user_id,user_role) VALUES ('$profession','$full_url','$id','$user_role')";
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
                <legend>Add Profile</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profession" class="col-lg-2 col-form-label">Profession</label>
                            <div class="col-lg-10">
                                <input type="text" name="profession" class="form-control" placeholder="Profession">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="avatar" class="col-lg-2 col-form-label">Avatar</label>
                            <div class="col-lg-10">
                                <input type="file" name="avatar" class="form-control" placeholder="Avatar">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-lg-10">
                                <input type="submit" name="profile" value="Submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="form-group">
                    <div class="col-lg-60">
                        <?php if (isset($_POST['profile'])) : ?>
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