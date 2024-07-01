<?php
session_start();
require '../config/connection.php';

if (isset($_POST['login-btn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $login_result = mysqli_query($conn, $login_query);
        if (mysqli_num_rows($login_result) > 0) {
            $row = mysqli_fetch_assoc($login_result);
            if ($row['verify_status'] == 1) {
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = [
                    'username' => $row['name'],
                    'phone' => $row['phone'],
                    'email' => $row['email']
                ];
                $_SESSION['status'] = "You are Logged In Successfully";
                header("Location: ../view/index.php");
            } else {
                $_SESSION['status'] = "Please Verify Your Email to Login";
                header("Location: ../login.php");
            }
        } else {
            $_SESSION['status'] = "Email or Password is not correct";
            header("Location: ../login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All Fields are Required";
        header("Location: ../login.php");
        exit(0);
    }
}
