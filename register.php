<?php require('connection.php');


?>

<?php 

$errors = array();

// validation

if(isset($_POST["submit"]))
{

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!$name) {
  $errors['name']="Name Required";
}
if (!$username)
{
  $errors['username']="Username Required";
}
if (!$email) {
  $errors['email']="Email Required";
}
  
if (!$password){
    $errors['password']="Password Required";
  }
if(count($errors)==0)
{
  
  $checkUser = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
  // echo $checkUser;
  if($result = mysqli_query($conn, $checkUser)){
    if(mysqli_num_rows($result) > 0){
     $result_fetch=mysqli_fetch_assoc($result);
     if($result_fetch['username']==$_POST['username'])
     {

     echo "<script>alert('$result_fetch[username] - Username already taken');
    
     </script>";

     }
     else{

      echo "<script>alert('$result_fetch[email] - Email already taken');
      </script>";

     }
  
    
		}
    else{
      $enc_password= md5($password);
      $sql = "INSERT INTO users(name,username,email,password) VALUES('$name','$username','$email','$enc_password')";
      
      if(mysqli_query($conn, $sql)){
       

        // echo " <script> alert('Data inserted') </script> ";
       
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      }
      else{
        
        echo "Something Went Wrong:" . $sql . " " .mysqli_error($conn) ;
        
      }
    }
  }
  else{
    echo mysqli_error($conn);
  }
  
}
  mysqli_close($conn);
}
?>

<html>
  <head>
<link href="style.css" type="text/css" rel="stylesheet" >
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" >
<title>Register</title>
</head>
<body>
 <div class ="register-container">
    <div class ="row register-row">
        <div class="col-md-4 register-col">
          <h1 class="text-center mb-2"> Register</h1>
          
       <?php if(count($errors) > 0):?>
          <div class="alert alert-danger"> 
            <?php foreach($errors as $error):?>
         <li><?php echo $error;?></li>
         <?php endforeach;?>
        </div>
       <?php endif;?>
    <form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      
      <!-- Name input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="registerName">Name</label>
        <input type="text" name="name"   class="form-control" />
     
      </div>

      <!-- Username input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="registerUsername">Username</label>
        <input type="text"  name="username" class="form-control" />
       
      </div>

      <!-- Email input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="registerEmail">Email</label>
        <input type="email" name="email"  class="form-control" />
        
      </div>

      <!-- Password input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="registerPassword">Password</label>
        <input type="password"  name="password"  class="form-control" />
      
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary reg-submit-btn btn-block mb-3" name="submit" value ="submit">Sign up</button>
      <div class="text-center">
    <p>Already have a account ? <a href="login.php">Login</a></p>
   
  </div>
    </form>
</div>
</div>
  </div>
<!-- Pills content -->  
</body>
</html> 
