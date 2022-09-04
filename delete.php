<?php require('connection.php');

?>
<?php 
session_start();
if(isset($_GET['post_id'])){

    $post_id=$_GET['post_id'];

  $sql = "DELETE FROM users_posts WHERE post_id = '$post_id'";

$result= mysqli_query($conn,$sql);
$_SESSION['message']="Record has been deleted";
$_SESSION['msg_type']="danger";   
   
header("location: posts-list.php");

}







?>