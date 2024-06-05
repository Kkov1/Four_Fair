<?php
require "session.php";
require "../config/connection.php";

$kategori_result = mysqli_query($conn, "SELECT * FROM kategori");

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
    <title>Tambah Iklan</title>

    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../resource/css/frontend/sidebar.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
</head>

<body>

    <?php require "navbar.php"; ?>

    <div class="container pt-5" style="margin-left: 378px; width:65%;">
        <h3>Tambah Iklan</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="me-2 "></i>
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none" style="color: #3B3B3B;">Home</a></li>
                <li class="breadcrumb-item"><a href="produk.php" class="text-decoration-none" style="color: #3B3B3B;">Produk</a></li>
                <li class="breadcrumb-item" aria-current="page" style="color: #000000">Tambah Iklan</li>
            </ol>
        </nav>
        <div class="row">
            <div class="card border-0 mb-5" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="col-12">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Iklan</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Tambah Iklan</button>
                            <?php
                            if (isset($_POST['submit'])) {
                                $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8');
                                $deskripsi = htmlspecialchars($_POST['deskripsi'], ENT_QUOTES, 'UTF-8');

                                // Proses upload foto
                                $target_dir = "../data/img-iklan/";
                                $nama_file_asli = basename($_FILES["foto"]["name"]);
                                $imageFileType = strtolower(pathinfo($nama_file_asli, PATHINFO_EXTENSION));
                                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                                if (in_array($imageFileType, $allowed_types)) {
                                    if ($_FILES["foto"]["size"] < 5000000) { // Contoh batas ukuran file 5MB
                                        $nama_file = generateRandomString(15) . '.' . $imageFileType; // Menggunakan nama acak
                                        $target_file = $target_dir . $nama_file;
                                        $check = getimagesize($_FILES["foto"]["tmp_name"]);

                                        if ($check !== false) {
                                            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                                                // Menyimpan data ke database
                                                $stmt = $conn->prepare("INSERT INTO iklan (nama, deskripsi, foto) VALUES (?, ?, ?)");
                                                $stmt->bind_param("sss", $nama, $deskripsi, $nama_file);
                                                $stmt->execute();

                                                if ($stmt->affected_rows > 0) {
                            ?>
                                                    <div class="alert alert-primary mt-3" role="alert">
                                                        Data Berhasil Disimpan
                                                    </div>
                                                    <meta http-equiv="refresh" content="1; url=iklan.php" />
                            <?php
                                                } else {
                                                    echo mysqli_error($conn);
                                                }
                                                $stmt->close();
                                            } else {
                                                echo "<div class='alert alert-danger'>Gagal mengupload foto.</div>";
                                            }
                                        } else {
                                            echo "<div class='alert alert-danger'>File bukan gambar.</div>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>Ukuran file terlalu besar.</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Format file tidak diizinkan.</div>";
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>