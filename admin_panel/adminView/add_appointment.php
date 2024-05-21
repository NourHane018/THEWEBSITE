

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
 <link rel="stylesheet" href="add.css">
</head>
<body>
    <div class="container">
  <div class="welcome">
    <div class="bluebox">
      <div class="signin">
        <h1>Add New Appointment</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="patient_name">Patient Name:</label>
        <select id="patient_name" name="patient_name" required>
            <?php
            // Include database connection
            include_once "../inc/connections.php";

            // Query to retrieve patient names and ids from the user table
            $sql = "SELECT id, username FROM users";
            $result = $conn->query($sql);

            // Check if there are any patients
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["username"] . "</option>";
                }
            }
            ?>
        </select><br><br>
        
        <label for="appointment_datetime">Appointment Date and Time:</label>
        <input type="datetime-local" id="appointment_datetime" name="appointment_datetime" required><br><br>
        
        <button type="submit"  class="button submit">Add Appointment</button>
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Escape user inputs for security
            $patient_id = mysqli_real_escape_string($conn, $_POST['patient_name']);
            $appointment_datetime = mysqli_real_escape_string($conn, $_POST['appointment_datetime']);

            // Insert appointment details into appointments table
            $sql = "INSERT INTO appointments (patient_name, appointment_date, status, user_id) 
                    VALUES (
                        (SELECT username FROM users WHERE id = '$patient_id'),
                        '$appointment_datetime',
                        'Scheduled', 
                        '$patient_id'
                    )";

            if(mysqli_query($conn, $sql)){
                   echo "
                   <p style='color:#315467; width: 100%; font-size: larger; text-align: center; margin-top: -32.2rem;
                                   '>Appointment added successfully.</p>";                
                
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
            
            // Close the database connection
            mysqli_close($conn);
        }
        ?>
    
    

    
</body>

</html>


   