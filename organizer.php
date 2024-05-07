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
