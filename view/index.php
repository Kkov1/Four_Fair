<?php
require "../config/connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .card a {
            color: #000;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- include navbar -->
    <?php require "navbar-user.php"; ?>


    <!-- corousel -->
    <div class="container">
        <!-- isi corousel -->
    </div>


    <!-- Kategori -->
    <div class="container">
        <h4>Kategori</h4>
        <div class="row mt-2">
            <div class="col-md-3 mb-3">
                <a class="btn w-100 btn-primary" href="produk.php?kategori=RPL">RPL</a>
            </div>
            <div class="col-md-3 mb-3">
                <a class="btn w-100 btn-danger" href="produk.php?kategori=MESIN">MESIN</a>
            </div>
            <div class="col-md-3 mb-3">
                <a class="btn text-white w-100 btn-warning" href="produk.php?kategori=LISTRIK">LISTRIK</a>
            </div>
            <div class="col-md-3 mb-3">
                <a class="btn w-100 btn-success" href="produk.php?kategori=SIPIL">SIPIL</a>
            </div>
        </div>
    </div>


    <!-- Produk -->
    <div class="container">
        <h4>Produk RPL</h4>
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="card">
                        <a href="">
                            <div class="image_box">
                                <img src=" ../resource/img/pzsw67ziaa75vDfy8S6E.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Judul</h5>
                                <p class="card-price">Rp.</p>
                                <p class="card-stok">tersedia/tidak</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <?php require "footer.php"; ?>


    <!-- include js bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="../resource/js/script.js"></script>
</body>

</html>