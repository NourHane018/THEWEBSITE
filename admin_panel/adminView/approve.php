<?php
include_once "../inc/connections.php";

// Check if the ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize and validate the ID parameter
    $id = intval($_GET['id']);
    
    // Update the status of the user with the given ID to 'approved'
    $sql = "UPDATE users SET status = 'approved' WHERE id = $id";
    if(mysqli_query($conn, $sql)) {
       
        // echo "User approved successfully";
    } else {
        // If there was an error with the query, return an error message
        echo "Error updating status: " . mysqli_error($conn);
        exit(); 
    }
} else {
    // If the ID parameter is not set in the URL, return an error message
    echo "ID parameter is missing!";
    exit(); 
}
?>
