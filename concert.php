<?php
include 'connect.php';
include 'includes/header.php';
?>

<style>
    <?php include 'css/LoudWave.css'; ?>
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
                    //Concert Posters
                    $Posters = array(
                        "images/concert_rtov.png",
                        "images/concert_synk.png",
                        "images/concert_biniverse.png",
                        "images/concert_unisverse.png",
                        "images/concert_bornpink.png"
                    );
                    
                    $sql = "SELECT c.*, v.venue_name FROM tblconcert c 
                            JOIN tblvenue v ON c.venueid = v.venueid 
                            WHERE c.isDeleted = 0 ORDER BY c.concertid";
                    $result = mysqli_query($connection, $sql);

                    $index = 0;
                    echo "<h3> Concert List </h3>";
                    echo "<table class='concert_table' border='1'>";
                    echo "<tr><th>Poster</th><th>Concert Name</th><th>Date</th><th>Time</th><th>Venue</th><th>Tickets Sold</th><th>Edit</th><th>Delete</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        $image = $index < count($Posters) ? $Posters[$index] : "images/image_placeholder.png";
                        echo "<td><img src='" . $image . "' width='100px'></td>";
                        echo "<td>" . $row['concert_name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['start_time'] . " - " . $row['end_time'] . "</td>";
                        echo "<td>" . $row['venue_name'] . "</td>";
                        echo "<td>" . $row['tickets_sold'] . "</td>";
                        echo "<td> <a href='concertDetails.php?id={$row['concertid']}'>Edit</a> </td>";
                        echo "<td><a href='delete_concert.php?id={$row['concertid']}' onclick=\"return confirm('Are you sure you want to delete this concert?')\">Delete</a></td>";
                        echo "</tr>";
                        $index++;
                    }
                    echo "</table>";
                    ?>
            </div>
        </div>
    </div>
</body>
