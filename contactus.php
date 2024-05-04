<?php
    include 'connect.php';
?>

<style>
    <?php
        include 'css/LoudWave.css';
    ?>
</style>

<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in
    $profile_link = "profile.php"; // Assuming profile page is profile.php
    $logout_link = "logout.php"; // Assuming logout page is logout.php
?>
    <nav>
        <ul>
            <li><a href="<?php echo $profile_link; ?>">Profile</a></li>
            <li><a href="<?php echo $logout_link; ?>">Logout</a></li>
        </ul>
    </nav>
<?php
} else {
    // User is not logged in
    $login_link = "login.php"; // Assuming login page is login.php
    $register_link = "register.php"; // Assuming register page is register.php
?>
    <nav>
        <ul>
            <li><a href="<?php echo $login_link; ?>">Login</a></li>
            <li><a href="<?php echo $register_link; ?>">Register</a></li>
        </ul>
    </nav>
<?php
}
?>


<body>
    <header>
        <div> 
            <a href="index.php">LoudWave Music</a>
        </div>

        <div>
            <input type="text" placeholder="Search concerts, events, and artists" class="search-bar">
        </div>
        
        <div>
            <a href="register.php"> Register </a>
            <a href="#"> / </a>
            <a href="login.php"><img src="Images/icons8-user-material-rounded/icons8-user-24.png" alt=""> Log in </a>
            <a href="#">
                <?php
                    if(isset($fethUsername)) {
                        echo "My Profile";
                    }
                ?>
        </div>
    </header>


    <div class="grid2container">
        <div class="rightgrid">
            agfwasg
        </div>

        <div class="leftgrid">
        agsg
        </div>
    </div>
</body>