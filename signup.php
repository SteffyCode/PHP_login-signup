<?php 
session_start();

include("php/connection.php");
include("php/functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation checks
    if(!empty($full_name) && !empty($user_name) && !empty($password) && !empty($confirm_password) && !is_numeric($full_name)) {
        // Ensure email format
        if (filter_var($user_name, FILTER_VALIDATE_EMAIL)) {
            // Check if passwords match
            if ($password === $confirm_password) {
                // Save to database
                $user_id = random_num(20);
                $query = "INSERT INTO users (user_id, full_name, user_name, password) VALUES ('$user_id', '$full_name', '$user_name', '$password')";
                mysqli_query($con, $query);

                header("Location: index.php");
                die;
            } else {
                $error_message = "Passwords do not match!";
            }
        } else {
            $error_message = "Please enter a valid email address!";
        }
    } else {
        $error_message = "Please fill in all fields with valid information!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div id="form">
        <form method="post">
            <h1>SignUp</h1>

            <!-- Error Message Display -->
            <?php 
            if(!empty($error_message)) {
                echo '<div style="color:red;">'.$error_message.'</div>';
            }
            ?>

            <!-- Full Name Input -->
            <input id="text" type="text" name="full_name" placeholder="Full Name"><br><br>
            
            <!-- Email Input -->
            <input id="text" type="email" name="user_name" placeholder="Email"><br><br>
            
            <!-- Password Input -->
            <input id="text" type="password" name="password" placeholder="Password"><br><br>
            
            <!-- Confirm Password Input -->
            <input id="text" type="password" name="confirm_password" placeholder="Confirm Password"><br><br>
            
            <!-- Submit Button -->
            <input id="button" type="submit" value="Signup"><br><br>
            
            <!-- Login Link -->
            <a href="index.php">Click to Login</a><br><br>
        </form>
    </div>
</body>
</html>

