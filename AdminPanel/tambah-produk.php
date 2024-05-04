<?php
require "session.php";
require "../config/connection.php";

$kategori = mysqli_query($conn, "SELECT * FROM kategori");

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
    <title>Tambah Produk</title>

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
                            <?php while ($data = mysqli_fetch_array($kategori)): ?>
                                <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                            <?php endwhile; ?>
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
                        <label for="ketersediaan" class="form-label">Ketersediaan</label>
                        <select name="ketersediaan" id="ketersediaan" class="form-control">
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
                        $stok = htmlspecialchars($_POST['ketersediaan']);

                        if ($nama == '' || $kategori == '' || $harga == '' || $deskripsi == '') {
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Nama, Kategori, Harga, dan Deskripsi Wajib diisi!
                            </div>
                            <?php
                        } else {
                            $target_dir = "../resource/img/";
                            $nama_file = basename($_FILES["foto"]["name"]);
                            $target_file = $target_dir . $nama_file;
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            $image_size = $_FILES["foto"]["size"];
                            $random_name = generateRandomString(20);
                            $new_name = $random_name . "." . $imageFileType;

                            if ($nama_file != "") {
                                if ($image_size >= 700000) {
                                    ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Ukuran file tidak boleh lebih dari 700KB!
                                    </div>
                                    <?php
                                } else {
                                    if ($imageFileType != 'jpeg' && $imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                                        ?>
                                        <div class="alert alert-warning mt-3" role="alert">
                                            File harus bertipe JPEG/JPG, PNG, GIF!
                                        </div>
                                        <?php
                                    } else {
                                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                    }
                                }
                            }
                            $tambah_produk = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, deskripsi, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$deskripsi', '$stok')");

                            if ($tambah_produk) {
                                ?>
                                <div class="alert alert-primary mt-3" role="alert">
                                    Data Berhasil Disimpan
                                </div>
                                <?php
                                header("Refresh: 1; URL=../AdminPanel/produk.php");
                                exit();

                            } else {
                                echo mysqli_error($conn);
                            }
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