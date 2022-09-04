<?php
require('connection.php');
session_start();
$errors = array();
if(isset($_POST['create'])){

    
    $post_title = $_POST['post_title'];
    // print_r($_POST['post_content']);
    $post_content = $_POST['post_content'];
    $post_image = $_FILES['post_image'];
    $filename =$post_image['name'];
    $loggedInUser_id=$_SESSION['id'];
    // print_r($filename);
    $fileerror = $post_image['error'];
    $filetmp = $post_image['tmp_name'];
    
    // file read write in php


$f = fopen("contents/$post_title".".txt","a");
    
fwrite($f,$_POST['post_content']);
fclose($f);

$contentpath =" contents/$post_title.txt";



// end file 

    // image file 
    $fileext= explode('.', $filename);
    $filecheck =strtolower(end($fileext)); 
    $fileextstored = array('png','jpg','jpeg');
  
if(count($errors)==0)
{
     if(empty($post_title)){
     
      $errors['post_title']= "tile required";
      

     }
     if(empty($post_content)){
     
      $errors['post_content']= "post content required";
      

    }
    if(empty($filename)){
     
      $errors['post_image']= "post image required";
      
    }
        
  }
    if(in_array($filecheck,$fileextstored)){
   
      $filepath ='images/'.$filename;
      move_uploaded_file($filetmp,$filepath);
  
  
      $sql = "INSERT INTO users_posts(post_title,post_content,post_image,user_id) VALUES('$post_title','$contentpath','$filepath','$loggedInUser_id')";
      $result = mysqli_query($conn, $sql);
    
     
      if($result){
 
        echo "<script>alert('data-inserted')</script>";
         }
    
         else{
          echo mysqli_error($conn);
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
    <title>Create Post</title>
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
              <h1 class="text-center mb-2"> Create Post</h1>
              <?php if(count($errors) > 0):?>
                <div class="alert alert-danger">
                <?php foreach($errors as $error):?>
                  <li><?php echo $error;?></li>
        
              <?php endforeach;?>
              </div>
          <?php endif;?>
        <form action ="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">
          <!-- Name input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="post-title ">Post Title </label>
            <input type="text" name="post_title"class="form-control" />
         
          </div>
    
          <!-- Username input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="post-content">Post Content </label>
          <textarea class="form-control" name="post_content" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
    
          <!-- Email input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="post-image">Post Image</label>
            <input type="file" name="post_image" value="upload" class="form-control" />
            
          </div>
     
          <!-- Submit button -->
          <button type="submit" class="btn btn-success create-btn btn-block mb-3" name="create" value ="submit">Create Post</button>
          <div class="text-center">
      
       
      </div>
        </form>
    </div>
    </div>
      </div>
</body>
</html>