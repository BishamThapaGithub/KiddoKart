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
    $phone = $_POST['Mobile-number'];
    // Validate that all fields are filled
    if (empty($fullname) || empty($email) || empty($password) || empty($cpassword) || empty($age) || empty($phone)) {
        echo "<script>alert('Please fill all fields');</script>";
    } else {
        // Check if the passwords match
        if ($password !== $cpassword) {
            echo "Passwords do not match";
        } else {
            // Insert data into the database
            $sql = "INSERT INTO users (Username, Email, Password, Age, UserRole , Phone_No) VALUES ('$fullname', '$email', '$password', '$age', '$user_role', '$phone')";
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
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

<body>
    <div class="login-card-container">
        <div class="login-card">

            <div class="login-card-logo">
                <img src="./image/logo.jpg " alt="logo">
            </div>
            <div class="login-card-header">
                <h1>Register Here</h1>

            </div>
            <form class="register" action="" method="post" onsubmit="return validation()">
                <label> Username:</label>
                <br>
                <input type="text" name="Username" id="user" class="form-control" placeholder="Enter your Username"
                    autocomplete="off">
                <br>
                <span id="username" style="color: red;"></span>
                <br>
                <label>Email: </label>
                <br>
                <input type="email" name="email" id="emails" class="form-control" placeholder="Enter your email"
                    autocomplete="off"> <br>
                <span id="emailids" style="color: red;"></span><br>
                <label>Password: </label>
                <br>
                <input type="password" name="password" id="pass" class="form-control" placeholder="Enter Password"
                    autocomplete="off"> <br>
                <span id="passwords" style="color: red;"></span><br>
                <label>Confirm Password: </label>
                <br>
                <input type="password" name="Re-Enterpassword" id="conpass" class="form-control"
                    placeholder="Re-Enterpassword" autocomplete="off"> <br>
                <span id="confirmpass" style="color: red;"></span><br>
                <label>Mobile Number: </label>
                <br>
                <input type="tel" name="Mobile-number" id="MobNo" class="form-control" required pattern="98[0-9]{8}"
                    title="Mobile number should start with 98 and be 10 digits in total" placeholder="XXXXXXXXXX"
                    autocomplete="off">
                <br>
                <span id="MobNo" style="color: red;"></span><br>



                <label>Age</label><br>
                <input type="number" name="age" id="age" placeholder="enter your age?" min="18">
                <br> <span id="age" style="color: red;"></span><br><br>



                <button type="submit" name="submit" value="submit">Register</button>
                <div class="login-card-footer">
                    already have an account? <a href="signin.html">Login Here</a>
                </div>


        </div>
        </form>

        
       
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.querySelector('.register');
            form.addEventListener("submit", function(event) {
                var username = document.getElementById('user').value;
                var email = document.getElementById('emails').value;
                var password = document.getElementById('pass').value;
                var confirmPassword = document.getElementById('conpass').value;
                var mobileNumber = document.getElementById('MobNo').value;
                var age = document.getElementById('age').value;

                // Regular expressions for validation
                var usernameRegex = /^[a-zA-Z0-9_]{4,16}$/; 
                var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
                var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/; 
                var mobileNumberRegex = /^98[0-9]{8}$/; 

                // Validation checks
                if (!usernameRegex.test(username)) {
                    document.getElementById('username').innerHTML = "Criteria: 4-16 characters, letters, numbers, and underscores";
                    event.preventDefault();
                } else {
                    document.getElementById('username').innerHTML = "";
                }

                if (!emailRegex.test(email)) {
                    document.getElementById('emailids').innerHTML = "Invalid Email";
                    event.preventDefault();
                } else {
                    document.getElementById('emailids').innerHTML = "";
                }

                if (!passwordRegex.test(password)) {
                    document.getElementById('passwords').innerHTML = "Criteria: at least 8 characters, one lowercase, one uppercase, and one digit";
                    event.preventDefault();
                } else {
                    document.getElementById('passwords').innerHTML = "";
                }

                if (password !== confirmPassword) {
                    document.getElementById('confirmpass').innerHTML = "Passwords do not match";
                    event.preventDefault();
                } else {
                    document.getElementById('confirmpass').innerHTML = "";
                }

                if (!mobileNumberRegex.test(mobileNumber)) {
                    document.getElementById('MobNoError').innerHTML = "Mobile number is invalid";
                    event.preventDefault();
                } else {
                    document.getElementById('MobNoError').innerHTML = "";
                }

                if (age < 18) {
                    ocument.getElementById('MobNoError').innerHTML = "Age Should be above 18";
                    event.preventDefault();
                }
            });
        });
    </script>


</body>




</html>