<?php
require "session.php";
require "../config/connection.php";

$query = mysqli_query($conn, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-4">
        <ol class="breadcrumb">
            <i class="bi bi-house-door-fill me-2 "></i>
            <li class="breadcrumb-item"><a href="../AdminPanel/" class="text-decoration">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
        <div class="">
            <a href="tambah-produk.php" class="btn btn-primary">
                <i class="bi bi-plus-square"></i>
            </a>

        </div>

        <div class=" mt-3">
            <h2 class="text-center fw-bold">List Produk</h2>

            <div class="table-responsive mt-5 ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?Php
                        if ($jumlahproduk == 0) {
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">Produk tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['kategori_id']; ?></td>
                                    <td><?php echo $data['harga']; ?></td>
                                    <td><?php echo $data['ketersediaan_stok']; ?></td>
                                </tr>
                                <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>