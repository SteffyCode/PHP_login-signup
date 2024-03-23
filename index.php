<?php 
session_start();
include("php/connection.php");
include("php/functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Extract data from the form
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password)) {
        // Read from database
        $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: login.php");
                    die;
                } else {
                    $error_message = "Wrong password!";
                }
            } else {
                $error_message = "User not found!";
            }
        } else {
            $error_message = "Database error!";
        }
    } else {
        $error_message = "Please enter email and password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div id="form">
        <form method="post">
            <h1>Login</h1>
            <?php if (!empty($error_message)) echo '<div style="color:red;">' . $error_message . '</div>'; ?>
			
            <!-- Email Input -->
            <input id="text" type="email" name="user_name" placeholder="Email"><br><br>
            
            <!-- Password Input -->
            <input id="text" type="password" name="password" placeholder="Password"><br><br>
            
            <!-- Submit Button -->
            <input id="button" type="submit" value="Login"><br><br>
            
            <!-- Signup Link -->
            <a href="signup.php">Click to Signup</a><br><br>
        </form>
    </div>
</body>
</html>
