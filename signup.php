<?php include "header.php"; 

if(isset($_POST['save'])){
    include "config.php";
 
    $fname =mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $user = mysqli_real_escape_string($conn,$_POST['user']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password']));
 
    $sql = "SELECT username FROM user WHERE username = '{$user}'";
    $result = mysqli_query($conn, $sql) or die("Query failed.");
 
    if(mysqli_num_rows($result) >0){
     echo "<p style='color:red;text-align:center;margin: 10px 0;'>Username Already Exists</p>";
    }else{
     $sql1 = "INSERT INTO user (firstname,lastname,username,password)
             VALUES ('{$fname}','{$lname}','{$user}','{$password}')";
         if(mysqli_query($conn,$sql1)){
            $sql2 = "SELECT user_id,firstname,lastname,username,user_img FROM user WHERE username = '{$user}' AND password ='{$password}'";
            $result1 = mysqli_query($conn,$sql2) or die("Query Failed.");
           
            if(mysqli_num_rows($result1) > 0){
           
                while($row =mysqli_fetch_assoc($result1)){
                    session_start();
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["user_id"] = $row['user_id'];
                    $_SESSION["firstname"] = $row['firstname'];
                    $_SESSION["lastname"] = $row['lastname'];
                    $_SESSION["user_img"] = $row['user_img'];
                    header("Location:{$hostname}/post.php");
                }
            }
         }
 }
 
 }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12 center">
                  <h1 class="admin-heading">Create New Account</h1>
              </div>
              <div class="col-md-6 offset-md-3">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <!-- <div class="form-group">
                          <label for="exampleInputPassword1">Choose Profile Photo</label>
                          <input type="file" name="fileToUpload" required>
                      </div> -->
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
