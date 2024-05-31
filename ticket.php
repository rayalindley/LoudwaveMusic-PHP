<?php
    include 'includes/header.php';
    if(isset($_GET['concertname'])) {
        $_SESSION['concertname'] = $_GET['concertname'];
        $concertname = $_SESSION['concertname'];
    }
?>

<html>
    <body class="ticketphp">
        <div class="whitebgfromheader">
            <?php if(!isset($_SESSION['user_id'])): ?>
                <div> To buy or to view price availability, please log in <a href="login.php"> here </a> </div>

            
                
            <?php endif; ?>

            <?php
                $sqlconcert = "SELECT c.*, v.venue_name FROM tblconcert c 
                JOIN tblvenue v ON c.venueid = v.venueid 
                WHERE c.concert_name='{$concertname}' AND c.isDeleted = 0";
                // $sqlconcert = "SELECT * FROM tblconcert WHERE concert_name = '{$concertname}'";
                $res = mysqli_query($connection, $sqlconcert);

                if(mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_assoc($res);
                    echo '<div class="tixdiv">';
                    echo '<div class="imgdiv_tix"><img src="'. $row['image_path'].'" class="concertmig_tix"></div>';
                    echo '<div class="descdiv_tix">';
                    echo "<h1>" . $row['concert_name'] . "</h1>";
                    echo "<h2>" . $row['venue_name'] . "</h2>";
                    echo "<h3>" . $row['date'] . "</h3>";
                    echo "<h3>" . $row['start_time'] . "</h3>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "Concert not found!";
                }
            ?>

            <div>
                ABOUT
                <hr>
            </div>
        </div>

        <div class="concert-sections">
            <div>
            <h1>NOTICE TO ALL ONLINE CUSTOMERS</h1>
            <h2>Guidelines for Online Ticket Purchase.</h2>

            <h3>To protect all users from fraud and unintended misuse of credit cards, please note that the following should ALL bear the SAME NAME when buying tickets online:</h3>

            <h3> 1. SM Tickets user account </h3>
            <h3> 2. Credit card to be used </h3>
            <h3> 3. One (1) valid government ID to be presented for redemption </h3>
            
            <h3> Ticket redemption through a representative is NOT allowed. Only the cardholder who transacted online can redeem the ticket. To avoid any inconvenience, we request our patrons to comply with the above guidelines. The safety and security of our customers is always our top priority. By proceeding to payment, you agree with the above redemption process. Price is inclusive of standard ticket charges. </h3>
            </div>
            <div>Price</div>
            <div><button onclick="location.href='seats.php'">Buy Tickets</button></div>
        </div>
    </body>
</html>
