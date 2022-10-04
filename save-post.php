<?php
include "config.php";
if(isset($_FILES['fileToUpload'])){
    $error = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = end(explode('.',$file_name));
    $extension = array("jpeg","jpg","png");

    if(in_array($file_ext,$extension) === false){
        $error[] = "This extension file are not allowed, Please choose a JPG or PNG file.";
    }
    if($file_size > 15097152){
        $error[] = "File size must be 2mb or lower.";
    }
    if(empty($error)== true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        print_r($error);
        die();
    }
}
session_start();
$description = mysqli_real_escape_string($conn,$_POST['postdesc']);
$date = date("d,M,Y");
$user = $_SESSION['user_id'];

$sql = "INSERT INTO post(description,date,user,post_img) 
        VALUES('{$description}','{$date}',{$user},'{$file_name}')";
if(mysqli_query($conn,$sql)){
    header("Location:{$hostname}/post.php");
}else{
    echo "<div class='alert alert danger'>Query Failed.</div>";
}

?>