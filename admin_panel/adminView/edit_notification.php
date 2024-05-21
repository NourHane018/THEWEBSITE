<?php
include_once "../inc/connections.php";

// Check if notification ID is provided in the URL
if(isset($_GET['id'])) {
    $advertisement_id = $_GET['id'];

    // Retrieve notification details from the database
    $sql = "SELECT * FROM notifications WHERE id = $advertisement_id";
    $result = mysqli_query($conn, $sql);

    // Check if the notification exists
    if(mysqli_num_rows($result) > 0) {
        $advertisement = mysqli_fetch_assoc($result);
    } else {
        echo "notification not found.";
        exit;
    }
} else {
    echo "notification ID not provided.";
    exit;
}

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve notification details from the form submission
    $title = $_POST['title'];
    $content = $_POST['content'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Update the notification in the database
    $sql = "UPDATE notifications SET title = '$title', content = '$content', start_date = '$start_date', end_date = '$end_date' WHERE id = $advertisement_id";
    if(mysqli_query($conn, $sql)) {
        echo "<div style='color:#315467 ; width: 100%;font-size: larger; text-align: center; margin-top: 20px' >Notification updated successfully.</div>";
    } else {
        echo "Error updating notification: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notification</title>
    
    <link rel="stylesheet" href="add.css">
    <style>
    
    .bluebox {
      width: 340px;
      height: 600px;
      top: -13%;
    }
    .welcome {
      width: 690px;
      height: 450px;
      top: 20%;
     
    }
    </style>
</head>
<body>
<div class="container">
  <div class="welcome">
    <div class="bluebox">
      <div class="signin">
        <h1>Edit Notification</h1>


<form method="post">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="<?php echo $advertisement['title']; ?>"><br>
    <label for="content">Content:</label><br>
    <textarea id="content" name="content"><?php echo $advertisement['content']; ?></textarea><br>
    <label for="start_date">Start Date:</label><br>
    <input type="date" id="start_date" name="start_date" value="<?php echo $advertisement['start_date']; ?>"><br>
    <label for="end_date">End Date:</label><br>
    <input type="date" id="end_date" name="end_date" value="<?php echo $advertisement['end_date']; ?>"><br><br>
    <button type="submit">Update Notification</button>
    
</form>

</div>
    </div>
    <div class="rightbox">
      <h2 class="title"><span>Therap</span>Ease</h2>
      
      <img class="imag" src="Autism-bro.svg"/>
      <p class="account">Return to Control Page</p>
      <button class="button" onclick="window.location.href='../admin.php';">Back</button>
    </div>
    </div>
 </div>

</div>
</body>

</html>
