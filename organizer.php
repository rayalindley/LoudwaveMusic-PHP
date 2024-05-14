<?php
    include 'includes/header.php';
    $sqlOrg = "SELECT * FROM tblorganizer";
    $resultOrg = mysqli_query($connection, $sqlOrg);
?>



    <div >
        <div>
            <button> My Profile </button>
            <button> Other Organizers </button>
        </div>

        <div class="orgprofile-container">
            
            <div id="organizer-container">
                <h2>Organizers</h2>
                <ul>
                    
                    <?php
                        echo "<h3> Other Organizers </h3>";
                        echo '<table  class="orgtable">';

                        echo "<tr>";
                        echo "<th> First Name </th>";
                        echo "<th> Last Name </th>";
                        echo "<th> Birthdate </th>";
                        echo "<th> Email Address </th>";
                        echo "</tr>";
                        while ($row = mysqli_fetch_assoc($resultOrg)) {
                            echo "<tr>";
                            echo "<td> ID: {$row['organizerid']} </td>"; 
                            echo "<td> Lastname: {$row['lastname']} </td>";
                            echo "<td> Firstname: {$row['firstname']} </td>";
                            echo "<td> Role: {$row['org_role']} </td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    ?>
                </ul>
            </div>
        </div>

        <a href="logout.php">Logout</a>
    </div>
</body>
