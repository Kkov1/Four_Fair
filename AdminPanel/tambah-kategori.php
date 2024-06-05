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
    <link rel="stylesheet" href="../resource/css/frontend/sidebar.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

    body {
        background-color: #F3F4F6;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Inter", Regular;
        font-weight: 400;
        overflow-x: hidden;
    }

    .bg-primary {
        background-color: #FF9E00 !important;
        color: #ffffff !important;
    }

    .sidebar {
        position: fixed;
        height: 100%;
        width: 250px;
        background-color: #fff;
        padding: 1px;
        z-index: 99;
        top: 0;
        text-align: left;
        border-radius: 0px 30px 30px 0px;
        box-shadow: 5px 3px 5px 0px rgba(0, 0, 0, 0.10);
    }

    .text-decoration {
        text-decoration: none;
    }

    .logo img {
        margin-top: 40px;
        margin-right: 10px;
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
    }

    .menu-content {
        position: relative;
        height: 100%;
        width: 100%;
        margin-top: 0;
        overflow-y: scroll;
    }

    .menu-content::-webkit-scrollbar {
        display: none;
    }

    .menu-items {
        height: 100%;
        width: 100%;
        list-style: none;
        transition: all 0.4s ease;
    }

    .item i {
        font-size: 22px;
    }

    .item a {
        padding: 10px;
        display: inline-block;
        width: 85%;
        border-radius: 12px;
        transition: 0.3s ease-in-out;
        color: #000000;
        margin-top: 15px;
        font-size: 22px;
        letter-spacing: 0.5px;
    }

    .item a:hover {
        background: #FFF2E1;
        color: #FF9E00;
    }
</style>

<body>

    <?php require "navbar.php"; ?>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" id="kategori" name="kategori" placeholder="Input Nama Kategori" class="form-control">
                        </div>
                        <button class="btn btn-primary mt-3" type="submit" name="simpan">Simpan</button>
                    </form>
                    <?php
                    if (isset($_POST['simpan'])) {
                        $kategori = htmlspecialchars($_POST['kategori']);

                        $stmt = $conn->prepare("SELECT nama FROM kategori WHERE nama = ?");
                        $stmt->bind_param("s", $kategori);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $jumlahkategoribaru = $result->num_rows;

                        if ($jumlahkategoribaru > 0) {
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Nama Kategori Sudah Ada
                            </div>
                            <?php
                        } else {
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4" style="margin-left: 378px; width:65%;">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3></h3>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" id="kategori" name="kategori" placeholder="Input Nama Kategori" class="form-control">
                                </div>
                                <button class="btn btn-primary mt-3" type="submit" name="simpan">Simpan</button>
                            </form>
                            <?php
                            if (isset($_POST['simpan'])) {
                                $kategori = htmlspecialchars($_POST['kategori']);

                                $stmt = $conn->prepare("SELECT nama FROM kategori WHERE nama = ?");
                                $stmt->bind_param("s", $kategori);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $jumlahkategoribaru = $result->num_rows;

                                if ($jumlahkategoribaru > 0) {
                            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Nama Kategori Sudah Ada
                                    </div>
                                    <?php
                                } else {
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
            </div>
        </div>
    </div>



</body>

</html>