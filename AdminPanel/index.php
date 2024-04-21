<?php
require "session.php";
require "../config/connection.php";

$queryKategori = mysqli_query($conn , "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($conn , "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <style>
        .text-decoration {
            text-decoration: none;
        }

        .summary-kategori {
            background-color: #5ec718;
            border-radius: 10px;
        }

        .summary-produk {
            background-color: #e85e1a;
            border-radius: 10px;
        }

        blue-hover:hover {
            background-color: #000;
        }
    </style>
</head>

<body>
    <?php require "navbar.php";?>
    <div class="container mt-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="bi bi-house-door-fill me-2 "></i>
                <li class="breadcrumb-item"><a href="#" class="text-decoration">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav>
        <div class="mt-3 text-success">
            <h1>Hello <?php echo $_SESSION['username']; ?></h1>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-4 ">
                    <div class="summary-kategori p-4">
                        <div class="row">
                            <div class="col-6">
                                <i class="bi bi-database mx-5 text-white" style="font-size: 5rem;"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
                                <p><a href="kategori.php" class="text-white text-decoration ">lihat
                                        detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="summary-produk p-4">
                        <div class="row">
                            <div class="col-6">
                                <i class="bi bi-box-seam mx-5 text-white" style="font-size: 5rem;"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4"><?php echo $jumlahProduk?> Produk</p>
                                <p><a href="Produk.php" class="text-white text-decoration ">lihat
                                        detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>