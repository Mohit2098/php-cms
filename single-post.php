<?php
require ('connection.php');
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Single Post</title>
</head>
<body>
<nav class='navbar navbar-dark bg-dark'>
          <!-- Navbar content -->
          <ul>
            <li ><a href="post-create.php">Create New Post </a></li>
            <li ><a href="posts-list.php">Show Recent Post </a></li>
          </ul>
<?php if(isset($_COOKIE['remember']) || $_SESSION['logged-in'])
{
    echo "
    <div class='container mt-4' style= 'justify-content: end; display: contents;'>
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
                }  ?>
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
<?php
$post_id= $_GET['id'];


$sql="SELECT * FROM users INNER JOIN  users_posts  ON post_id = '$post_id' And users.id =  ".$_SESSION['id'];

$result=mysqli_query($conn,$sql);


while($row = mysqli_fetch_assoc($result)):
  // print_r($row);

  $file = fopen("contents/".$row['post_title'].".txt","r");
  $value=fread($file,filesize("contents/".$row['post_title'].".txt"));
  
?>

 
<div class="container">
<h1 class="text-center mt-4 mb-4"><?php echo $row['post_title'];?></h1>
        <div class="row">
            <div class="col-md-6">
            <img class="card-img-top"  src="<?php echo $row['post_image']?>">
            </div>
      <div class="col-md-6">
<p><?php echo $value;?></p>
<a href="<?php echo $row['id']?>" class="btn btn-primary  justify-content-center d-flex"> <?php echo "Post By : ".$row['username']?></a>

    </div>
  </div>

</div> 
<?php fclose($file);?>
<?php endwhile; ?>

</body>
</html>