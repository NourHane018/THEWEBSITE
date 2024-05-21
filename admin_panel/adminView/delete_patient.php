<?php
// Include database connection
include_once "../inc/connections.php";

// Check if patient ID is provided in the URL
if(isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    // Delete patient from the database
    $sql = "DELETE FROM users WHERE id = $patient_id";
    if ($conn->query($sql) === TRUE) {
       
        // echo "Patient deleted successfully";
    } else {
        echo "Error deleting patient: " . $conn->error;
    }
} else {
    echo "Patient ID not provided.";
}
?>