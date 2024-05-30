<?php  
    session_start();
    include 'connect.php';
    $currpage = basename($_SERVER['PHP_SELF']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LoudWave Music </title>
    <link href="images/lwmlogo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Ojuju:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mohave:ital,wght@0,300..700;1,300..700&family=Passion+One:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <style>
        <?php include 'css/LoudWave.css'; ?>
    </style>
</head>

<header>
    <div> 
        <a href="index.php">
            <img src="images/lwmlogo.png" class="indexlogo">
            LoudWave Music
        </a>
    </div>

    <div>
        <a href="index.php" <?php if($currpage == 'index.php') echo 'class="currnav"'; ?>> Home </a>
        <a href="concerts.php" <?php if($currpage=='concerts.php') echo 'class="currnav"';?>> Concerts </a>
        <a href="aboutus.php" <?php if($currpage=='aboutus.php') echo 'class="currnav"';?>> About Us </a>
        <a href="contactus.php" <?php if($currpage=='contactus.php') echo 'class="currnav"';?>> Contact Us </a>
    </div>
    
    <div>
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php if(isset($_SESSION['isOrganizer']) && $_SESSION['isOrganizer']): ?>
                <a href="manageconcerts.php" <?php if($currpage=='manageconcerts.php') echo 'class="currnav"';?>> Manage Concerts </a>
                <a href="dashboard.php" <?php if($currpage=='dashboard.php') echo 'class="currnav"';?>> Dashboard </a>
                <a href="organizer.php" <?php if($currpage=='organizer.php') echo 'class="currnav"';?>> Profile </a>
            <?php else: ?>
                <a href="profile.php" class="rightmargin30"> Profile </a>
            <?php endif; ?>
        <?php else: ?>
            <a href="register.php"> Register </a>
            <a href="login.php" id="loginBtnIndex"><img src="Images/icons8-user-material-rounded/icons8-user-24.png" alt=""> Log in </a>
        <?php endif; ?>
    </div>
</header>