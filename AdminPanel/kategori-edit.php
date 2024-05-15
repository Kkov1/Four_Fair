<?php
require "session.php";
require "../config/connection.php";
$id = $_GET['p'];

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'");
$data = mysqli_fetch_array($query);

if (isset($_POST['edit'])) {
    // apabila button edit dipencet
    $kategori = htmlspecialchars($_POST['kategori']);
    if ($data['nama'] == $kategori) {
        // apabila nama yang diganti sama dengan nama kategori sebelummnya
        header("Location: kategori.php");
        exit();
    } else {
        $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama ='$kategori'");
        $jumlahdata = mysqli_num_rows($query);

        if ($jumlahdata > 0) {
            // jika nama kategori lebih dari 0
            ?>
            <div class="alert alert-warning mt-3" role="alert">
                Kategori Sudah Ada
            </div>
            <?php
        } else {
            $update = mysqli_query($conn, "UPDATE kategori SET nama= '$kategori'  WHERE id='$id' ");

            if ($update) {
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
}
?>

<?php

if (isset($_POST['delete'])) {
    $query_check = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
    $data_count = mysqli_num_rows($query_check);

    if ($data_count > 0) {
        ?>
        <div class="alert alert-warning mt-3" role="alert">
            Kategori tidak bisa dihapus karena sudah digunakan pada produk
        </div>

        <?Php
        header("Refresh: 1; URL=kategori.php");
        die();
    }


    $hapus = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");
    if ($hapus) {
        ?>
        <div class="alert alert-warning mt-3" role="alert">
            Data Berhasil Dihapus
        </div>
        <?php
        header("Refresh: 1; URL=kategori.php");
        exit();
    } else {
        ?>
        <div class="alert alert-warning mt-3" role="alert">
            Eror
        </div>
        <?php
        header("Refresh: 1; URL=kategori.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <h2>Detail Kategori</h2>
        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" id="kategori" name="kategori" class="form-control"
                        value="<?php echo $data['nama']; ?>">
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                    <button class="btn btn-warning" type="submit" name="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>