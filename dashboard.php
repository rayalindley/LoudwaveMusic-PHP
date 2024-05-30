<?php
    include 'includes/header.php';
    $sqlOrg = "SELECT * FROM tblorganizer";
    $resultOrg = mysqli_query($connection, $sqlOrg);
?>

<body>
    <div class="dashboardcontainer">
        <h1> DASHBOARD </h1>

        <div class="rowstats">
            <div class="indivstat" id="stat1">
                <h6>
                    <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/person-male.png" class="dashboard-taw-icon"/>
                    Total Users
                </h6>
                <?php
                    $totaluserssql = "SELECT acctid, COUNT(*) as total FROM tbluseraccount WHERE isDeleted=0 AND usertype='Customer'";
                    $usersres = mysqli_query($connection, $totaluserssql);
                    while($row = mysqli_fetch_array($usersres)) {
                        echo '<h2 class="statdatares">' . $row["total"] . '</h2>';
                    }
                ?>
            </div>
            
            <div class="indivstat">
            <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/person-male.png" class="dashboard-taw-icon"/>
                Average User Age <br/>
                <?php
                    $sql = "SELECT AVG(DATEDIFF(CURRENT_DATE(), birthdate) / 365) AS Average_Age FROM tbluserprofile";
                    $result = mysqli_query($connection, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<h2 class="statdatares">' . round($row["Average_Age"],2) . '</h2>';
                    }
                ?>
            </div>

            <div class="indivstat">
            <img src="https://img.icons8.com/ios-filled/50/FFFFFF/two-tickets.png" class="dashboard-taw-icon"/>
                Tickets Sold <br/>
                <?php
                    $query = "SELECT SUM(tickets_sold) AS TotalTicketsSold FROM tblconcert WHERE isDeleted = 0";
                    $result = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<h2 class="statdatares">' . $row["TotalTicketsSold"] . '</h2>';
                    }
                ?>
            </div>
            
            <div class="indivstat" id="stat2">
            <img src="https://img.icons8.com/ios-filled/50/FFFFFF/two-tickets.png" class="dashboard-taw-icon"/>
                Average Concerts / Year <br/>
                <?php
                    $query = "SELECT date FROM tblconcert";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        //Group concerts by year
                        $concerts_per_year = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $year = date('Y', strtotime($row['date']));
                            if (!isset($concerts_per_year[$year])) {
                                $concerts_per_year[$year] = 0;
                            }
                            $concerts_per_year[$year]++;
                        }

                        //Gets the number of concerts/year
                        $ConCount = [];
                        foreach ($concerts_per_year as $year => $count) {
                            $ConCount[] = $count;
                        }

                        //Overall average
                        $total_years = count($ConCount);
                        if ($total_years) {
                            $sumAve = array_sum($ConCount);
                            $overallAve = $sumAve / $total_years;
                            echo '<h2 class="statdatares">' . round($overallAve, 2) . '</h2>';
                        }
                    }
                ?>
            </div>
        </div>

        <div class="rowreports">
            <div class="indivreport">
                <img src="images/usergrowth-graph.png">
            </div>
            
            <div class="indivstat">
                <h6>
                    <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/person-male.png" class="dashboard-taw-icon"/>
                    Male Users <br>
                </h6>
                <?php
                    $totalmale = "SELECT gender, COUNT(*) as male FROM tbluserprofile WHERE gender = 'male'";
                    $maleres = mysqli_query($connection, $totalmale);
                    while($row = mysqli_fetch_array($maleres)) {
                        echo '<h2 class="statdatares">' . $row["male"] . '</h2>';
                    }
                ?>

                <h6>
                    <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/person-male.png" class="dashboard-taw-icon"/>
                    Female Users <br>
                </h6>
                <?php
                    $totalmale = "SELECT gender, COUNT(*) as female FROM tbluserprofile WHERE gender = 'female'";
                    $maleres = mysqli_query($connection, $totalmale);
                    while($row = mysqli_fetch_array($maleres)) {
                        echo '<h2 class="statdatares">' . $row["female"] . '</h2>';
                    }
                ?>

                <h6>
                    <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/person-male.png" class="dashboard-taw-icon"/>
                    Other Users <br>
                </h6>
                <?php
                    $totalmale = "SELECT gender, COUNT(*) as others FROM tbluserprofile WHERE gender = 'others'";
                    $maleres = mysqli_query($connection, $totalmale);
                    while($row = mysqli_fetch_array($maleres)) {
                        echo '<h2 class="statdatares">' . $row["others"] . '</h2>';
                    }
                ?>
            </div>
            
        </div>

        <div class="rowreports">
            <div class="indivreport">
                <?php
                  $query = "SELECT concert_name, date, start_time, end_time, venueid, tickets_sold FROM tblconcert WHERE venueid = 1 AND isDeleted = 0";
                  $result = mysqli_query($connection,$query);
                  
                  if(!$result){
                    die("Query failed: " . mysqli_error($connection));
                  }

                  echo '<h3 class="reportname">Concerts that are held in SM Seaside Arena</h3>';
                  echo '<table class="indivreporttable">';
                  echo '<tr class="columntitle">';
                  echo "<th>Concert Name</th><th>Date</th><th>Time</th><th>Tickets Sold</th></tr>";
                
                  while ($row = mysqli_fetch_assoc($result )) {
                      echo "<tr>";
                      echo "<td>" . $row['concert_name'] . "</td>";
                      echo "<td>" . $row['date'] . "</td>";
                      echo "<td>" . $row['start_time'] . " - " . $row['end_time'] . "</td>";
                      echo "<td>" . $row['tickets_sold'] . "</td>";
                      echo "</tr>";
                  }
                  echo "</table>";     
                ?>
            </div>

            <div class="indivreport">
                <?php
                  $query = "SELECT concert_name, date, start_time, end_time, venueid, tickets_sold FROM tblconcert WHERE venueid = 2 AND isDeleted = 0";
                  $result = mysqli_query($connection,$query);
                

                  echo '<h3 class="reportname">Concerts that are held in Mall Of Asia Arena</h3>';
                  echo '<table class="indivreporttable">';
                  echo '<tr class="columntitle">';
                  echo "<th>Concert Name</th><th>Date</th><th>Time</th><th>Tickets Sold</th></tr>";
                
                  while ($row = mysqli_fetch_assoc($result )) {
                      echo "<tr>";
                      echo "<td>" . $row['concert_name'] . "</td>";
                      echo "<td>" . $row['date'] . "</td>";
                      echo "<td>" . $row['start_time'] . " - " . $row['end_time'] . "</td>";
                      echo "<td>" . $row['tickets_sold'] . "</td>";
                      echo "</tr>";
                  }
                  echo "</table>";     
                ?>
            </div>
        </div>

        <div class="rowreports">
            <div class="indivreport">
                <?php
                    $sqlreport2 = "SELECT p.firstname, p.lastname, p.birthdate, a.emailadd, a.userid_fk
                                FROM tbluserprofile AS p 
                                INNER JOIN tbluseraccount AS a 
                                ON p.userid = a.userid_fk 
                                WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), p.birthdate)), '%Y') >= 60";

                    $reportres = mysqli_query($connection, $sqlreport2);

                    echo '<h3 class="reportname"> Senior Citizen Accounts</h3>';
                    echo '<table class="indivreporttable">';
                    echo '<tr class="columntitle">';
                    echo "<th> First Name </th>";
                    echo "<th> Last Name </th>";
                    echo "<th> Birthdate </th>";
                    echo "<th> Email Address </th>";
                    echo "</tr>";
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

            <div class="indivreport">
                <?php
                    $query = "SELECT concert_name, date, start_time, end_time, venueid, tickets_sold FROM tblconcert WHERE YEAR(date) = 2025 AND isDeleted = 0";
                    $result = mysqli_query($connection,$query);
                    
                    echo '<h3 class="reportname">Concerts that will be held in 2025</h3>';
                  echo '<table class="indivreporttable">';
                  echo '<tr class="columntitle">';
                    echo "<th>Concert Name</th><th>Date</th><th>Time</th><th>Tickets Sold</th></tr>";
                
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row['concert_name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['start_time'] . " - " . $row['end_time'] . "</td>";
                        echo "<td>" . $row['tickets_sold'] . "</td>";
                        echo "</tr>";
                    }
                
                    echo "</table>";
                ?>
            </div>
        </div>
        
        
        
        
    </div>
</body>
