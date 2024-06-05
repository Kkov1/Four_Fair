<?php
require "./config/connection.php";

// mencari produk berdasarkan keyword
if (isset($_GET['keyword'])) {
    $stmt = $conn->prepare("SELECT * FROM produk WHERE nama LIKE ?");
    $likeKeyword = '%' . $_GET['keyword'] . '%';
    $stmt->bind_param("s", $likeKeyword);
    $stmt->execute();
    $queryProduk = $stmt->get_result();
    $stmt->close(); // Menutup statement setelah digunakan
}

// mencari produk berdasarkan kategori
else if (isset($_GET['kategori'])) {
    $stmt = $conn->prepare("SELECT id FROM kategori WHERE nama=?");
    $stmt->bind_param("s", $_GET['kategori']);
    $stmt->execute();
    $stmt->bind_result($kategori_id);
    $stmt->fetch();
    $stmt->close(); // Menutup statement setelah digunakan

    $stmt = $conn->prepare("SELECT * FROM produk WHERE kategori_id=?");
    $stmt->bind_param("s", $kategori_id);
    $stmt->execute();
    $queryProduk = $stmt->get_result();
    $stmt->close(); // Menutup statement setelah digunakan
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
    <link rel="stylesheet" href="./resource/css/main.css">
    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
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
    <?php require "./navbar.php"; ?>

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
                        <a href="detail-produk.php?p=<?php echo $produk['id']; ?>">
                            <div class=" image_box">
                                <img src="./data/img-produk/<?php echo $produk['foto'] ?>" class="card-img-top" alt="Foto Produk">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($produk['nama']); ?></h5>
                                <p class="card-price fw-bold">Rp <?php echo number_format($produk['harga']); ?></p>
                                <p class="card-stok"><?php echo "Stok ";
                                                        echo htmlspecialchars($produk['stok']); ?></p>
                            </div>
                        </a>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>