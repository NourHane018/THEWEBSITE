<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
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

<?php
// Include database connection
include_once "../inc/connections.php";



// Check if patient ID is provided in the URL
if(isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $username = $_POST['username'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];

        
        $sql = "UPDATE users SET username='$username', email='$email', birthday='$birthday', gender='$gender' WHERE id=$patient_id";
        if ($conn->query($sql) === TRUE) {
           
          echo "<div style='color:#315467; width: 100%; font-size: larger; text-align: center; margin-top: 20px;'>Patient details updated successfully.</div>";
            
            
        } else {
            echo "Error updating patient details: " . $conn->error;
        }
    }

   
    $sql = "SELECT * FROM users WHERE id = $patient_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        $patient = $result->fetch_assoc();
?>
<div class="container">
  <div class="welcome">
    <div class="bluebox">
      <div class="signin">
        <h1>Edit Patient</h1>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $patient['username']; ?>"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $patient['email']; ?>"><br><br>
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" value="<?php echo $patient['birthday']; ?>"><br><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="male" <?php if($patient['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if($patient['gender'] == 'female') echo 'selected'; ?>>Female</option>
        </select><br><br>
        <button type="submit">Update</button>
       
        
    </form>
    <?php
    } else {
        echo "Patient not found.";
    }
} else {
    echo "Patient ID not provided.";
}
?>
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

</script>
</body>
</html>
