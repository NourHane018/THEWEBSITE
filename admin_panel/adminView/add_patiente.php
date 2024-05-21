<?php
// Include database connection
include_once "../inc/connections.php";

// Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}
function generateVerificationCode($length = 5) {
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

// Check if form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];

    // Generate a random password
    $password = generateRandomPassword();
    $md5_password = md5($password);

    // Generate verification code
    $email_verified_at = generateVerificationCode();

    // Set default status to 'approved'
    $sql = "INSERT INTO users (username, email, birthday, gender, password, md5_pass, isAdmin, status, email_verified_at) VALUES ('$username', '$email', '$birthday', '$gender', '$password', '$md5_password', 0, 'approved', '$email_verified_at')";

    if ($conn->query($sql) === TRUE) {
        // Output success message
        echo "<div style='color:#315467; width: 100%; font-size: larger; text-align: center; margin-top: 20px;'>
        New patient Username: $username | Password: $password added successfully.
        <a href='javascript:printContent()' style='text-decoration: none;'>
            <i class='fas fa-print' style='margin-right: 5px; color:#315467;'></i>
            <span style='font-weight: bold;'>Print</span>
        </a>
    </div>";
    } else {
        // Handle error in inserting user
        echo "Error adding patient: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="add.css">
</head>
<body>
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

<div class="container">
  <div class="welcome">
    <div class="bluebox">
      <div class="signin">
        <h1>Add New Patient</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required><br><br>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br><br>
            <button type="submit"  class="button submit">Add Patient</button>
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

 <script>
    function printContent() {
        var printUsername = '<?php echo isset($username) ? $username : "" ?>';
        var printPassword = '<?php echo isset($password) ? $password : "" ?>';
        
        var content = " patient Username: " + printUsername + " | Password: " + printPassword;
        var printWindow = window.open('', '_blank');
        printWindow.document.write(content);
        printWindow.document.close();
        printWindow.print();
    }
</script>

</body>
</html>
