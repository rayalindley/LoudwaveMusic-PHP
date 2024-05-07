<?php
    include 'connect.php';
    $sqlOrg = "SELECT * FROM tblorganizer";
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
    <link href="https://fonts.googleapis.com/css2?family=Mohave:ital,wght@0,300..700;1,300..700&family=Passion+One:wght@400;700;900&display=swap" rel="stylesheet">
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

        <!-- <div>
            <input type="text" placeholder="Search concerts, events, and artists" class="search-bar">
        </div> -->
        
        <div>
            <a href="index.php"> Home </a>
            <a href="#"> Concerts </a>
            <a href="aboutus.php"> About Us </a>
            <a href="contactus.php"> Contact Us </a>
        </div>

        <div>
            <a href="organizer.php" class="currnav"> Profile </a>
            <a href="#"> Manage Concerts </a>
            <a href="report.php"> Reports </a>
        </div>
    </header>

    <div class="nomargin-container">
        <div class="orgprofile-container">
            <form>
                <button style="color:black;"> Add Event </button>
            </form> 
            
            <div id="organizer-container">
                <h2>Organizers</h2>
                <ul>
                    
                    <?php
                        echo "<h3> Discounted Senior Citizen Customers (60 years old and above)</h3>";
                        echo "<table border='1'>";

                        echo "<td> First Name </td>";
                        echo "<td> Last Name </td>";
                        echo "<td> Birthdate </td>";
                        echo "<td> Email Address </td>";
                        while ($row = mysqli_fetch_assoc($resultOrg)) {
                            echo "<li>
                                ID: {$row['organizerid']}</br>
                                Lastname: {$row['lastname']}</br>
                                Firstname: {$row['firstname']}</br>
                                Role: {$row['org_role']}</br></br>
                            </li>";
                        }
                    ?>
                </ul>
            </div>
        </div>

        <a href="logout.php">Logout</a>
    </div>
</body>
