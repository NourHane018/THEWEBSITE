<?php
include_once "../inc/connections.php";

// Check if appointment ID is provided in the URL
if(isset($_GET['id'])) {
    $appointment_id = $_GET['id'];

    // Delete appointment from the database
    $sql = "DELETE FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        
         //echo "Appointment! deleted successfully.";
        echo json_encode(array("success" => true));
    } else {
        // Respond with error message
        echo json_encode(array("success" => false, "error" => "Error deleting appointment: " . $conn->error));
    }
    $stmt->close();
} else {
    // Respond with missing ID error message
    echo json_encode(array("success" => false, "error" => "Appointment ID not provided."));
}
?>

