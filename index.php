<?php
    session_start();
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LoudWave Music </title>
    <link href="images/lwmlogo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Ojuju:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mohave:ital,wght@0,300..700;1,300..700&family=Passion+One:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        <?php include 'css/LoudWave.css'; ?>
    </style>
</head>

<body>
    <header>
        <div> 
            <a href="index.php">
                <img src="images/lwmlogo.png" class="indexlogo">
             </a>
            
            <a href="index.php">
                LoudWave Music
            </a>

        </div>

        <div>
            <a href="index.php" class="currnav"> Home </a>
            <a href="concerts.php"> Concerts </a>
            <a href="aboutus.php"> About Us </a>
            <a href="contactus.php"> Contact Us </a>
        </div>
        
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <?php if(isset($_SESSION['isOrganizer']) && $_SESSION['isOrganizer']): ?>
                    <a href="manageconcerts.php"> Manage Concerts </a>
                    <a href="dashboard.php"> Dashboard </a>
                    <a href="organizer.php"> Profile </a>
                <?php else: ?>
                    <a href="profile.php" class="rightmargin30"> Profile </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="register.php"> Register </a>
                <a href="login.php" id="loginBtnIndex"><img src="Images/icons8-user-material-rounded/icons8-user-24.png" alt=""> Log in </a>
            <?php endif; ?>
        </div>

    </header>

    <div>
        <h1 class="textbanner2"> Let the <span class="textbanner">Sound Waves</span> Take Over <br> with <span class="textbanner">LoudWave Music </span></h1>
        <h6 id="bannersub"> Browse our selection, grab your friends, and let the sound waves take over. </h6>
    </div>

    
    <div class="parcontainer">

        <div class="botcontainer">
            <h1> FEATURED ARTISTS !</h1>

            <div id="artist-container">
                <div>
                    <img src="images/artist_blackpink.jpg">
                    <p class="artist-name"> BLACKPINK </p>
                </div>

                <div>
                    <img src="images/artist_unis.jpg">
                    <p class="artist-name"> UNIS </p>
                </div>

                <div>
                    <img src="images/artist_aespa.png">
                    <p class="artist-name"> AESPA </p>
                </div>

                <div>
                    <img src="images/artist_bini.jpg">
                    <p class="artist-name"> BINI </p>
                </div>
            </div>
                
            <h1> HOT TICKETS!</h1>

            <div id="concert-container">
                <div class="concert-content">
                    <div>
                        <a href="ticket.php?concertname=R to V"><img src="images/concert_rtov.png"></a>
                    </div>

                    <div class="concert_maindeets">
                        <h5> R to V </h5>
                        <h6> SM Seaside Arena <br> April 15, 2025 </h6>
                    </div>
                    <a href="ticket.php?concertname=R to V"> Buy Tickets >>>>> </a>
                </div>

                <div class="concert-content">
                    <div>
                        <a href="ticket.php?concertname=Born Pink"><img src="images/concert_bornpink.png"></a>
                    </div>
                    
                    <div class="concert_maindeets">
                        <h5> Born Pink </h5>
                        <h6> SM Seaside Arena </br>
                        April 15, 2025 </h6>
                    </div>
                    <a href="ticket.php?concertname=Born Pink"> Buy Tickets >>>>> </a>
                </div>
                
                <div class="concert-content">
                    <div>
                        <a href="ticket.php?concertname=Unis Verse"><img src="images/concert_unisverse.png"></a>
                    </div>
                    
                    <div class="concert_maindeets">
                        <h5> Unis Verse </h5>
                        <h6> SM Seaside Arena </br>
                        April 15, 2025 </h6>
                    </div>
                    <a href="ticket.php?concertname=Unis Verse"> Buy Tickets >>>>> </a>
                </div>
                
                <div class="concert-content">
                    <div>
                        <a href="ticket.php?concertname=SYNK: Parallel Line"><img src="images/concert_synk.png"></a>
                    </div>
                    
                    <div class="concert_maindeets">
                        <h5> SYNK: Parallel Line </h5>
                        <h6> SM Seaside Arena </br>
                        April 15, 2025 </h6>
                    </div>
                    <a href="ticket.php?concertname=SYNK: Parallel Line"> Buy Tickets >>>>> </a>
                </div>
                
                <div class="concert-content">
                    <div>
                        <a href="ticket.php?concertname=BINIverse: The First Solo Concert"><img src="images/concert_biniverse.png"></a>
                    </div>
                    
                    <div class="concert_maindeets">
                        <h5> BINIverse </h5>
                        <h6> SM Seaside Arena </br>
                        April 15, 2025 </h6>
                    </div>
                    <a href="ticket.php?concertname=BINIverse: The First Solo Concert"> Buy Tickets >>>>> </a>
                </div>

                
            </div>
        </div>
        
        <div class="topcontainer">
            <input type="text" placeholder="Search for concerts and artists to find your next favorite music experience" class="search-bar">
        </div>
    </div>
</body>
</html>
