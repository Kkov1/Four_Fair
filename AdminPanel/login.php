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
    <style>
        .login-box {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center login-box">
            <form action="" method="post">
                <div class="card shadow ">
                    <h2 class="card-title text-center mt-3 ">Login</h2>
                    <div class="px-5 mb-3 ">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="px-5 mb-3 ">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="d-flex justify-content-center ">
                        <button type="submit" name="login-btn" class="btn btn-success mb-3">Login</button>
                    </div>
                </div>
                <div>
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
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</body>

</html>