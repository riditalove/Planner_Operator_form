<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "sweater";
  
  $con = mysqli_connect($hostname,$username,$password,$database);
  if($con)
  {
    
  }
  else
  {
    die(mysqli_error(($con)));
  }
?>