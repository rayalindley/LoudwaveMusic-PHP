<?php
session_start(); // Start session (if not already started)

// Include database connection
include 'connect.php';

// Check if user is logged in and their account still exists
// if (isset($_SESSION['user_id'])) {
//     // Retrieve user ID from session
//     $user_id = $_SESSION['user_id'];

//     // Query to check if the user's account still exists
//     $query = "SELECT * FROM tbluseraccount WHERE acctid = $user_id";
//     $result = mysqli_query($connection, $query);

//     // Check if the query returned any rows
//     if (mysqli_num_rows($result) == 0) {
//         // User's account does not exist, invalidate session (log out)
//         session_unset(); // Unset all session variables
//         session_destroy(); // Destroy the session
//         header("location: index.php"); // Redirect to index page
//         exit(); // Stop further script execution
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LoudWave Music </title>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Ojuju:wght@200..800&display=swap" rel="stylesheet">
    <style>
        <?php include 'css/LoudWave.css'; ?>
    </style>
</head>
<body>
    <header>
        <div> 
            <a href="index.php">LoudWave Music</a>
        </div>

        <div>
            <input type="text" placeholder="Search concerts, events, and artists" class="search-bar">
        </div>
        
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <!-- If user is logged in, display "Profile" link -->
                <a href="profile.php"> Profile </a>
            <?php else: ?>
                <!-- If user is not logged in, display "Register" and "Login" links -->
                <a href="report.php"> Reports </a>
                <a href="register.php"> Register </a>
                <a href="#"> / </a>
                <a href="login.php"><img src="Images/icons8-user-material-rounded/icons8-user-24.png" alt=""> Log in </a>
            <?php endif; ?>
        </div>
    </header>

    <div id="menu">
        <a href="aboutus.php"> About Us </a>
        <a href="contactus.php"> Contact Us </a>
    </div>

    <div class="container">
        <h1>HOT ARTISTS !</h1>

        <div id="artist-container">
            <div>
                <img src="images/artist_bp.jpg">
                <p class="artist-name"> Blackpink </p>
            </div>

            <div>
                <img src="images/artist_bp.jpg">
                <p class="artist-name"> Blackpink </p>
            </div>

            <div>
                <img src="images/artist_bp.jpg">
                <p class="artist-name"> Blackpink </p>
            </div>

            <div>
                <img src="images/artist_bp.jpg">
                <p class="artist-name"> Blackpink </p>
            </div>
        </div>
    </div>
</body>
</html>
