<?php
session_start();
require "../config/connection.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token,verify_status FROM users WHERE verify_token = '$token' LIMIT 1";
    $verify_query_go = mysqli_query($conn, $verify_query);
    if (mysqli_num_rows($verify_query_go) > 0) {
        $row = mysqli_fetch_assoc($verify_query_go);
        if ($row['verify_status'] == "0") {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE users SET verify_status = '1' WHERE verify_token = '$clicked_token' LIMIT 1";
            $update_query_go = mysqli_query($conn, $update_query);

            if ($update_query_go) {
                $_SESSION['status'] = "Your account has been verified succesfully";
                header('location: ../login.php');
                exit(0);
            } else {
                $_SESSION['status'] = "Verification Failed";
                header('location: ../login.php');
                exit(0);
            }
        }
    } else {
        $_SESSION['status'] = "Email Already Verified. Please Login";
        header('location: ../login.php');
    }
} else {
    $_SESSION['status'] = "Not allowed";
    header('location: ../login.php');
}
