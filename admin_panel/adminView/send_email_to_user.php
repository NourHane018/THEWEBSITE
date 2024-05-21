<?php
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include('../inc/connections.php');

// تأكد من وجود بيانات الطلب POST
// تأكد من وجود بيانات الطلب POST
if(isset($_POST['registrationId'])){
    $registrationId = $_POST['registrationId'];
    echo "Registration ID: $registrationId"; // Debugging statement

    // قم بتوصيل قاعدة البيانات هنا، يجب عليك تعديل هذا الجزء بناءً على كيفية توصيل قاعدة البيانات في تطبيقك
    $conn = mysqli_connect("localhost", "root", "", "therapease");

    // استعلام SQL لاسترداد عنوان البريد الإلكتروني للمستخدم
    $sql = "SELECT email FROM users WHERE id = $registrationId";
    echo "SQL Query: $sql"; // Debugging statement
    $result = mysqli_query($conn, $sql);

    // التحقق من نجاح الاستعلام
    if ($result) {
        // استخراج بيانات البريد الإلكتروني من النتيجة
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        echo "Email: $email"; // Debugging statement
        

        // Remaining code for sending email...
    


        // إرسال البريد الإلكتروني باستخدام PHPMailer
        // إعداد PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'therapeasess@gmail.com';               //SMTP username
            $mail->Password   = 'zfugqrcnhjuhmqdb';                     //SMTP password
            $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to

            //Recipients
            $mail->setFrom('therapeasess@gmail.com', 'Therap Ease');
            $mail->addAddress($email, 'Joe User');                     //Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Content
            $mail->isHTML(true);
            $mail->Subject = "You've Been Accepted to Our Website";
            $mail->Body = '<p style="color: #315467; font-size: 20px;">
            <span>Hello,</span><br><br>
            <span>We\'re pleased to inform you that you have been successfully approved to our website.</span><br><br>
            Get well soon!<br>
            <span style="font-weight: bold;">Therapease</span>
        </p>';

            // إرسال البريد الإلكتروني
            $mail->send();
            echo "Email sent successfully :)).";
            
            ob_end_flush();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to retrieve email address.";
    }
} else {
    echo "Registration ID not provided.";
}
?>
