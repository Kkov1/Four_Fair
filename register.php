<?php
session_start();
$page_title = "Register";
if (isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You are already logged in";
    header("Location: ./view/");
    exit(0);
}
$page_title = "Login";
require './partials/head.php';
?>

<?php
if (isset($_SESSION['status'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['status'] . "</div>";
    unset($_SESSION['status']);
}
?>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap");

    body {
        background-color: #fff;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Plus Jakarta Sans", sans-serif;
    }

    .card {
        width: 600px;
        height: 500px;
        padding: 2rem;
        border-radius: 10px;
        position: fixed;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    form h2 {
        font-weight: 700;
        font-size: 48px;
    }

    .circle {
        width: 1351px;
        height: 1351px;
        background-color: #ff9e00;
        border-radius: 50%;
        position: fixed;
        top: 500px;
        left: 800px;
        z-index: -1;
    }

    .circle2 {
        width: 1351px;
        height: 1351px;
        background-color: #ff9e00;
        border-radius: 50%;
        position: fixed;
        top: -981px;
        left: -689px;
        z-index: -1;
    }

    img {
        position: fixed;
        bottom: 0;
        left: 20px;
    }

    .Logo {
        position: fixed;
        top: 0;
        left: 1135px;
    }

    .form-control {
        width: 530px;
        height: 53px;
        background-color: #d9d9d9;
    }

    ::placeholder,
    a {
        color: #3b3b3b;
    }

    .btn.btn-login {
        background-color: #ff9e00;
        width: 273px;
        height: 54px;
        border-radius: 50px;
        font-weight: 400;
        font-size: 25px;
        margin-top: 20px;
    }

    .btn.btn-login:hover {
        background-color: #ff9e00;
        border: none;
    }

    .account {
        color: #3b3b3b;
        font-weight: 400;
        font-size: 20px;
    }

    .SignUp {
        color: #50bfe2;
        font-weight: 400;
        font-size: 20px;
    }
</style>
<img src="./resource/img/logofourdeals smk4.png" alt="LoginFourdeal" width="253" height="95" class="Logo">
<div class="circle"></div>
<div class="circle2"></div>
<img src="./resource/img/gambarLogin.png" alt="gambarLogin" width="300" height="200">
<div class="container d-flex justify-content-center align-items-center">
    <div class="card border-0 shadow" style="height: 75vh;">
        <form method="POST" action="./auth/code.php" class="form-group">
            <div class="mb-3">
                <h2 class="text-center">Log In</h2>
                <label class="form-label mt-4"></label>
                <input type="input" class="form-control rounded-pill" placeholder="Name" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label"></label>
                <input type="phone" class="form-control rounded-pill" placeholder="Phone" name="phone">
            </div>
            <div class="mb-3">
                <label class="form-label"></label>
                <input type="email" class="form-control rounded-pill" placeholder="Email" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label"></label>
                <input type="password" class="form-control rounded-pill" placeholder="Password" name="password">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-login" name="register_btn">Register</button>
                <p class="account mt-4">Dont have a account?<a href="./login.php" class="SignUp p-2 text-decoration-none">SignUp.</a></p>
            </div>
        </form>
    </div>
</div>
<?php
require "./partials/body.php";
?>