<?php

require "session.php";
require "../config/connection.php";


$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");


$queryjumlahkategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>

    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php require "navbar.php"; ?>
    <div class="container mt-4">

        <ol class="breadcrumb">
            <i class="bi bi-house-door-fill me-2"></i>
            <li class="breadcrumb-item"><a href="../AdminPanel/" class="text-decoration">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kategori</li>
        </ol>

        <div class="">
            <a href="tambah-kategori.php" class="btn btn-primary">
                <i class="bi bi-plus-square"></i> Tambah Kategori
            </a>
        </div>
        <div class="mt-3">

            <h2 class="text-center fw-bold">List Kategori</h2>
            <div class="table-responsive mt-3">

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $number = 1;
                        if ($queryjumlahkategori == 0) {

                            ?>
                            <tr>
                                <td colspan="3" class="text-center">Kategori tidak tersedia</td>
                            </tr>
                            <?php
                        } else {

                            while ($data = mysqli_fetch_array($queryKategori)) {
                                ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>

                                        <a href="kategori-edit.php?p=<?php echo $data['id']; ?>" class="btn btn-primary">
                                            <i class="bi bi-zoom-in"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $number++;
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