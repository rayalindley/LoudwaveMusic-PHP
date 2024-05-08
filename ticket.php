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
    </body>
</html>
