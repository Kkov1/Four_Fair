<?php
require "../config/connection.php";
require "../auth/auth.php";



$id = $_GET['p'];
$stmt = $conn->prepare("SELECT produk.*, kategori.nama AS nama_kategori FROM produk LEFT JOIN kategori ON produk.kategori_id = kategori.id WHERE produk.id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_array();

if (isset($_GET['keyword'])) {
    $stmt = $conn->prepare("SELECT * FROM produk WHERE nama LIKE ?");
    $likeKeyword = '%' . $_GET['keyword'] . '%';
    $stmt->bind_param("s", $likeKeyword);
    $stmt->execute();
    $queryProduk = $stmt->get_result();
    $stmt->close();
} elseif (isset($_GET['kategori'])) {
    $stmt = $conn->prepare("SELECT id, nama FROM kategori WHERE nama=?");
    $stmt->bind_param("s", $_GET['kategori']);
    $stmt->execute();
    $stmt->bind_result($kategori_id);
    $stmt->fetch();
    $stmt->close();

    $stmt = $conn->prepare("SELECT * FROM produk WHERE kategori_id=?");
    $stmt->bind_param("s", $kategori_id);
    $stmt->execute();
    $queryProduk = $stmt->get_result();
    $stmt->close();
} else {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}

$HitungData = mysqli_num_rows($queryProduk);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .harga {
            font-size: 20px;
            font-weight: bold;
        }

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

        .produk {
            position: sticky;
            top: 50px;
            border-radius: 15px;
        }


        .f-size {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <?php require "navbar-user.php"; ?>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-5">
                    <img src="../data/img-produk/<?php echo htmlspecialchars($data['foto'], ENT_QUOTES, 'UTF-8') ?>" class="img-fluid produk" alt="">
                </div>
                <div class="col-md-4 ">
                    <h1><?php echo htmlspecialchars($data['nama']); ?></h1>
                    <p class="harga">Rp <?php echo htmlspecialchars(number_format($data['harga'])); ?></p>
                    <p class="fs-5">Stok Tersedia : <strong><?php echo htmlspecialchars($data['stok']); ?></strong></p>
                    <p class="fs-6">Kategori : <strong><?php echo isset($data['nama_kategori']) ? htmlspecialchars($data['nama_kategori']) : 'Kategori tidak tersedia'; ?></strong></p>
                    <p class="fs-6 deksripsi"><?php echo htmlspecialchars($data['deskripsi']); ?></p>
                </div>
                <div class="col-md-3 ">

                    <div class="card keranjang" style="width: 18rem; position: sticky; top: 50px;">
                        <div class="card-body">
                            <h5 class="card-title">Atur jumlah</h5>
                            <br>
                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text" id="jumlahInput" class="form-control text-center" value="1" min="1" max="<?php echo htmlspecialchars($data['stok']); ?>" oninput="updateSubtotal()" disabled>
                                <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <p class="f-size">Stok Tersedia : <?php echo htmlspecialchars($data['stok']); ?></p>
                            <p class="mt-2 f-size">Subtotal : Rp <span id="subtotal"><?php echo htmlspecialchars($data['harga']); ?></span></p>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-info text-white" style="font-size: 80%;" onclick="window.location.href='./keranjang.php'">Beli Langsung</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class=" text-center mb-5 mt-5 ">Produk Yang Lain Mungkin Sesuai Dengan Anda</h2>
        <div class=" row">
            <?php if ($HitungData < 1) { ?>
                <h6 class="text-center">Produk Tidak Tersedia</h6>
            <?php } ?>
            <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <a href="detail-produk.php?p=<?php echo $produk['id']; ?>">
                            <div class="image_box">
                                <img src="../data/img-produk/<?php echo htmlspecialchars($produk['foto'], ENT_QUOTES, 'UTF-8') ?>" class="card-img-top" alt="Foto Produk">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($produk['nama']); ?></h5>
                                <p class="card-price fw-bold">Rp <?php echo number_format($produk['harga']); ?></p>
                                <p class="card-stok"><?php echo "Stok " . htmlspecialchars($produk['stok']); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <?php require "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function updateSubtotal() {
            var harga = <?php echo $data['harga']; ?>;
            var jumlah = document.getElementById('jumlahInput').value;
            var subtotal = harga * jumlah;
            document.getElementById('subtotal').textContent = subtotal.toLocaleString();
        }

        function incrementQuantity() {
            var input = document.getElementById('jumlahInput');
            var currentValue = parseInt(input.value);
            var max = parseInt(input.max);
            if (currentValue < max) {
                input.value = currentValue + 1;
                updateSubtotal(); // Memperbarui subtotal setelah mengubah jumlah
            }
        }

        function decrementQuantity() {
            var input = document.getElementById('jumlahInput');
            var currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateSubtotal(); // Memperbarui subtotal setelah mengubah jumlah
            }
        }
    </script>
    <script>
        function sendMessageToWhatsapp() {
            var nama = "<?php echo htmlspecialchars($user['nama']); ?>"; // Asumsi $user['nama'] tersedia dari session atau database
            var jumlah = document.getElementById('jumlahInput').value;
            var harga = <?php echo $data['harga']; ?>;
            var totalHarga = harga * jumlah;
            var namaProduk = "<?php echo htmlspecialchars($data['nama']); ?>";

            var urlToWhatsapp = `https://wa.me/6285711141021?text=Halo, nama saya ${nama}, saya ingin membeli ${jumlah} produk ${namaProduk} dengan harga Rp ${totalHarga.toLocaleString()}`;
            window.open(urlToWhatsapp, "_blank");
        }
    </script>

</body>

</html>