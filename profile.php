<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    include 'connect.php';

    $user_id = $_SESSION['user_id'];
    
    if(isset($_POST['btnSave'])) {
        $fname = mysqli_real_escape_string($connection, $_POST['txtfirstname']);
        $lname = mysqli_real_escape_string($connection, $_POST['txtlastname']);
        $gender = mysqli_real_escape_string($connection, $_POST['txtgender']);
        $bdate = mysqli_real_escape_string($connection, $_POST['txtbdate']);

        // Update user profile data in the database
        $sql_update = "UPDATE tbluserprofile SET firstname='$fname', lastname='$lname', gender='$gender', birthdate='$bdate' WHERE userid='$user_id'";
        $result_update = mysqli_query($connection, $sql_update);

        if ($result_update) {
            // Redirect to profile page
            header("Location: profile.php");
            exit();
        } else {
            // Handle update failure
            $update_error_message = "Failed to update profile. Please try again.";
        }
    }

    if(isset($_POST['btnDeleteAcc'])) {
        // Delete user's profile data
        $sql_delete_profile = "DELETE FROM tbluserprofile WHERE userid='$user_id'";
        $result_delete_profile = mysqli_query($connection, $sql_delete_profile);

        // Delete user's account data
        $sql_delete_account = "DELETE FROM tbluseraccount WHERE userid_fk='$user_id'";
        $result_delete_account = mysqli_query($connection, $sql_delete_account);

        if ($result_delete_profile && $result_delete_account) {
            // Destroy session
            session_unset();
            session_destroy();

            // Redirect to index page
            header("Location: index.php");
            exit();
        } else {
            // Handle deletion failure
            $delete_error_message = "Failed to delete account. Please try again.";
        }
    }

    // Query for user account data
    $sql_account = "SELECT * FROM tbluseraccount WHERE userid_fk = '$user_id'";
    $result_account = mysqli_query($connection, $sql_account);

    // Query for user profile data
    $sql_profile = "SELECT * FROM tbluserprofile WHERE userid = '$user_id'";
    $result_profile = mysqli_query($connection, $sql_profile);


    // Check if queries were successful
    if ($result_account && $result_profile) {
        // Fetch user account data
        $user_account_data = mysqli_fetch_assoc($result_account);
        
        // Fetch user profile data
        $user_profile_data = mysqli_fetch_assoc($result_profile);
    } else {
        // Handle errors
        echo "Error: " . mysqli_error($connection);
    }

    mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LoudWave Music - My Profile</title>
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
            <!-- Display user profile information -->
            <a>Welcome, <?php echo isset($user_account_data['username']) ? $user_account_data['username'] : ''; ?>!</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div id="menu">
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
    </div>

    <div class="container">
        <h1> Profile </h1>
        
        <div class="grid2container">  
            <div>
                <nav>
                    <ul>
                        <li>Profile</li>
                        <li>Subscriptions</li>
                    </ul>
                </nav>
            </div>

            <div>

                <div>
                    <label>Email Address: </label>
                    <?php echo isset($user_account_data['emailadd']) ? $user_account_data['emailadd'] : ''; ?>
                    <br>
                    <a href="#"> Change Email </a>
                    <a href="#"> Change Password </a>
                </div>
                
                <div>
                    <form method="post" id="editProfileForm">
                        <label for="txtfirstname">First Name:</label>
                        <input type="text" name="txtfirstname" id="txtfirstname" placeholder="First Name" value="<?= $user_profile_data['firstname'] ?? '' ?>" required> <br>

                        <label for="txtlastname">Last Name:</label>
                        <input type="text" name="txtlastname" id="txtlastname" placeholder="Last Name" value="<?= $user_profile_data['lastname'] ?? '' ?>" required> <br>

                        <label for="gender">Gender:</label>
                        <select name="txtgender" id="gender" required>
                            <option value="">Gender</option>
                            <option value="Male" <?= ($user_profile_data['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= ($user_profile_data['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                        </select> <br>

                        <label for="txtbdate">Birthdate:</label>
                        <input type="text" name="txtbdate" id="txtbdate" placeholder="Birthdate" onfocus="(this.type='date')" value="<?= $user_profile_data['birthdate'] ?? '' ?>" required> <br>

                        <input type="submit" name="btnSave" value="Save" id="saveBtn">
                        <input type="submit" name="btnDeleteAcc" value="Delete" id="deleteAccBtn">
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>