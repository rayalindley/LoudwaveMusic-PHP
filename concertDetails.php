<?php
    include 'connect.php';
    include 'includes/header.php';
?> 

<style>
    <?php
        include 'css/LoudWave.css';
    ?>
</style>    

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Concert Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="p-5">
    <form method="post">
        <div class="col-sm-6">
            <h3>Concert Details</h3>
        </div>
        <hr>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Concert Name *</label>
            <input type="text" class="form-control form-control-md" name="name_text" placeholder="Concert Name" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Concert Date *</label>
            <input type="date" class="form-control form-control-md" name="date_text" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Start Time *</label>
            <input type="time" class="form-control form-control-md" name="start_time" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">End Time *</label>
            <input type="time" class="form-control form-control-md" name="end_time" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Concert Venue *</label>
            <select class="form-control form-control-md" name="venue_text" required>
                <option value="">Select a venue</option>
                <option value="SM Seaside Arena">SM Seaside Arena</option>
                <option value="Mall of Asia Arena">Mall of Asia Arena</option>
            </select>
        </div>
        <div class="col-md-6">
            <input type="submit" value="Add Concert" name="btnconcert">
        </div>
    </form>
</body>
</html>

<?php
    if(isset($_POST['btnconcert'])){
        $name = $_POST['name_text'];
        $date = $_POST['date_text'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $venue_text = $_POST['venue_text'];

        $venue_query = "SELECT venueid FROM tblvenue WHERE venue_name = ?";
        if ($venue_result = mysqli_prepare($connection, $venue_query)) {
            mysqli_stmt_bind_param($venue_result, "s", $venue_text);
            mysqli_stmt_execute($venue_result);
            mysqli_stmt_store_result($venue_result);
            
            if (mysqli_stmt_num_rows($venue_result) == 1) {
                mysqli_stmt_bind_result($venue_result, $venueid);
                mysqli_stmt_fetch($venue_result);
            } else {
                echo "Error: Venue not found.";
                exit();
            }
            mysqli_stmt_close($venue_result);
        } else {
            echo "Error: Failed to prepare venue query.";
            exit();
        }

        $check_query = "SELECT * FROM tblconcert WHERE venueid = ? AND date = ? AND (start_time >= ? AND end_time <= ?)";
        if ($check_stmt = mysqli_prepare($connection, $check_query)) {
            mysqli_stmt_bind_param($check_stmt, "isss", $venueid, $date, $start_time, $end_time);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);
            
            if (mysqli_stmt_num_rows($check_stmt) > 0) {
                echo "Error: There is already a concert scheduled at the selected venue and date/time.";
                exit();            
            }
            mysqli_stmt_close($check_stmt);
        } else {
            echo "Error: Failed to prepare check query.";
            exit();
        }

        $insert_query = "INSERT INTO tblconcert (concert_name, date, start_time, end_time, venueid) VALUES (?, ?, ?, ?, ?)";
        if ($insert_stmt = mysqli_prepare($connection, $insert_query)) {
            mysqli_stmt_bind_param($insert_stmt, "ssssi", $name, $date, $start_time, $end_time, $venueid);
            if (mysqli_stmt_execute($insert_stmt)) {
                echo "<script language='javascript'> alert('New record saved.'); </script>";
            } else {
                echo "Error: " . mysqli_error($connection);
            }
            mysqli_stmt_close($insert_stmt);
        } else {
            echo "Error: Failed to prepare insert statement.";
        }
    }
?>
