<?php 
session_start();

include("php/connection.php");
include("php/functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div id="content">
        <h1>Welcome to My Website</h1>
        
        <p>Hello, <?php echo $user_data['full_name']; ?></p>
        <br>
        <div class="button-container">
            <a href="logout.php" id="button">Logout</a>
        </div>
    </div>
</body>
</html>