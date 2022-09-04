<?php
require('connection.php');
session_start();
?>
<?php

$post_id="";
$post_title="";
$post_content="";
$post_image="";

if(isset($_GET['post_id'])){
$post_id=$_GET['post_id'];

$sql = "SELECT * FROM users_posts WHERE post_id = '$post_id'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
 
  while($row = mysqli_fetch_assoc($result)){

    $post_id = $row['post_id'];
 
    $post_title = $row['post_title'];
  
    $post_content = $row['post_content'];
  
    $post_image = $row['post_image'];


    $file = fopen("contents/".$row['post_title'].".txt","r");
    $value= fread($file,filesize("contents/".$row['post_title'].".txt"));


  }


}




}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Edit Posts</title>
</head>
<body>
    <div class ="posts-container">
   
        <div class ="row posts-row">
        <nav class='navbar navbar-dark bg-dark'>
          <!-- Navbar content -->
          <ul>
            <li ><a href='posts-list.php'>Posts Lists</a></li>
          </ul>
        <?php if(isset($_COOKIE['remember']) || $_SESSION['logged-in'])
{
    echo "
          <div class='container mt-4' style= 'justify-content: end;
          display: contents;'>
       
           <div class='row welcome-row'>
             <div class='col-md-4 welcome-col'>
               <div class='alert alert-success' style='width:fit-content'>
                Welcome  "  
               
               ?>

               <?php if($_SESSION){
                echo $_SESSION['username'];
               }
                else{
                  echo $_COOKIE['username']; 
                } 
                ?>
     <?php
            echo "<a href ='logout.php' class='btn btn-danger'>logout</a>";

        }
        else{
          header("location: login.php");
        }
        ?>
                </div>         
               </div>
             
               </div>
        
               </div>
               </nav>
             
            <div class="col-md-4 register-col">
              <h1 class="text-center mb-2">  Edit Create Post</h1>
           
        <form action ="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>">
          <!-- Name input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="post-title ">Post Title </label>
            <input type="text" name="post_title" value= "<?php echo $post_title;?>"class="form-control" />
         
          </div>
    
          <!-- Username input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="post-content">Post Content </label>

          <textarea class="form-control" type="text" name="post_content" value= "" id="exampleFormControlTextarea1" rows="3"><?php echo $value;?></textarea>
            
        </div>
       
          <!-- Email input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="post-image">Post Image</label>
          <img src ="<?php echo $post_image;?>" height="30px" width="30px">
            <input type="file" name="post_image" class="form-control" />
            
          </div>
     
          <!-- Submit button -->
          <button type="submit" class="btn btn-success create-btn btn-block mb-3" name="update" value ="submit">Update Post</button>
          <div class="text-center">
      
       
      </div>
        </form>
    </div>
    </div>
      </div>
</body>
</html>