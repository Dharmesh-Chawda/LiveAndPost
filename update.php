<?php 
    include("./config/db.php");
    session_start();
    if(isset($_FILES['featuredImage'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $post_id = $_POST['id'];
        $upload_featured_image = $_POST['featured_image'];
        if($title !="" && $description!="" && $category!=""){
            $uploadok = 1;
            $file_name = $_FILES['featuredImage']['name'];
            $file_size = $_FILES['featuredImage']['size'];
            $file_tmp = $_FILES['featuredImage']['tmp_name'];
            $file_type = $_FILES['featuredImage']['type'];
            $target_dir = "assets/featuredImages";
            $target_file = $target_dir.basename($file_name);
            if(empty($file_tmp)){
                header('Location:dashboard.php');
                $sql = "UPDATE posts SET title='$title',description='$description',category='$category'
                    WHERE id='$post_id'";
                $query = $conn -> query($sql);
                if($query){
                    header('Location:dashboard.php');
                    exit();
                }else{
                    echo $conn-> error;
                    $error= "Failed to Upload Image!";
                }
                exit();
            }
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
                move_uploaded_file($file_tmp,"assets/featuredImages/".$file_name);
                $url = $_SERVER['HTTP_REFERER'];
                $seg = explode('/',$url);
                $path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];

                $image_path = explode('/',$upload_featured_image);
                $image = $image_path[6];

                $full_url = $path.'/'.'assets/featuredImages/'.$file_name;
                $id = $_SESSION['id'];
                $sql = "UPDATE posts SET title='$title',description='$description',category='$category',featured_image='$full_url'
                    WHERE id='$post_id'";
                unlink("assets/featuredImages/".$image);
                $query = $conn -> query($sql);
                if($query){
                    header('Location:dashboard.php');
                }else{
                    echo $conn-> error;
                    $error= "Failed to Upload Image!";
                }
            }
        }else{
            $error = "Please fill all the details";
        }
    }
    echo $error;
?>