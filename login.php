<?php
session_start();
if (isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You are already logged in";
    header("Location: ./view/");
    exit(0);
}
$page_title = "Login";
if (isset($_SESSION['status'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['status'] . "</div>";
    unset($_SESSION['status']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="./resource/css/frontend/login.css">
    <style>
        .login-box {
            height: 100vh;
        }
    </style>
</head>
<img src="./resource/img/logofourdeals smk4.png" alt="LoginFourdeal" width="253" height="95" class="Logo">
<div class="circle"></div>
<div class="circle2"></div>
<img src="./resource/img/gambarLogin.png" alt="gambarLogin" width="300" height="200">
<div class="container d-flex justify-content-center align-items-center">
    <div class="card border-0 shadow">
        <form method="POST" action="./auth/logincode.php" class="form-group">
            <div class="mb-3">
                <h2 class="text-center">Log In</h2>
                <label class="form-label mt-4"></label>
                <input type="input" class="form-control rounded-pill" placeholder="Email" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label"></label>
                <input type="password" class="form-control rounded-pill" placeholder="Password" name="password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-login" name="login-btn">Log In</button>
                <p class="account mt-4">Dont have a account?<a href="./register.php" class="SignUp p-2 text-decoration-none">SignUp.</a></p>
            </div>
        </form>
    </div>
</div>
<?php
require "./partials/body.php";
?>