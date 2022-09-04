<?php 

$conn =mysqli_connect('localhost','root','root','phpcms');
if($conn->connect_error)
{
    echo "Failed to connect" .mysqli_error();
}
// else{

//     echo "working";
// }
?>