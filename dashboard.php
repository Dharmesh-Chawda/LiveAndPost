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
        </div>
    </div>
<?php include("./inc/footer.php") ?>


