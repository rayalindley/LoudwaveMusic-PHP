<?php
    include 'connect.php';
    session_start(); // Start session to use session variables
 
    if(isset($_GET['id'])) {
        $concertID = $_GET['id'];
       
        // Fetch concert details from the database based on concertID
        $query = "SELECT * FROM tblconcert WHERE concertID = $concertID";
        $result = mysqli_query($connection, $query);
       
        if(mysqli_num_rows($result) > 0) {
            $concert = mysqli_fetch_assoc($result);
            // Store concertID in session variable for later use
            $_SESSION['concertID'] = $concertID;
        }    
    } else {
        //show empty form
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Address Selector - Philippines</title>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="p-5">
    <form method="post">
        
    <div class="col-sm-6">
            <h3>Concert Details</h3>
        </div>
        <hr>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Concert Name *</label>
            <input type="text" class="form-control form-control-md" name="name_text" id="name-text" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Concert Date *</label>
            <input type="datetime-local" class="form-control form-control-md" name="date_text" id="date-text" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Region *</label>
            <select name="region" class="form-control form-control-md" id="region"></select>
            <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">Province *</label>
            <select name="province" class="form-control form-control-md" id="province"></select>
            <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label">City / Municipality *</label>
            <select name="city" class="form-control form-control-md" id="city"></select>
            <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="street-text" class="form-label">Street (Optional)</label>
            <input type="text" class="form-control form-control-md" name="street_text" id="street-text">
        </div>
        <div class="col-md-6">
        <input type="submit" value="Add Concert" name="btnconcert">
        </div>
    </form>
</body>
</html>

<script src="js/ph-address-selector.js" defer></script>

<?php	 
	if(isset($_POST['btnconcert'])){
        $name = $_POST['name_text'];
        $date = $_POST['date_text'];
        $region = $_POST['region_text'];
        $province = $_POST['province_text'];
        $city = $_POST['city_text'];
        $street = $_POST['street_text'];
     
        $checkQuery = "SELECT * FROM tblconcert WHERE name = '$name'";
        $checkResult = mysqli_query($connection, $checkQuery);
     
        if(mysqli_num_rows($checkResult) == 0){
            $insertQuery = "INSERT INTO tblconcert (name, datetime, region, province, city, street)
                            VALUES ('$name', '$date', '$region', '$province', '$city', '$street')";
            mysqli_query($connection, $insertQuery);
            echo "<script language='javascript'> alert('New record saved.'); </script>";
        } else {
            echo "<script language='javascript'> alert('Concert already exists.'); </script>";
        }
    }
?>