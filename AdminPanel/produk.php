<?php
require "session.php";
require "../config/connection.php";

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
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
            <li class="breadcrumb-item"><a href="../AdminPanel/" class="text-decoration"><i
                        class="bi bi-house-door-fill me-2 "></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
        <div class="mb-3">
            <a href="tambah-produk.php" class="btn btn-primary">
                <i class="bi bi-plus-square"></i> Tambah Produk
            </a>
        </div>
        <div class="mt-3">
            <h2 class="text-center fw-bold">List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($jumlahproduk == 0) {
                            // apabila produk tidak ada
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">Produk tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            // apabila produk tersedia, maka lakukan pengulangan
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td><?php echo $data['harga']; ?></td>
                                    <td><?php echo $data['ketersediaan_stok']; ?></td>
                                    <td>
                                        <a href="produk-edit.php?p=<?php echo $data['id']; ?>" class="btn btn-primary">
                                            <i class="bi bi-zoom-in"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>