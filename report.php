<?php
    include 'includes/header.php';
    $sqlOrg = "SELECT * FROM tblorganizer";
    $resultOrg = mysqli_query($connection, $sqlOrg);
?>

</html>
<body>
    <div class="reportcontainer">
        <h1> REPORTS </h1>

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
                    echo "<td> Account ID # </td>";
                    echo "<td> First Name </td>";
                    echo "<td> Last Name </td>";
                    echo "<td> Birthdate </td>";
                    echo "<td> Email Address </td>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($reportres)) {
                        echo "<tr>";
                        echo "<td> {$row['userid_fk']} </td>";
                        echo "<td> {$row['firstname']} </td>";
                        echo "<td> {$row['lastname']} </td>";
                        echo "<td> {$row['birthdate']} </td>";
                        echo "<td> {$row['emailadd']} </td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                ?>
            </div>

            <div>
            </div>
        </div>


        
    </div>
</body>
</html>