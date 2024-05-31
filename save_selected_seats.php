<?php
// Include database connection
include 'connect.php';

// Read the JSON file
$jsonData = file_get_contents('bookedSeatData.json');

// Decode the JSON data
$bookedSeatData = json_decode($jsonData, true);

// Prepare and execute SQL insert statements
foreach ($bookedSeatData as $concertId => $seats) {
    // Escape and serialize seats data
    $seatsData = mysqli_real_escape_string($connection, json_encode($seats)); // Encode as JSON
    
    // Prepare the SQL statement with a prepared statement
    $sql = "INSERT INTO tblbooked_seats (concert_id, booked_seats_data) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("is", $concertId, $seatsData);
    
    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error inserting data for concert ID $concertId: " . $stmt->error;
    }
    $stmt->close(); // Close the prepared statement
}

// Close database connection
$connection->close();

echo "Data inserted successfully!";
?>
