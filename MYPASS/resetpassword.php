<?php 
include('inc/connections.php');

if(isset($_POST['newpassword'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Check if reset_token is set before accessing it
    if(isset($_POST['reset_token']) && !empty($_POST['reset_token'])) {
        $reset_token = $_POST['reset_token'];
        $md5_pass = md5($password);
        $check_email_query = "SELECT * FROM `users` WHERE `email` = '$email' AND `reset_token` = '$reset_token'";
    
        $check_email_result = mysqli_query($conn, $check_email_query);
    
        if(mysqli_num_rows($check_email_result)) {
           
            $update_password_query = "UPDATE `users` SET `password` = '$password', `md5_pass` = '$md5_pass' WHERE `email` = '$email' AND `reset_token` = '$reset_token'";
            $result = mysqli_query($conn, $update_password_query);
    
            if ($result) {
                echo "Password updated successfully.";
            } else {
                echo  "An error occurred while updating the password: " . mysqli_error($conn);
            }
        } else {
            echo "The email is not found in the database.";
        }
    } else {
        echo "It is not your email, try again.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET PASSWORD</title>
</head>
<body>

    <h1>Reset password</h1>
    <form  method="POST">
        <input type="email" name="email" placeholder="email" ><br><br>
   <input type="password" name="password" placeholder="New password"    > <br><br>
   <input type="text" name="reset_token" placeholder="Reset token"><br><br>
   <input type="submit" name="newpassword" value="Reset" ><br><br>
   </form>
   <a href="index.php"> log in</a>
</body>
</html>