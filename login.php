<?php include "header.php"; 
include "config.php";
session_start();
if(isset($_SESSION["username"])){
    header("Location:{$hostname}/post.php");
}
?>
<div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                <div class="col-md-12 center">
                  <h1 class="admin-heading">Login</h1>
              </div>
                    <div class="col-md-4 offset-md-4">
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        <?php 
                        if(isset($_POST['login'])){
                            include "config.php";
                            $username = mysqli_real_escape_string($conn,$_POST['username']);
                            $password = md5($_POST['password']);

                            $sql = "SELECT user_id,firstname,lastname,username,user_img FROM user WHERE username = '{$username}' AND password ='{$password}'";
                            $result = mysqli_query($conn,$sql) or die("Query Failed.");

                            if(mysqli_num_rows($result) > 0){

                                while($row =mysqli_fetch_assoc($result)){
                                    session_start();
                                    $_SESSION["username"] = $row['username'];
                                    $_SESSION["user_id"] = $row['user_id'];
                                    $_SESSION["firstname"] = $row['firstname'];
                                    $_SESSION["lastname"] = $row['lastname'];
                                    $_SESSION["user_img"] = $row['user_img'];
                                    header("Location:{$hostname}/post.php");
                                }
                            }else{
                                echo '<div class="alert alert-danger">Username and Password are not match.</div>';
                            }
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>

<?php include "footer.php"; ?>
