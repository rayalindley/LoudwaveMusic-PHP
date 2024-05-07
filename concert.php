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
                    <?php
                       echo "<table border='1'>";
                        echo "<tr><th>Concert Name</th><th>Date</th><th>Time</th><th>Venue</th><th>Tickets Sold</th><th>Edit</th><th>Delete</th></tr>";

                        while ($row = mysqli_fetch_assoc($resultOrg)) {
                            // Generate a link to concertdetails.php with concert ID as parameter
                            echo "<tr>";
                            echo "<td>" . $row['concert_name'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['start_time'] . " - " . $row['end_time'] . "</td>";
                            $venueID = $row['venueid'];
                            $venueQuery = "SELECT venue_name FROM tblvenue WHERE venueid = $venueID";
                            $venueResult = mysqli_query($connection, $venueQuery);
                            $venue = mysqli_fetch_assoc($venueResult);
                            $venueName = $venue['venue_name'];
                            echo "<td>" . $venueName . "</td>";
                            echo "<td>" . $row['tickets_sold'] . "</td>";
                            echo "<td> <a href='concertdetails.php?id={$row['concertid']}'>Edit</a> </td>";
                            echo "<td>Delete</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                            
                    ?>
            </div>
        </div>
    </div>
</body>