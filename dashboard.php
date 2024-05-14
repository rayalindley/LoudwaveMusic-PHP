<?php
    include 'includes/header.php';
    $sqlOrg = "SELECT * FROM tblorganizer";
    $resultOrg = mysqli_query($connection, $sqlOrg);
?>

</html>

    

<body>
    <div class="dashboardcontainer">
        <h1> DASHBOARD </h1>

        <div class="rowstats">
            <div class="indivstat">
                <h6>
                    <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/person-male.png" class="dashboard-taw-icon"/>
                    Total Users
                </h6>
                <?php
                    $totaluserssql = "SELECT acctid, COUNT(*) as total FROM tbluseraccount";
                    $usersres = mysqli_query($connection, $totaluserssql);
                    while($row = mysqli_fetch_array($usersres)) {
                        echo $row["total"];
                    }
                ?>
            </div>
            
            <div class="indivstat">
                <h6>
                    <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/person-male.png" class="dashboard-taw-icon"/>
                    Total Males <br>
                </h6>
                Total Females <br>
                Others 
            </div>
            
            <div class="indivstat">
                <h6>
                    <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/person-male.png" class="dashboard-taw-icon"/>
                    AVG User Age
                </h6>
            </div>

            <div class="indivstat">
                <h6>
                    <img src="https://img.icons8.com/ios-filled/50/FFFFFF/two-tickets.png" class="dashboard-taw-icon"/>
                    Tickets Sold
                </h6>
            </div>
            
            <div class="indivstat">
                <h6>
                    <img src="https://img.icons8.com/ios-filled/50/FFFFFF/two-tickets.png" class="dashboard-taw-icon"/>
                    AVG Concerts
                </h6>
            </div>
        </div>

        <div class="rowreports">
            <div class="indivreport">
                <?php
                  $query = "SELECT concert_name, date, start_time, end_time, venueid, tickets_sold FROM tblconcert WHERE venueid = 1";
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
                  $query = "SELECT concert_name, date, start_time, end_time, venueid, tickets_sold FROM tblconcert WHERE venueid = 2";
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
                    $query = "SELECT concert_name, date, start_time, end_time, venueid, tickets_sold FROM tblconcert WHERE YEAR(date) = 2025";
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

        
        <h1> STATISTICS </h1>
            <?php
                $gendersql = "SELECT gender, COUNT(*) AS number FROM tbluserprofile GROUP BY gender";
                $genderres = mysqli_query($connection, $gendersql);
            ?>
            <div id="genderpiechart" style="width: 300px; height: 300px;"></div>
        
        <h1> CHART </h1>
        
    </div>
</body>
</html>

<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([['Gender', 'Number'], 
                <?php
                    while($row=mysqli_fetch_array($genderres)) {
                        echo "['" . $row["gender"] . "', " . $row["number"] . "],";
                     }    
                ?>
            ]);
            var options = {title: 'Statistics by gender', pieHole: 0.4};
            var chart = new google.visualization.PieChart(document.getElementById('genderpiechart'));
            chart.draw(data, options);
        }
    </script>