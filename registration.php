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
<!DOCTYPE html>
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
        .success-message,
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
<?php
               if (isset($_SESSION['success_message'])) {
                  echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
                  // Clear the success message after displaying it
                  unset($_SESSION['success_message']);
               }
               ?>
    <div class="login-card-container">
        <div class="login-card">

            <div class="login-card-logo">
                <img src="./image/logo.jpg " alt="logo">
            </div>
            <div class="login-card-header">
                <h1>Register Here</h1>
            </div>
            <form class="register" action="" method="post" onsubmit="return validateForm()">
                <label> Username:</label><br>
                <input type="text" name="Username" id="user" class="form-control" placeholder="Enter your Username"
                    autocomplete="off">
                <br><span id="usernameError" style="color: red;"></span><br>
                <label>Email: </label><br>
                <input type="email" name="email" id="emails" class="form-control" placeholder="Enter your email"
                    autocomplete="off"> <br>
                <span id="emailError" style="color: red;"></span><br>
                <label>Password: </label><br>
                <input type="password" name="password" id="pass" class="form-control" placeholder="Enter Password"
                    autocomplete="off"> <br>
                <span id="passwordError" style="color: red;"></span><br>
                <label>Confirm Password: </label><br>
                <input type="password" name="Re-Enterpassword" id="conpass" class="form-control"
                    placeholder="Re-Enterpassword" autocomplete="off"> <br>
                <span id="confirmPasswordError" style="color: red;"></span><br>
                <label>Mobile Number: </label><br>
                <input type="tel" name="Mobile-number" id="MobNo" class="form-control"
                    title="Mobile number should start with 98 and be 10 digits in total" placeholder="XXXXXXXXXX"
                    autocomplete="off">
                <br><span id="mobileNumberError" style="color: red;"></span><br>
                <label>Age</label><br>
                <input type="number" name="age" id="age" placeholder="enter your age?" min="18">
                <br><span id="ageError" style="color: red;"></span><br><br>
                <button type="submit" name="submit" value="submit">Register</button>
                <div class="login-card-footer">
                    already have an account? <a href="signin.html">Login Here</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
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
            var mobileNumberRegex = /^(98|97)[0-9]{8}$/;


            // Validation checks
            document.getElementById('usernameError').innerHTML = !usernameRegex.test(username) ? "Criteria: 4-16 characters, letters, numbers, and underscores" : "";
            document.getElementById('emailError').innerHTML = !emailRegex.test(email) ? "Invalid Email" : "";
            document.getElementById('passwordError').innerHTML = !passwordRegex.test(password) ? "Criteria: at least 8 characters, one lowercase, one uppercase, and one digit" : "";
            document.getElementById('confirmPasswordError').innerHTML = password !== confirmPassword ? "Passwords do not match" : "";
            document.getElementById('mobileNumberError').innerHTML = !mobileNumberRegex.test(mobileNumber) ? "Mobile number should start with 97 or 98 and 10 digiths in total" : "";
            document.getElementById('ageError').innerHTML = age < 18 ? "Age should be above 18" : "";

            // If any error is present, prevent form submission
            return !(document.getElementById('usernameError').innerHTML ||
                document.getElementById('emailError').innerHTML ||
                document.getElementById('passwordError').innerHTML ||
                document.getElementById('confirmPasswordError').innerHTML ||
                document.getElementById('mobileNumberError').innerHTML ||
                document.getElementById('ageError').innerHTML);
        }
    </script>
</body>

</html>
