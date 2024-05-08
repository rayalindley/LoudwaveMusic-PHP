<?php
    include 'connect.php';
    include 'includes/header.php';
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
    <div class="container">
        <div>
            <div id="organizer-container">
                    <?php
                        echo "<h1> Concert List </h1>" ;
                       echo "<table border='1'>";
                        echo "<tr><th>Concert Name</th><th>Date</th><th>Time</th><th>Venue</th><th>Tickets Sold</th><th>Edit</th><th>Delete</th></tr>";

                        while ($row = mysqli_fetch_assoc($resultOrg)) {
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