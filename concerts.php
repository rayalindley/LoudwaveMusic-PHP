<?php
    include 'includes/header.php';
    $sqlOrg = "SELECT * FROM tblorganizer";
    $resultOrg = mysqli_query($connection, $sqlOrg);

    // if (!isset($_SESSION['user_id'])) {
    //     header("Location: login.php");
    //     exit();
    // }

    $user_id = $_SESSION['user_id'];

    $sql_account = "SELECT * FROM tbluseraccount WHERE userid_fk = '$user_id'";
    $result_account = mysqli_query($connection, $sql_account);

    $sql_profile = "SELECT * FROM tblorganizer WHERE organizerid = '$user_id'";
    $result_profile = mysqli_query($connection, $sql_profile);

    if ($result_account && $result_profile) {
        $user_account_data = mysqli_fetch_assoc($result_account);
        $user_profile_data = mysqli_fetch_assoc($result_profile);
    } else {
        echo "Error: " . mysqli_error($connection);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="css/LoudWave.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="concert-container">
        <!-- <?php
            $concetlistsql = "SELECT * FROM tblconcert";
            $concertlistres = mysqli_query($connection, $concetlistsql);

            while ($row = mysqli_fetch_assoc($concertlistres)) {
                echo '<div class="concert-content">';
                echo '<div>';
                echo '<a href="ticket.php?concertname=' . urlencode($row['concert_name']) . '"><img src="images/' . htmlspecialchars($row['image']) . '"></a>';
                echo '</div>';

                echo '<div class="concert_maindeets">';
                echo '<h5>' . htmlspecialchars($row['concert_name']) . '</h5>';
                echo '<h6>' . htmlspecialchars($row['venue']) . '<br>' . htmlspecialchars($row['date']) . '</h6>';
                echo '</div>';
                echo '<a href="ticket.php?concertname=' . urlencode($row['concertname']) . '"> Buy Tickets >>>>> </a>';
                echo '</div>';
            }
        ?> -->


        <div class="concert-content">
            <div>
                <a href="ticket.php?concertname=R%20to%20V"><img src="images/concert_rtov.png"></a>
            </div>

            <div class="concert_maindeets">
                <h5> R to V </h5>
                <h6> SM Seaside Arena <br> April 15, 2025 </h6>
            </div>
            <a href="ticket.php?concertname=R%20to%20V"> Buy Tickets >>>>> </a>
        </div>

        <div class="concert-content">
            <div>
                <a href=""><img src="images/concert_bornpink.png"></a>
            </div>
            
            <div class="concert_maindeets">
                <h5> Born Pink </h5>
                <h6> SM Seaside Arena </br>
                April 15, 2025 </h6>
            </div>
            <a href=""> Buy Tickets >>>>> </a>
        </div>

        <div class="concert-content">
            <div>
                <a href=""><img src="images/concert_unisverse.png"></a>
            </div>
            
            <div class="concert_maindeets">
                <h5> Unis Verse </h5>
                <h6> SM Seaside Arena </br>
                April 15, 2025 </h6>
            </div>
            <a href=""> Buy Tickets >>>>> </a>
        </div>

        <div class="concert-content">
            <div>
                <a href=""><img src="images/concert_synk.png"></a>
            </div>
            
            <div class="concert_maindeets">
                <h5> SYNK: Parallel Line </h5>
                <h6> SM Seaside Arena </br>
                April 15, 2025 </h6>
            </div>
            <a href=""> Buy Tickets >>>>> </a>
        </div>

        <div class="concert-content">
            <div>
                <a href=""><img src="images/concert_biniverse.png"></a>
            </div>
            
            <div class="concert_maindeets">
                <h5> BINIverse </h5>
                <h6> SM Seaside Arena </br>
                April 15, 2025 </h6>
            </div>
            <a href=""> Buy Tickets >>>>> </a>
        </div>

    </div>

    <div id="concert-container">
        <!-- <?php
            $concetlistsql = "SELECT * FROM tblconcert";
            $concertlistres = mysqli_query($connection, $concetlistsql);

            while ($row = mysqli_fetch_assoc($concertlistres)) {
                echo '<div class="concert-content">';
                echo '<div>';
                echo '<a href="ticket.php?concertname=' . urlencode($row['concert_name']) . '"><img src="images/' . htmlspecialchars($row['image']) . '"></a>';
                echo '</div>';

                echo '<div class="concert_maindeets">';
                echo '<h5>' . htmlspecialchars($row['concert_name']) . '</h5>';
                echo '<h6>' . htmlspecialchars($row['venue']) . '<br>' . htmlspecialchars($row['date']) . '</h6>';
                echo '</div>';
                echo '<a href="ticket.php?concertname=' . urlencode($row['concertname']) . '"> Buy Tickets >>>>> </a>';
                echo '</div>';
            }
        ?> -->


        <div class="concert-content">
            <div>
                <a href="ticket.php?concertname=R%20to%20V"><img src="images/concert_rtov.png"></a>
            </div>

            <div class="concert_maindeets">
                <h5> R to V </h5>
                <h6> SM Seaside Arena <br> April 15, 2025 </h6>
            </div>
            <a href="ticket.php?concertname=R%20to%20V"> Buy Tickets >>>>> </a>
        </div>

        <div class="concert-content">
            <div>
                <a href=""><img src="images/concert_bornpink.png"></a>
            </div>
            
            <div class="concert_maindeets">
                <h5> Born Pink </h5>
                <h6> SM Seaside Arena </br>
                April 15, 2025 </h6>
            </div>
            <a href=""> Buy Tickets >>>>> </a>
        </div>

        <div class="concert-content">
            <div>
                <a href=""><img src="images/concert_unisverse.png"></a>
            </div>
            
            <div class="concert_maindeets">
                <h5> Unis Verse </h5>
                <h6> SM Seaside Arena </br>
                April 15, 2025 </h6>
            </div>
            <a href=""> Buy Tickets >>>>> </a>
        </div>

        <div class="concert-content">
            <div>
                <a href=""><img src="images/concert_synk.png"></a>
            </div>
            
            <div class="concert_maindeets">
                <h5> SYNK: Parallel Line </h5>
                <h6> SM Seaside Arena </br>
                April 15, 2025 </h6>
            </div>
            <a href=""> Buy Tickets >>>>> </a>
        </div>

        <div class="concert-content">
            <div>
                <a href=""><img src="images/concert_biniverse.png"></a>
            </div>
            
            <div class="concert_maindeets">
                <h5> BINIverse </h5>
                <h6> SM Seaside Arena </br>
                April 15, 2025 </h6>
            </div>
            <a href=""> Buy Tickets >>>>> </a>
        </div>

    </div>
</body>

</html>
