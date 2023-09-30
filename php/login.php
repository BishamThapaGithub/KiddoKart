<?php
include_once('connection.php');
session_start();

 if(isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password  = mysqli_real_escape_string($conn, $_POST['password']);



  $select = "SELECT * FROM users WHERE Email = '$email' AND Password = '$password'";
  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    
    $row = mysqli_fetch_array($result);
    if ($row['UserRole'] == "Admin") {
      $_SESSION['username'] = $row['Username'];
 
      header('Location: admindb.php');
      exit();
    } else if($row['UserRole'] == "user") {
      
      include("../test2.php");
      
      
      $_SESSION['username'] = $row['Username'];
      $_SESSION['ID'] = $row['ID'];
      echo $row['UserRole'];
      
      echo "<script> window.location.href= '../homepage.php';</script>";
      exit();
      
     
    }
  } else {
    echo "Invalid email or password";
  }
}

?>
