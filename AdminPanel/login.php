<?php
session_start();
require "../config/connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../resource/css/frontend/login.css">
    <style>
        .login-box {
            height: 100vh;
        }
    </style>
</head>

<body>
    <img src="../resource/img/logofourdeals smk4.png" alt="LoginFourdeal" width="253" height="95" class="Logo">
    <div class="circle"></div>
    <div class="circle2"></div>
    <img src="../resource/img/gambarLogin.png" alt="gambarLogin" width="300" height="200">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card border-0 shadow">
            <?php
            if (isset($_POST['login-btn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $query = mysqli_query($conn, "SELECT * FROM  users WHERE username ='$username'");
                $resultD = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);
                if ($resultD > 0) {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location: ../AdminPanel');
                    } else {
            ?>
                        <div class="alert alert-warning text-center " role="alert">
                            Password Salah
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning text-center " role="alert">
                        Akun Tidak Tersedia
                    </div>
            <?php
                }
            }
            ?>
            <form method="POST" action="" class="form-group">
                <div class="mb-3">
                    <h2 class="text-center">Log In</h2>
                    <label class="form-label mt-4"></label>
                    <input type="input" class="form-control rounded-pill" placeholder="Email/No Telp" name="username">
                </div>
                <div class="mb-3">
                    <label class="form-label"></label>
                    <input type="password" class="form-control rounded-pill" placeholder="Password" name="password">
                </div>
                <p><a href="" class="text-decoration-none">Forgot Your Password?</a></p>
                <div class="text-center">
                    <button type="submit" class="btn btn-login" name="login-btn">Log In</button>
                    <!-- <p class="account mt-4">Dont have a account?<a href="" class="SignUp p-2 text-decoration-none">SignUp.</a></p> -->
                </div>
            </form>
        </div>
    </div>
</body>

</html>