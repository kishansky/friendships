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
                        <li><a href="post.php" >Home</a></li>
                        <li><a href="add-post.php" class ="active">Add Post</a></li>
                        <li><a href="delete-post.php">Delete Post</a></li>
                        <li><a href="profile.php">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12 center">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-6 offset-md-3">
                  <!-- Form -->
                  <form  action="save-post.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="exampleInputPassword1">What about..</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">      
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Post" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
