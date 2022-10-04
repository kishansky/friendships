<?php include "header.php"; 
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header("Location:{$hostname}/index.php");
  } ?>
<div id="nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="post.php" >Home</a></li>
                        <li><a href="add-post.php">Add Post</a></li>
                        <li><a href="delete-post.php">Delete Post</a></li>
                        <li><a href="profile.php"class ="active" >Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="profile">
             <img src="./images/default.jpg" >
                <h3><?php echo $_SESSION['firstname']; echo " ";?><?php echo $_SESSION['lastname']; ?></h3>
                <h4><?php echo $_SESSION['username']; ?></h4>
                <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-6 offset-3">
            <?php 
                $limit = 5;

                if(isset($_GET['page'])){
                  $page = $_GET['page'];
                }else{
                  $page=1;
                }
                $offset = ($page - 1) * $limit;
                
                    $sql = "SELECT * FROM post 
                LEFT JOIN user ON post.user = user.user_id 
                WHERE post.user = {$_SESSION['user_id']}
                ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                  
                $result = mysqli_query($conn,$sql) or die ("Query Failed.");
                if(mysqli_num_rows($result) >0){
                     while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="row icon">
                    <div class="col-1 ">
                        <img src="images/<?php echo $row['user_img']; ?>"  alt=""/>
                    </div>
                    <div class="col-9 ">
                        <div class="name">
                    <b><?php echo $row['firstname']; ?><?php echo " "; ?><?php echo $row['lastname']; ?></b><br />
                    <?php echo $row['date']; ?>
                     </div>
                    </div>
                    <div class="col-2 ">
                        <div class="delete">
                       <a href="delete.php?id=<?php echo $row["post_id"]; ?>" class="btn btn-dark">Delete</a>
                     </div>
                    </div>
                </div>
                <div class="responsive">
                    <div class="gallery"> 
                        <p class="desc">
                            <?php echo substr($row['description'],0,100)."..."; ?>
                        </p>
                        <img src="upload/<?php echo $row['post_img']; ?>" alt=""/>
                    </div>
                </div>
                   <?php 
                     }
                    }else{
                        echo "<h2>No Post Yet.</h2>";
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
