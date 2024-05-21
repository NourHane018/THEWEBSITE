<?php 
include('inc/connections.php');
if(isset($_POST['resetpassword'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $check_email = "SELECT * FROM `users` WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_email);
    $num_rows = mysqli_num_rows($check_result);
    if($num_rows == 0){
        $email_error = '<p id="error">Sorry, the email you entered does not exist. Please try again.</p>';
        
    }else{
        require_once('mail.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resetpassword</title>
</head>
<body>
    <form method="POST">

    <div>
    <?php if(isset($email_error)){
    echo $email_error;
}  ?>

        <input type="email" name="email" placeholder="email" required ><br><br>
        <button type="submit" name="resetpassword" >send me message</button>
    </div>
    </form>



</body>
</html>
