<?php
require "session.php";
require "../config/connection.php";

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
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
    <style>
        form div {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-4">
        <h3>Tambah Produk</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="pilih">Pilihlah</option>
                            <?php
                            while ($data = mysqli_fetch_array($kategori)) {
                                ?>
                                <option value="<?php echo $data['id'] ?>"><?php echo $data['nama'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Ketersediaan</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="tersedia">tersedia</option>
                            <option value="habis">habis</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <?php

                    if (isset($_POST['simpan'])) {
                        $nama = htmlspecialchars($_POST['nama']);
                        $kategori = htmlspecialchars($_POST['kategori']);
                        $harga = htmlspecialchars($_POST['harga']);
                        $deskripsi = htmlspecialchars($_POST['deskripsi']);
                        $stok = htmlspecialchars($_POST['ketersediaan_stok']);


                        $target_dir = "../resource/img";
                        $nama_file = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $nama_file;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if ($nama == '' || $kategori == '' || $harga == '' || $deskripsi == '') {
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Nama, Kategori, Harga, dan Deskripsi Wajib diisi!
                            </div>
                            <?php
                        } else {



                        }



                    }


                    ?>
                </form>
            </div>
        </div>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>