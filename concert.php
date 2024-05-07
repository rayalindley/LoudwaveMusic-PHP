<?php
    include 'connect.php';
    $sqlOrg = "SELECT * FROM tblconcert";
    $resultOrg = mysqli_query($connection, $sqlOrg);
?>

<style>
    <?php
        include 'css/LoudWave.css';
    ?>
</style>

<head>
    <title> LoudWave Music </title>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Ojuju:wght@200..800&display=swap" rel="stylesheet">
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
            <a href="register.php"> Register </a>
            <a href="#"> / </a>
            <a href="login.php"><img src="Images/icons8-user-material-rounded/icons8-user-24.png" alt=""> Log in </a>
        </div>
    </header>

    <div id="menu">
        <a href="aboutUsPage.html"> About Us </a>
        <a href="contactPage.html"> Contact Us </a>
    </div>

    <div class="container">
        <div>
            <div id="organizer-container">
                <h2>Concerts</h2>
                <ul>
                    <?php
                        while ($row = mysqli_fetch_assoc($resultOrg)) {
                            // Generate a link to concertdetails.php with concert ID as parameter
                            echo "<li>
                                Concert ID: {$row['concertID']}<br>
                                Concert Name: {$row['name']}<br>
                                Concert Date: {$row['datetime']}<br>
                                Concert Venue: {$row['province']}, {$row['city']}<br>
                                <a href='concertdetails.php?id={$row['concertID']}'>Edit</a>
                                <br><br>
                            </li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>