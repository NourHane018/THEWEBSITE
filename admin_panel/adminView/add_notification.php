<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>

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
        <h1>Add New Notifications</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" ><br><br>
    
    <label for="content" class="Content">Content:</label>
    <textarea id="content" name="content" ></textarea><br><br>
    
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" ><br><br>
    
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" ><br><br>
    <button type="submit" name="submit" class="button submit">Add Notification</button>
    

    
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

<?php
// Include database connection
include_once "../inc/connections.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Insert notification into database
    $sql = "INSERT INTO notifications (title, content, start_date, end_date) 
            VALUES ('$title', '$content', '$start_date', '$end_date')";

    if (mysqli_query($conn, $sql)) {
      echo "<div style='color:#315467; width: 100%; font-size: larger; text-align: center; margin-top: -540px;'>Notification added successfully.</div>";

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


</body>
</html>
