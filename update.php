<?php

require('connection.php');

?>


<?php 
if(isset($_POST['update'])){
   
   $post_id = $_POST['post_id'];
 
   $post_title = $_POST['post_title'];

   $post_content = $_POST['post_content'];

   $post_image = $_FILES['post_image'];

   $filename =$post_image['name'];
   $fileerror = $post_image['error'];
   $filetmp = $post_image['tmp_name'];

   $fileext= explode('.', $filename);
   $filecheck =strtolower(end($fileext)); 
   $fileextstored = array('png','jpg','jpeg');
  
   
  

   if(in_array($filecheck,$fileextstored)){
   
    $filepath ='images/'.$filename;
    move_uploaded_file($filetmp,$filepath);

  
    $f = fopen("contents/$post_title".".txt","w");
    
    fwrite($f,$_POST['post_content']);
    fclose($f);
    
    $contentpath = " contents/$post_title.txt";




   $sql = " UPDATE  users_posts SET post_title = '$post_title', post_content='$contentpath', post_image= '$filepath' where post_id = '$post_id'";

   $result = mysqli_query($conn,$sql);

   if($result == true){
 
    echo "update";
   }
   else{

    echo "something went wrong" .$sql ."<br>" .mysqli_error($conn);
 
    }
 
   }
   else{

   echo "something went wrong" .$sql ."<br>" .mysqli_error($conn);

   }


}



?>