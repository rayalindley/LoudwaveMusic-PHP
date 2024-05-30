<?php
    include 'includes/header.php';
    
    $sqlOrg = "SELECT * FROM tblorganizer";
    $resultOrg = mysqli_query($connection, $sqlOrg);

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $sql_account = "SELECT * FROM tbluseraccount WHERE userid_fk = '$user_id'";
    $result_account = mysqli_query($connection, $sql_account);

    $sql_profile = "SELECT * FROM tblorganizer WHERE organizerid = '$user_id'";
    $result_profile = mysqli_query($connection, $sql_profile);

    if ($result_account && $result_profile) {
        $user_account_data = mysqli_fetch_assoc($result_account);
        $user_profile_data = mysqli_fetch_assoc($result_profile);
    } else {
        echo "Error: " . mysqli_error($connection);
    }
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="customerprofilecontainer">
        <div class="leftcontainer">
            <nav>
                <ul>
                    <li id="profileorgnav" class="currprof">Profile</li>
                    <li id="otherorgnav">Other Organizers</li>
                </ul>
            </nav>
        </div>

        <div class="rightcontainer">
            <div id="cusdeetcon" class="customerdetails">
                <div class="editemailpass">
                    <label>Email Address: </label>
                    <label><?php echo isset($user_account_data['emailadd']) ? $user_account_data['emailadd'] : ''; ?></label>
                    <br>
                    <a href="#">Change Email</a>
                    <a href="#">Change Password</a>
                </div>

                <br>

                <div class="editdeets">
                    <div class="deetlabels">
                        <label for="txtfirstname">First Name:</label><br>
                        <label for="txtlastname">Last Name:</label><br>
                        <label for="gender">Organizer Role:</label><br>
                    </div>

                    <div>
                        <form method="post" id="editProfileForm">
                            <input type="text" name="txtfirstname" id="txtfirstname" placeholder="First Name" value="<?= $user_profile_data['firstname'] ?? '' ?>" required> <br>
                            <input type="text" name="txtlastname" id="txtlastname" placeholder="Last Name" value="<?= $user_profile_data['lastname'] ?? '' ?>" required> <br>
                            <select name="txtgender" id="gender" required>
                                <option value="">Organizer Role</option>
                                <option value="Event Coordinator" <?= ($user_profile_data['org_role'] ?? '') == 'Event Coordinator' ? 'selected' : '' ?>>Event Coordinator</option>
                                <option value="Event Designer" <?= ($user_profile_data['org_role'] ?? '') == 'Event Designer' ? 'selected' : '' ?>>Event Designer</option>
                                <option value="Content Creator" <?= ($user_profile_data['org_role'] ?? '') == 'Content Creator' ? 'selected' : '' ?>>Content Creator</option>
                            </select> <br>
                            <br>
                            <div class="savedelbtn">
                                <input type="submit" name="btnSave" value="Save" id="saveBtn">
                                <input type="submit" name="btnDeleteAcc" value="Delete" id="deleteAccBtn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="otherorgscon" class="orgprofile-container hidden">
                <div id="organizer-container">

                    <?php
                        echo '<table class="orgtable">';

                        echo "<tr>";
                        echo "<th> Organizer ID </th>";
                        echo "<th> First Name </th>";
                        echo "<th> Last Name </th>";
                        echo "<th> Email Address </th>";
                        echo "<th> Organizer Role </th>";
                        echo "</tr>";

                        while ($row = mysqli_fetch_assoc($resultOrg)) {
                            if ($user_id != $row['organizerid']) {
                                $orgemailsql = "SELECT emailadd FROM tbluseraccount WHERE userid_fk = " . $row['organizerid'];
                                $orgemailres = mysqli_query($connection, $orgemailsql);
                                
                                if ($orgemailres && $orgemailrow = mysqli_fetch_assoc($orgemailres)) {
                                    echo "<tr>";
                                    echo "<td> {$row['organizerid']} </td>";
                                    echo "<td> {$row['firstname']} </td>";
                                    echo "<td> {$row['lastname']} </td>";
                                    echo "<td> {$orgemailrow['emailadd']} </td>";
                                    echo "<td> {$row['org_role']} </td>";
                                    echo "</tr>";
                                }
                            }
                        }

                        echo "</table>";
                    ?>
                </div>
            </div>
            <a href="logout.php"> Log Out</a>
        </div>

        
    </div>
</body>

<script src="js/LoudWave.js"></script>
<script>
    $(document).ready(function() {
        $("#otherorgnav").click(function() {
            $("#cusdeetcon").hide();
            $("#otherorgscon").show();
            $("#profileorgnav").removeClass("currprof");
            $("#otherorgnav").addClass("currprof");
        });

        $("#profileorgnav").click(function() {
            $("#cusdeetcon").show();
            $("#otherorgscon").hide();
            $("#otherorgnav").removeClass("currprof");
            $("#profileorgnav").addClass("currprof");
        });
    });
</script>

</html>
