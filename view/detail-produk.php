<?php
require "../config/connection.php";
$id = $_GET['p'];
$query_produk = mysqli_query($conn, "SELECT * FROM produk WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'");
$data = mysqli_fetch_array($query_produk);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .harga {
            font-size: 20px;
            font-weight: bold;

        }
    </style>
</head>

<body>
    <?php require "navbar-user.php"; ?>

    <!-- Detail Produk -->
    <div class="contariner-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-5">
                    <img src="../resource/img/<?php echo $data['foto'] ?>" class="img-fluid" alt="">
                </div>
                <div class="col-md-6 offset-lg-1">
                    <h1><?php echo $data['nama']; ?></h1>
                    <p class="fs-5"><?php echo $data['deskripsi']; ?> </p>
                    <p class="harga">
                        Rp <?php echo number_format($data['harga']); ?>
                    </p>
                    <p class="fs-5">
                        status ketersediaan : <strong><?php echo $data['ketersediaan_stok']; ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="container-fluid py-5">

    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>