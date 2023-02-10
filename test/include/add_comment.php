<?php
print_r($_POST);
require('db.php');
$fullname = $_SESSION['USER_F_NAME']." ".$_SESSION['USER_NAME'];
if(isset($_POST['addcomment'])){
$name=$fullname;
$comment=mysqli_real_escape_string($db,$_POST['comment']);
$post_id=mysqli_real_escape_string($db,$_POST['post_id']);
$query="INSERT INTO comments(comment,name,post_id) VALUES('$comment','$name',$post_id)";
if(mysqli_query($db,$query)){
    header("location:../post.php?id=$post_id");
}else{
    echo"comment is not added.";
}
}
?>