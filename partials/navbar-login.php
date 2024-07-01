<?php
require "./head.php";
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
        background-color: #fff;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: poppins;
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
        background-color: #FF9E00;
        border-radius: 50%;
        position: fixed;
        top: 500px;
        left: 800px;
        z-index: -1;
    }

    .circle2 {
        width: 1351px;
        height: 1351px;
        background-color: #FF9E00;
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
        background-color: #D9D9D9;
    }

    ::placeholder,
    a {
        color: #3B3B3B;
    }

    .btn.btn-login {
        background-color: #FF9E00;
        width: 273px;
        height: 54px;
        border-radius: 50px;
        font-weight: 400;
        font-size: 25px;
        margin-top: 20px;
    }

    .btn.btn-login:hover {
        background-color: #FF9E00;
        border: none;
    }

    .account {
        color: #3B3B3B;
        font-weight: 400;
        font-size: 20px;
    }

    .SignUp {
        color: #50BFE2;
        font-weight: 400;
        font-size: 20px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand px-4" href="index.php">
            <img src="../resource/img/logo_fourdeals.png" alt="Bootstrap" width="40" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item me-3 ">
                    <form class="d-flex align-items-center" method="get" action="produk.php">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Cari Barang" aria-label="pencarian" name="keyword" aria-describedby="basic-addon2" style="height: 45px;">
                        </div>
                    </form>

                </li>
                <li class="nav-item me-3 ms-3">
                    <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping" style="font-size: 1.5rem;"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3">
                    <a class="btn btn-info text-white" href="logout.php" role="button">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>