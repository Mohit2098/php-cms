<?php 
require('connection.php');
 session_start();

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" type="text/css" rel="stylesheet" >
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" >
    <title>Document</title>
</head>
<body>
<nav class='navbar navbar-dark bg-dark'>
          <!-- Navbar content -->
          <ul>
            <li ><a href="post-create.php">Create New Post </a></li>
          </ul>
<?php if(isset($_COOKIE['remember']) || $_SESSION['logged-in'])
{
echo "
    <div class='container mt-4' style= 'justify-content: end;
    display: contents; '>
    <div class='row welcome-row'>
      <div class='col-md-4 justify-content-end d-flex w-100'>
        <div class='alert alert-success' style='width:fit-content'>
         Welcome" 
               
               ?>

               <?php  if($_SESSION){
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


<div class="contianer justify-content-center d-flex">
    <div class="row">
      <h4 class="text-center mt-4 mb-4">All Posts Created By <?php echo $_SESSION['username']?></h4>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Post Title</th>
      <th scope="col">Post Content</th>
      <th scope="col">Post Image</th>
      <th scope="col">View</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
    <?php 

$sql=" SELECT * From users INNER JOIN users_posts ON users_posts.user_id = users.id AND users.id = " .$_SESSION['id'];
  
$result=mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)):
 
  $file = fopen("contents/".$row['post_title'].".txt","r");
  $value=fread($file,filesize("contents/".$row['post_title'].".txt"));


    ?>

  <tbody>
    <div class="container">
    <tr>
      <th scope="row"><?php echo $row['post_id']?></th>
      <td><?php echo $row['post_title'];?></td>
  
 <td style="
word-break: break-all;
    width: 500px;
"><?php echo $value."<br>";?></td> 

      <td><img src="<?php echo $row['post_image'];?>" style= "height:100px; width:100px;"></td>
      <td> <a href= "single-post.php?id=<?php echo $row['post_id'];?>" class="btn btn-info"> View</a></td>
      <td><a href ="edit.php?post_id=<?php echo $row['post_id'];?>" class="btn btn-success"> Edit</a></td>
      <td><a href="delete.php?post_id=<?php echo $row['post_id']?>"><button class ="btn btn-danger">DELETE</button></a></td>
    
</tr>
</div>
  </tbody>

  <?php fclose($file);?>
   <?php endwhile;?>
</table>

</div>
</div>

</body>
</html>