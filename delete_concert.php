<?php
include 'connect.php';

if(isset($_GET['id'])) {
    $concert_id = $_GET['id'];

    // Update isDeleted to true
    $delete_query = "UPDATE tblconcert SET isDeleted = 1 WHERE concertid = ?";
    $delete_stmt = mysqli_prepare($connection, $delete_query);
    
    if ($delete_stmt) {
        mysqli_stmt_bind_param($delete_stmt, "i", $concert_id);
        
        if (mysqli_stmt_execute($delete_stmt)) {
            echo "<script>alert('Concert deleted successfully.');</script>";
        } else {
            echo "<script>alert('Failed to delete concert.');</script>";
        }
    }
}

echo "<script>window.location = 'manageconcerts.php';</script>";
?>
