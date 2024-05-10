<?php
    include 'includes/header.php';
    if(isset($_GET['concertname'])) {
        $_SESSION['concertname'] = $_GET['concertname'];
        $concertname = $_SESSION['concertname'];
    }
?>

<html>
    <body>
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php
                $sqlconcert = "SELECT * FROM tblconcert WHERE concert_name = '{$concertname}'";
                $res = mysqli_query($connection, $sqlconcert);

                if(mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_assoc($res);
                    echo "Date: " . $row['date'];
                } else {
                    echo "Concert not found!";
                }
            ?>
        <?php else: ?>
            <div> PLease Log In </div>
            
        <?php endif; ?>

        <div class="concert-sections">
        <div class="mvp-section">
            <h3> MVP </h3>
            <p> PHP 9,500 </p>
        </div>
        <div class="vip-section">
            <h3> VIP </h3>
            <p> PHP 6,500 </p>
        </div>
        <div class="myzone-section">
            <h3> MY Zone </h3>
            <p> PHP 4,000 </p>
        </div>
        </div>

    </body>
</html>
