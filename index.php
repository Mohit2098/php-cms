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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <title>Welcome Page</title>
</head>
<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12">

<?php if(isset($_COOKIE['remember']) || $_SESSION['logged-in'])
{
    echo "
          <div class='container mt-4'>
           <div class='row welcome-row'>
             <div class='col-md-4 welcome-col'>
               <div class='alert alert-success' style='width:fit-content'>
                Welcome" 
               
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
<div class="contianer">
    <div class="row add-new-post">
        <div class="col-md-4">
        <a href="post-create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Post</a>
    </div>

</div>
            

</body>
</html>