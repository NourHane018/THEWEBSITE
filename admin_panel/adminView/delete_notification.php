<?php
// Include database connection
include_once "../inc/connections.php";

// Check if notification ID is provided in the URL
if(isset($_GET['id'])) {
    $notification_id = $_GET['id'];

    // Delete the notification from the database
    $sql = "DELETE FROM notifications WHERE id = $notification_id";
    if(mysqli_query($conn, $sql)) {

    } else {
        echo "Error deleting notification: " . mysqli_error($conn);
    }
} else {
    echo "Notification ID not provided.";
}
?>
