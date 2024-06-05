<?php
require "./config/connection.php";

// mencari produk berdasarkan keyword
if (isset($_GET['keyword'])) {
    $stmt = $conn->prepare("SELECT * FROM produk WHERE nama LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("s", $_GET['keyword']);
    $stmt->execute();
    $queryProduk = $stmt->get_result();
}

// mencari produk berdasarkan kategori
else if (isset($_GET['kategori'])) {
    $stmt = $conn->prepare("SELECT id FROM kategori WHERE nama = ?");
    $stmt->bind_param("s", $_GET['kategori']);
    $stmt->execute();
    $result = $stmt->get_result();
    $kategori_id = $result->fetch_array();
    $stmt = $conn->prepare("SELECT * FROM produk WHERE kategori_id = ?");
    $stmt->bind_param("i", $kategori_id['id']);
    $stmt->execute();
    $queryProduk = $stmt->get_result();
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
    <title>Dashboard</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="./resource/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .card a {
            color: #000;
            text-decoration: none;
        }

        .container {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .kategori a {
            margin-bottom: 15px;
        }

        .navbar,
        .footer {
            margin-bottom: 20px;
        }

        .image_box {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .image_box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .carousel-item {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            overflow: hidden;
        }

        .carousel-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <!-- include navbar -->
    <?php require "navbar.php"; ?>

    <!-- corousel -->
    <div class="container">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $directory = './data/img-iklan/';
                $images = glob($directory . '*.jpg'); // Mengambil semua file .jpg
                $active = true;
                foreach ($images as $image) {
                    $isActive = $active ? 'active' : '';
                    echo '<div class="carousel-item ' . $isActive . '">';
                    echo '<img src="' . $image . '" class="d-block w-100" alt="...">';
                    echo '</div>';
                    $active = false; // Hanya item pertama yang aktif
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Kategori -->
    <div class="container kategori ">
        <h4 class="mb-5 mt-5 text-center">Kategori</h4>
        <div class="row">
            <?php
            $query = "SELECT * FROM kategori";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-2">';
                echo '<a class="btn btn-info w-100 text-white" href="./produk.php?produk=' . $row['nama'] . '">' . $row['nama'] . '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Produk -->
    <div class="container">
        <h4 class="text-center mt-5 mb-5">Daftar Produk</h4>
        <div class="row">
            <?php if ($HitungData < 1) {
                // Jika Produk Tidak Tersedia 
            ?>
                <h6 class="text-center mb-5">Produk Tidak Tersedia</h6>
            <?Php
            }
            ?>

            <!-- Tampilan Produk -->
            <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <a href="detail-produk.php?p=<?php echo $produk['id']; ?>">
                            <div class=" image_box">
                                <img src="./data/img-produk/<?php echo htmlspecialchars($produk['foto'], ENT_QUOTES, 'UTF-8') ?>" class="card-img-top" alt="Foto Produk">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($produk['nama'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                <p class="card-price fw-bold">Rp <?php echo number_format($produk['harga']); ?></p>
                                <p class="card-stok"><?php echo "Stok ";
                                                        echo $produk['stok']; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <?php require "./view/footer.php"; ?>

    <!-- include js bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./resource/js/script.js"></script>
</body>

</html>