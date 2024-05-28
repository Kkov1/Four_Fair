<?php
require "../config/connection.php";

// mencari produk berdasarkan keyword
if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%" . $_GET['keyword'] . "%'");
}

// mencari produk berdasarkan kategori
else if (isset($_GET['kategori'])) {
    $queryGetKategoriId = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='" . $_GET['kategori'] . "'");
    $kategori_id = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='" . $kategori_id['id'] . "'");

}

// mencari produk dengan default
else {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}

$HitungData = mysqli_num_rows($queryProduk);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .card a {
            color: #000;
            text-decoration: none;
        }

        .image_box {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .image_box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
        }

        .card-price,
        .card-stok {
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php require "navbar-user.php"; ?>

    <div class="container">
        <h2 class="text-center">Produk</h2>
        <div class="row">
            <?php if ($HitungData < 1) {
                // Jika Produk Tidak Tersedia 
                ?>
                <h6 class="text-center">Produk Tidak Tersedia</h6>
                <?Php
            }
            ?>

            <!-- Tampilan Produk -->
            <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <a href="detail-produk.php">
                            <div class="image_box">
                                <img src="../resource/img/<?php echo $produk['foto'] ?>" class="card-img-top"
                                    alt="Foto Produk">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                                <p class="card-price fw-bold">Rp. <?php echo number_format($produk['harga']); ?></p>
                                <p class="card-stok"><?php echo $produk['ketersediaan_stok'] ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>