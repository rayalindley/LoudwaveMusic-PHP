<?php
// Include database connection
include 'connect.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Define the new seating arrangement
    $newBookedSeatsData = [
        [0,0,1,1,1,0,0,0],[0,0,0,0,0,0,1,1],[0,0,0,0,0,0,1,1],[0,1,0,1,1,0,0,0],[0,0,0,0,1,0,0,0],[0,0,0,0,0,0,0,0],[0,0,0,0,1,1,0,0]
    ];

    // Encode the array to JSON
    $updatedBookedSeatsData = json_encode($newBookedSeatsData);

    // Replace with your actual concert ID
    $concertId = 12;

    // Update the database with the new booked seats data
    $updateSql = "UPDATE tblbooked_seats SET booked_seats_data = ? WHERE concert_id = ?";
    $updateStmt = $connection->prepare($updateSql);
    $updateStmt->bind_param("si", $updatedBookedSeatsData, $concertId);

    if ($updateStmt->execute()) {
        echo "Success";
    } else {
        echo "Error updating record: " . $connection->error;
    }
} else {
    echo "Invalid request method.";
}

// Close database connection
$connection->close();
?>
