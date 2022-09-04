<?php 
require('connection.php');
session_start();


 if(isset($_POST["login"])){

  
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $sql="SELECT * FROM users WHERE email = '$email'";
  
  $result=mysqli_query($conn,$sql);
  
  if($result){

  if(mysqli_num_rows($result)==1)
  {
  $result_fetch=mysqli_fetch_assoc($result);
  // echo($result_fetch['username']);

  // print_r($result_fetch['id']); die;
  if($password == $result_fetch['password']){

    if(!empty($_POST["rememberMe"])){
      // echo ($_POST["rememberMe"]);die;
      setcookie('remember','remember',time()+60*60*7);
    }

    setcookie('username',$result_fetch['username'],time()+60*60*7);
    $_SESSION["logged-in"]=true;
    $_SESSION['username']=$result_fetch['username']; 
    $_SESSION['id']=$result_fetch['id'];  
    header("location: index.php");
    
  } 

   else{ 
   
     echo "<script>alert('Incorrect Password');</script>";
     
  } 
  }  
  else{
    echo "<script>alert('Email Not Registered');</script>";
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
<link href="style.css" type="text/css" rel="stylesheet" >
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <title>Login</title>
</head>
<body>
<div class ="login-container">
    <div class ="row login-row">
        <div class="col-md-4 login-col">
 <h1 class="text-center"> Login</h1>
    <form action ="login.php" method="POST">
      
      <!-- Name input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="registerName">Email</label>
        <input type="text" name="email" class="form-control" />
     
      </div>

      <!-- Username input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="registerUsername">Password</label>
        <input type="password"  name="password" class="form-control" />
       
      </div>
      <input type="checkbox" value="rememberMe" name="rememberMe" > <label for="rememberMe">Remember me</label>
  <button type="submit" class="btn btn-primary log-submit-btn btn-block mb-4" name="login" >Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="register.php">Register</a></p>
   
  </div>
</form>
</div>  
</div>
</div>
</body>
</html>