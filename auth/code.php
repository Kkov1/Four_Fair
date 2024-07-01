<?php
session_start();
require "../config/connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
function sendmail_verifiy($name, $email, $token)
{
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'four.deals04@gmail.com';
        $mail->Password = 'dpal fixl lphu ofwm';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('four.deals04@gmail.com', 'Four Deals');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verify your email';
        $email_template = "
        <h2>You are already registered in Four Deals </h2>
        <h5>Verify your email address to login with the below given link</h5>
        <br/><br/>
        <a href='http://new.test/Four_Fair/auth/verify.php?token=$token'>Verify Email</a>
        ";
        $mail->Body = $email_template;
        $mail->send();
        echo "Message has been sent";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $token = md5(rand());
    $check_email = "SELECT email FROM users WHERE email = '$email' limit 1";
    $check_email_query = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($check_email_query) > 0) {

        $_SESSION['status'] = "Email already exists";
        header('location: ../register.php');
    } else {
        $insert_user = "INSERT INTO users (name, phone, email, password, verify_token, create_at) VALUES ('$name', '$phone', '$email', '$password', '$token', NOW())";
        $insert_user_query = mysqli_query($conn, $insert_user);
        if ($insert_user_query) {
            sendmail_verifiy($name, $email, $token);
            $_SESSION['status'] = "Registration successful";
            header('location: ../register.php');
        } else {
            $_SESSION['status'] = "Registration failed";
            header('location: register.php');
        }
    }
}
