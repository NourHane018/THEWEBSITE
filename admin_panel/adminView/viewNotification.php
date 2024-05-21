<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    
    <title>Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            padding: 1rem;
        }
        h2 {
            margin-bottom: 20px;
        }
        .notification-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .notification {
            width: calc(33.33% - 20px);
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .notification:hover {
            transform: translateY(-5px);
        }
        .notification h3 {
            margin-top: 0;
            color: #333;
        }
        .notification p {
            color: #666;
        }
        .notification-actions {
            margin-top: 15px;
            text-align: center;
            
        }
        .notification-actions a {
            display: inline-block;
            padding: 8px 16px;
            margin: 0.8rem 5px;
            border: 1px solid #315467;
            border-radius: 4px;
            background-color: #315467;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .notification-actions a:hover {
            background-color: #5dadc4;
        }
        .add-notification-button {
            margin-top: 20px;
            text-align: center;
        }
        .add-notification-button a {
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            background-color: #5dadc4;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .add-notification-button a:hover {
            background-color: #315467;
        }
        #Title{
            color:#315467;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- JavaScript for handling AJAX deletion -->
<script>
$(document).ready(function(){
    // Event handler for deleting a notification
    $('.delete-notification').click(function(e){
        e.preventDefault();
        var notificationId = $(this).data('id');
        
        // Display confirmation dialog
        var confirmation = confirm('Are you sure you want to delete this notification?');
        
        // If user confirms deletion
        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: 'adminView/delete_notification.php?id=' + notificationId,
                success: function(response){
                    $('#notification_' + notificationId).remove();
                    //alert('Notification deleted successfully.');
                },
                error: function(xhr, status, error){
                    alert('Error occurred while deleting notification.');
                    console.error(error);
                }
            });
        } else {
            // If user cancels, do nothing
            return false;
        }
    });
});
</script>

<!-- Notifications in your HTML -->
<div>
  <h2 id="Title">Notifications</h2>
  <div class="notification-container">
    
    <?php
      // Include database connection
      include_once "../inc/connections.php";

      // Retrieve notifications from database
      $sql = "SELECT * FROM notifications";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <div class="notification" id="notification_<?php echo $row['id']; ?>">
                  <h3><?php echo $row['title']; ?></h3>
                  <p><?php echo $row['content']; ?></p>
                  <p>Start Date: <?php echo date('Y-m-d', strtotime($row['start_date'])); ?></p>
                  <p>End Date: <?php echo date('Y-m-d', strtotime($row['end_date'])); ?></p>
                  <div class="notification-actions">
                      <a href="adminView/edit_notification.php?id=<?php echo $row['id']; ?>">Edit</a>
                      <a href="#" class="delete-notification" data-id="<?php echo $row['id']; ?>">Delete</a>
                  </div>
              </div>
              <?php
          }
      } else {
          echo "No notifications found.";
      }

      // Close database connection
      mysqli_close($conn);
    ?>
  </div>
</div>
<div class="add-notification-button">
    <a href="adminView/add_notification.php">Add New Notification</a>
</div>

</body>
</html>
