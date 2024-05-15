<?php
require "session.php";
require "../config/connection.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>

    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php require "navbar.php"; ?>
    <div class="container mt-4">
        <h3>Tambah Kategori</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" id="kategori" name="kategori" placeholder="Input Nama Kategori"
                            class="form-control">
                    </div>
                    <button class="btn btn-primary mt-3" type="submit" name="simpan">Simpan</button>
                </form>
                <?php
                if (isset($_POST['simpan'])) {
                    // apabila button simpan dipencet
                    $kategori = htmlspecialchars($_POST['kategori']);

                    $namasama = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama = '$kategori'");
                    $jumlahkategoribaru = mysqli_num_rows($namasama);

                    if ($jumlahkategoribaru > 0) {
                        // apabila nama kategori sudah ada maka muncul alert
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama Kategori Sudah Ada
                        </div>
                        <?php
                    } else {
                        // apabila semua terpenuhi, buat query simpan ke tabel kategori
                        $simpankategori = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                        if ($simpankategori) {
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Data Berhasil Disimpan
                            </div>
                            <?php
                            header("Refresh: 1; URL=kategori.php");
                            exit();

                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>