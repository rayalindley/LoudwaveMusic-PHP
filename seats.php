<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Movie Seat Booking</title>
  <link rel="stylesheet" href="seat/style.css" />
</head>
<body>
  <a href="index.php">Back</a>
  <h1>SYNK: Parallel Line</h1>
  <div class="container">
    <div class="screen"></div>
    <ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>N/A</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected</small>
      </li>
      <li>
        <div class="seat occupied"></div>
        <small>Occupied</small>
      </li>
    </ul>
    <?php
    // Include database connection
    include 'connect.php';

    // Define concert ID
    $concertId = 12; // Example concert ID, replace with your actual variable or value

    // Fetch booked seat data from the database
    $sql = "SELECT booked_seats_data FROM tblbooked_seats WHERE concert_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $concertId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch booked seat data as associative array
    $bookedSeatData = array();
    if ($row = $result->fetch_assoc()) {
        $bookedSeatData = json_decode($row['booked_seats_data'], true); // Directly decode to a 2D array
    }

    // Define the number of rows and seats per row
    $numRows = count($bookedSeatData);
    $seatsPerRow = count($bookedSeatData[0]);

    // Generate the seat layout based on the booked seat data
    for ($rowIndex = 0; $rowIndex < $numRows; $rowIndex++) {
        echo "<div class='row'>";
        for ($seatIndex = 0; $seatIndex < $seatsPerRow; $seatIndex++) {
            $seatClass = $bookedSeatData[$rowIndex][$seatIndex] ? 'occupied' : '';
            echo "<button class='seat $seatClass' title='Seat $rowIndex-$seatIndex'></button>";
        }
        echo "</div>";
    }
    ?>
  </div>
  <p class="text">
    You have selected <span id="count">0</span> seats for a price of ₱<span id="total">0</span>
  </p>
  <button id="updateButton">Buy Tickects</button>
  <script src="js/seats.js"></script>
</body>
</html>