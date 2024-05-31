<?php
include 'connect.php';
include 'includes/header.php';
    $concert_id = null;
if (isset($_GET['id'])) {
    // Retrieve concert ID from the URL
    $concert_id = $_GET['id'];

    // Get details of the selected concert
    $sql = "SELECT * FROM tblconcert WHERE concertid = $concert_id";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch data
        $concert_data = mysqli_fetch_assoc($result);
    } else {
        echo "Error: Concert not found.";
        exit();
    }
} else {
    //Empty form
    $concert_data = array();
}
?>

<style>
    <?php include 'css/LoudWave.css'; ?>
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
            <input type="text" class="form-control form-control-md" name="name_text" placeholder="Concert Name" value="<?php echo isset($concert_data['concert_name']) ? $concert_data['concert_name'] : ''; ?>" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Concert Date *</label>
            <input type="date" class="form-control form-control-md" name="date_text" value="<?php echo isset($concert_data['date']) ? $concert_data['date'] : ''; ?>" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Start Time *</label>
            <input type="time" class="form-control form-control-md" name="start_time" value="<?php echo isset($concert_data['start_time']) ? $concert_data['start_time'] : ''; ?>" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">End Time *</label>
            <input type="time" class="form-control form-control-md" name="end_time" value="<?php echo isset($concert_data['end_time']) ? $concert_data['end_time'] : ''; ?>" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Tickect Price *</label>
            <input type="number" class="form-control form-control-md" name="ticket_price" value="<?php echo isset($concert_data['ticket_price']) ? $concert_data['ticket_price'] : ''; ?>" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Concert Venue *</label>
            <select class="form-control form-control-md" name="venue_text" required>
                <option value="">Select a venue</option>
                <?php
                // Fetch all venues from the database
                $venue_query = "SELECT venueid, venue_name FROM tblvenue";
                $venue_result = mysqli_query($connection, $venue_query);

                // Loop through each venue
                while ($venue_row = mysqli_fetch_assoc($venue_result)) {
                    // Check if the current venue matches the venue of the selected concert
                    $selected = ($concert_data['venueid'] == $venue_row['venueid']) ? 'selected' : '';
                    // Output an option element with the venue name and set it as selected if it matches the venue of the selected concert
                    echo "<option value='{$venue_row['venue_name']}' $selected>{$venue_row['venue_name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <input type="submit" value="Save" name="btnconcert">
        </div>
    </form>
</body>

</html>

<?php
if (isset($_POST['btnconcert'])) {
    $name = $_POST['name_text'];
    $date = $_POST['date_text'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $venue_text = $_POST['venue_text'];
    $ticket_price = $_POST['ticket_price'];
    

    // Retrieve venue ID
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
    // Check if concert ID is set for updating existing record
    if ($concert_id !== null) {
        // Check if there's a conflicting concert during the update
        $check_query = "SELECT * FROM tblconcert WHERE venueid = ? AND date = ? AND ((start_time >= ? AND start_time < ?) OR (end_time > ? AND end_time <= ?)) AND concertid != ?";
        if ($check_stmt = mysqli_prepare($connection, $check_query)) {
            mysqli_stmt_bind_param($check_stmt, "isssiii", $venueid, $date, $start_time, $end_time, $start_time, $end_time, $concert_id);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);

            if (mysqli_stmt_num_rows($check_stmt) > 0) {
                echo "Error: There is already a concert scheduled at the selected venue and overlapping date/time.";
                exit();
            }
            mysqli_stmt_close($check_stmt);
        } else {
            echo "Error: Failed to prepare check query.";
            exit();
        }

        // Update the existing record
        $update_query = "UPDATE tblconcert SET concert_name=?, date=?, start_time=?, end_time=?, venueid=? WHERE concertid=?";
        if ($update_stmt = mysqli_prepare($connection, $update_query)) {
            mysqli_stmt_bind_param($update_stmt, "ssssii", $name, $date, $start_time, $end_time, $venueid, $concert_id);
            if (mysqli_stmt_execute($update_stmt)) {
                echo "<script language='javascript'> alert('Record updated successfully.'); window.location.replace('concert.php?id=$concert_id');</script>";
                exit();
            } else {
                echo "Error: " . mysqli_error($connection);
            }
            mysqli_stmt_close($update_stmt);
        } else {
            echo "Error: Failed to prepare update statement.";
            exit();
        }
    } else {
        // Insert new record if concert ID is not set
        $check_query = "SELECT * FROM tblconcert WHERE venueid = ? AND date = ? AND ((start_time >= ? AND start_time < ?) OR (end_time > ? AND end_time <= ?))";
        if ($check_stmt = mysqli_prepare($connection, $check_query)) {
            mysqli_stmt_bind_param($check_stmt, "isssii", $venueid, $date, $start_time, $end_time, $start_time, $end_time);
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

        $insert_query = "INSERT INTO tblconcert (concert_name, date, start_time, end_time, ticket_price, tickets_sold, venueid) VALUES (?, ?, ?, ?, ?, 0, ?)";
        if ($insert_stmt = mysqli_prepare($connection, $insert_query)) {
            mysqli_stmt_bind_param($insert_stmt, "ssssii", $name, $date, $start_time, $end_time, $ticket_price, $venueid);
            if (mysqli_stmt_execute($insert_stmt)) {
                $last_id = mysqli_insert_id($connection);
                echo "<script language='javascript'> alert('New record saved.'); window.location.replace('manageconcerts.php?id=$last_id');</script>";
                exit();
            } else {
                echo "Error: " . mysqli_error($connection);
            }
            mysqli_stmt_close($insert_stmt);
        } else {
            echo "Error: Failed to prepare insert statement.";
        }
    }
}
?>
