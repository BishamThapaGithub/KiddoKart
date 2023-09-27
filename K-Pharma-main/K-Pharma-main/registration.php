<!DOCTYPE html>

<?php
// Check if the form is submitted
include_once('./php/connection.php');
session_start();
if (isset($_POST['submit'])) {
    // Collect information from the registration form
    $fullname = mysqli_real_escape_string($conn, $_POST['Username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['Re-Enterpassword']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $user_role = 'user';

    // Validate that all fields are filled
    if (empty($fullname) || empty($email) || empty($password) || empty($cpassword) || empty($age)) {
        echo "Please fill in all fields";
    } else {
        // Check if the passwords match
        if ($password !== $cpassword) {
            echo "Passwords do not match";
        } else {
            // Insert data into the database
            $sql = "INSERT INTO users (Username, Email, Password, Age, UserRole) VALUES ('$fullname', '$email', '$password', '$age', '$user_role')";
            $query = $conn->query($sql);

            if (!$query) {
                echo "Data insertion failed: " . mysqli_error($conn);
            } else {
                echo "<script> alert('Registration sucessfull '); </script>";
                // Redirect to the login page
                $_SESSION['success_message'] = "Registration successfull!";
                echo '<script>setTimeout(function(){ window.location.href = "signin.html"; }, 2000);</script>';
               
               exit();
            }
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
    <link rel="stylesheet" href="./css/popup.css">
    <style>
      /* Style for the success message */
      .success-message {
         color: green;
         background-color: #e2f1dd;
         padding: 10px;
         border-radius: 5px;
         margin-bottom: 20px;
         text-align: center;
      }

      .error-message {
         color: green;
         background-color: #e2f1dd;
         padding: 10px;
         border-radius: 5px;
         margin-bottom: 20px;
         text-align: center;
      }
   </style>
</head>
<body><div class="login-card-container">
    <div class="login-card">
    <?php
               if (isset($_SESSION['success_message'])) {
                  echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
                  // Clear the success message after displaying it
                  unset($_SESSION['success_message']);
               }
               ?>
        <div class="login-card-logo">
            <img src="./image/logo.jpg " alt="logo">
        </div>
        <div class="login-card-header">
            <h1>Register Here</h1>
            
        </div>
        <form class="register" action="" method="post" onsubmit="return validation()">
            <label> Username:</label>
        <br>
        <input type="text" name="Username" id="user" class="form-control"
        placeholder="Enter your Username" autocomplete="off">
        <br>
        <span id="username" style="color: red;"></span>
        <br>
        <label>Email: </label> 
        <br>
        <input type="email" name="email" id="emails" class="form-control"
        placeholder="Enter your email"  autocomplete="off">    <br>
        <span id="emailids" style="color: red;"></span><br>
        <label>Password: </label> 
        <br>
        <input type="password" name="password" id="pass" class="form-control"
        placeholder="Enter Password" autocomplete="off">    <br>
        <span id="passwords" style="color: red;"></span><br>
        <label>Confirm Password: </label> 
        <br>
        <input type="password" name="Re-Enterpassword" id="conpass" class="form-control"
        placeholder="Re-Enterpassword"autocomplete="off" >    <br>
        <span id="confirmpass" style="color: red;"></span><br>
        <label>Mobile Number: </label>
        <br>
        <input type="tel" name="Mobile-number" id="MobNo" class="form-control" required
         pattern="98[0-9]{8}" title="Mobile number should start with 98 and be 10 digits in total"
         placeholder="XXXXXXXXXX" autocomplete="off">
        <br>
        <span id="MobNo" style="color: red;"></span><br>
        
        
        
        <label>Age</label><br>
        <input type="number" name="age" id="name"
        placeholder="enter your age?">
        <br><br>
       
      
            
                 <button type="submit" name="submit" value="submit">Register</button>
                 <div class="login-card-footer">
                    already have an account? <a href="signin.html">Login Here</a>
                </div>
               
                    
                </div>
        </form>
        
        <script>
            function validation(){
                var user= document.getElementById('user').value;
                var emails= document.getElementById('emails').value;
                var pass= document.getElementById('pass').value;
                var confirmpass= document.getElementById('conpass').value;
                


                if(user == ""){
                    document.getElementById('username').innerHTML = "*Please fill the Username*";
                    return false;

                }
                if((user.length<=3) || (user.length>25)){
                    document.getElementById('username').innerHTML = "*Username must consist 3-25 characters*";
                    return false;

                }
                if(!isNaN(user)){
                    document.getElementById('username').innerHTML ="*Only characters are allowed*"

                }
                if(emails == ""){
                    document.getElementById('emailids').innerHTML = "*Please fill the Email*";
                    return false;

                }
                if(emails.indexOf('@')<=0){
                    document.getElementById('emailids').innerHTML="*@ in invalid position*";
                    return false;
                }

                if((emails.charAt(emails.length-4)!='.') && (emails.charAt(emails.length-3)!='.')){
                    document.getElementById('emailids').innerHTML=". at invalid position";
                    return false;
                }
                if(pass == ""){
                    document.getElementById('passwords').innerHTML = "*Please fill the Password*";
                    return false;

                }
                if((pass.length<=8) || (pass.length>25)){
                    document.getElementById('passwords').innerHTML = "*Password must be between 8-25 length*";
                    return false;}

                    if(pass!=confirmpass){
                        document.getElementById('passwords').innerHTML="Passwords are not matching";
                        return false;
                    }
                if(confirmpass == ""){
                    document.getElementById('confirmpass').innerHTML = "*Please re-write your password*";
                    return false;

                }
              

                
            }
        </script>
        <script src="./javascript/popop.js"></script>
    </body>
   
            
    

</html>