<?php
require ('connection.php');

session_start();
session_destroy();
setcookie('remember', "", time() - 1); 
setcookie('username', "", time() - 1); 
header("location: index.php");

?>