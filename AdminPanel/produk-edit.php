<?php
require "session.php";
require "../config/connection.php";
$id = $_GET['p'];

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id = '" . mysqli_real_escape_string($conn, $id) . "'");
$data = mysqli_fetch_array($query);

$kategori_result = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
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
    <div class="container mt-5">
        <h2>Detail Produk</h2>
        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" value="<?Php echo $data['nama'] ?>" id="nama" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori_id" id="kategori" class="form-control">
                        <option value="<?php echo $data['kategori_id'] ?>"><?PHP echo $data['nama_kategori'] ?></option>
                        <?php while ($data_kategori = mysqli_fetch_array($kategori_result)): ?>
                            <option value="<?= $data_kategori['id'] ?>"><?= $data_kategori['nama'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" value="<?php echo $data['harga'] ?>" id="harga"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label for="CurrentFoto">Foto Produk Sekarang</label>
                    <br>
                    <img src="../resource/img/<?php echo $data['foto'] ?>" alt="Foto sekarang" width="300px">
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                        class="form-control"><?PHP echo $data['deskripsi'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="ketersediaan_stok" class="form-label">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia" <?php if ($data['ketersediaan_stok'] == 'tersedia')
                            echo 'selected'; ?>>Tersedia</option>
                        <option value="Habis" <?php if ($data['ketersediaan_stok'] == 'Habis')
                            echo 'selected'; ?>>Habis</option>
                    </select>
                </div>


                <div class="mt-3 d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                    <button class="btn btn-warning" type="submit" name="delete">Delete</button>
                </div>

                <?php
                if (isset($_POST['edit'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori_id = htmlspecialchars($_POST['kategori_id']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $deskripsi = htmlspecialchars($_POST['deskripsi']);
                    $stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../resource/img/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama == '' || $kategori_id == '' || $harga == '' || $deskripsi == '') {
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, Kategori, Harga, dan Deskripsi Wajib diisi!
                        </div>
                        <?php
                    } else {
                        $queryUpdateProduk = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori_id', nama='$nama', harga='$harga', deskripsi='$deskripsi', ketersediaan_stok='$stok' WHERE id='$id' ");

                        if ($nama_file != '') {
                            if ($image_size >= 700000) {
                                ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Ukuran file tidak boleh lebih dari 700KB!
                                </div>
                                <?php
                            } else {
                                if (!in_array($imageFileType, ['jpeg', 'jpg', 'png', 'gif'])) {
                                    ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        File harus bertipe JPEG/JPG, PNG, GIF!
                                    </div>
                                    <?php

                                } else {
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                                    $queryUpdateFoto = mysqli_query($conn, "UPDATE produk SET foto='$new_name' WHERE id='id' ");

                                    if ($queryUpdateFoto) {
                                        ?>
                                        <div class="alert alert-primary mt-3" role="alert">
                                            Data Berhasil Disimpan
                                        </div>
                                        <meta http-equiv="refresh" content="1; url=produk.php" />
                                        <?php

                                    } else {
                                        echo mysqli_error($conn);
                                    }
                                }
                            }

                        }
                    }

                }
                if (isset($_POST['delete'])) {
                    $hapus = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
                    if ($hapus) {
                        ?>

                        <div class="alert alert-primary mt-3" role="alert">
                            Data Berhasil Dihapus
                        </div>
                        <meta http-equiv="refresh" content="1; url=produk.php" />
                        <?php

                    } else {
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            <?php
                            echo mysqli_error($conn);
                            ?>
                        </div>
                        <meta http-equiv="refresh" content="1; url=produk.php" />
                        <?php
                    }
                }
                ?>
            </form>
        </div>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>