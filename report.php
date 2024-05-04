<?php
    include 'connect.php';
    $sqlOrg = "SELECT * FROM tblorganizer";
    $resultOrg = mysqli_query($connection, $sqlOrg);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LoudWave Music - Reports </title>
    <link href="css/LoudWave.css" rel="stylesheet">
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
        <a href="aboutus.php"> About Us </a>
        <a href="contactus.php"> Contact Us </a>
    </div>

    <div>
        <h2> REPORTS </h2>

        <?php
        $sqlreport2 = "SELECT p.firstname, p.lastname, p.birthdate, a.emailadd 
                    FROM tbluserprofile AS p 
                    INNER JOIN tbluseraccount AS a 
                    ON p.userid = a.userid_fk 
                    WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), p.birthdate)), '%Y') >= 60";

        $reportres = mysqli_query($connection, $sqlreport2);

        echo "<h3> Discounted Senior Citizen Customers (60 years old and above)</h3>";
        echo "<table border='1'>";

        echo "<td> First Name </td>";
        echo "<td> Last Name </td>";
        echo "<td> Birthdate </td>";
        echo "<td> Email Address </td>";
        while ($row = mysqli_fetch_assoc($reportres)) {
            echo "<tr>";
            echo "<td> {$row['firstname']} </td>";
            echo "<td> {$row['lastname']} </td>";
            echo "<td> {$row['birthdate']} </td>";
            echo "<td> {$row['emailadd']} </td>";
            echo "</tr>";
        }

        echo "</table>";
        ?>
        
    </div>
</body>
</html>