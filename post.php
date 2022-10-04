<?php include "header.php"; 
session_start();
if(!isset($_SESSION['username'])){
    header("Location:{$hostname}/index.php");
  } ?>
<div id="nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="post.php" class ="active" >Home</a></li>
                        <li><a href="add-post.php">Add Post</a></li>
                        <li><a href="delete-post.php">Delete Post</a></li>
                        <li><a href="profile.php">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="post">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8 offset-md-2">
                <?php 
                include "config.php";
                $limit = 5;
                
                if(isset($_GET['page'])){
                  $page = $_GET['page'];
                }else{
                  $page=1;
                }
                $offset = ($page - 1) * $limit;
                
                    $sql = "SELECT * FROM post 
                LEFT JOIN user ON post.user = user.user_id 
                ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                  
                $result = mysqli_query($conn,$sql) or die ("Query Failed.");
                if(mysqli_num_rows($result) >0){
                     while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="row icon">
                    <div class="col-1 ">
                        <img src="images/<?php echo $row['user_img']; ?>"  alt=""/>
                    </div>
                    <div class="col-11 ">
                        <div class="name">
                    <b><?php echo $row['firstname']; ?><?php echo " "; ?><?php echo $row['lastname']; ?></b><br />
                    <?php echo $row['date']; ?>
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
                        echo "<h2>No record found.</h2>";
                    }
                       
                       
                        ?>
                </div>
                <!--  -->
                </div>
            </div>
        </div>

<?php include "footer.php"; ?>
