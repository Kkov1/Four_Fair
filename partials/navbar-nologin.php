<?php
require 'head-luar.php';
?>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap");

    body {
        margin: 0;
        padding: 0;
        font-family: "Plus Jakarta Sans", sans-serif;
        font-weight: 300;
    }

    .btn.btn-login {
        background-color: transparent;
        color: #ff9e00;
        border: 1px solid #ff9e00;
        border-radius: 10px;
        font-family: Poppins;
        font-weight: 700;
    }

    .btn.btn-login:hover {
        background-color: transparent;
        color: #ff9e00;
        border: 1px solid #ff9e00;
    }

    .btn.btn-daftar {
        background-color: #ff9e00;
        color: #ffffff;
        border: 1px solid #ff9e00;
        border-radius: 10px;
        font-family: Poppins;
        font-weight: 700;
    }

    .btn.btn-daftar:hover {
        background-color: #ff9e00;
        color: #ffffff;
        border: 1px solid #ff9e00;
    }

    @media (min-width: 768px) {
        .input-group-lg .form-control {
            width: 46.625rem;
            /* lebar untuk layar besar */
        }
    }

    @media (max-width: 767.98px) {
        .input-group-lg .form-control {
            width: 10rem;
            /* lebar untuk layar kecil */
        }
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