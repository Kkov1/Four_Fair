<?php
require "session.php";
require "../config/connection.php";
$id = isset($_GET['p']) ? intval($_GET['p']) : 0; // Mengubah input menjadi integer

$stmt = $conn->prepare("SELECT id, nama, deskripsi, foto FROM iklan WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();


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
                <li class="breadcrumb-item"><a href="iklan.php" class="text-decoration-none" style="color: #3B3B3B;">iklan</a></li>
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
                                <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" id="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="CurrentFoto">Foto iklan Sekarang</label>
                                <br>
                                <img src="../data/img-iklan/<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto sekarang" width="300px">
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>
                            <div class="mt-3 d-flex justify-content-center ">
                                <button class="btn btn-primary button-spacing" type="submit" name="edit">Edit</button>
                                <button class="btn btn-danger button-spacing text-white" type="submit" name="delete" id="deleteButton">Delete</button>
                            </div>
                            <?php
                            if (isset($_POST['edit'])) {
                                $nama = htmlspecialchars($_POST['nama']);
                                $deskripsi = htmlspecialchars($_POST['deskripsi']);

                                $target_dir = "../data/img-iklan/";
                                $nama_file = basename($_FILES["foto"]["name"]);
                                $target_file = $target_dir . $nama_file;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $image_size = $_FILES["foto"]["size"];
                                $random_name = generateRandomString(20);
                                $new_name = $random_name . "." . $imageFileType;

                                if ($nama == '' || $deskripsi == '') {
                            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Nama, Kategori, dan Foto Wajib diisi!
                                    </div>
                                    <?php

                                } else {
                                    $stmt = $conn->prepare("UPDATE iklan SET nama=?, deskripsi=? WHERE id=?");
                                    $stmt->bind_param("sss", $nama, $deskripsi, $id);
                                    $stmt->execute();

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

                                                $stmt = $conn->prepare("UPDATE iklan SET foto=? WHERE id=?");
                                                $stmt->bind_param("si", $new_name, $id);
                                                $stmt->execute();

                                                if ($stmt) {
                                                ?>
                                                    <div class="alert alert-primary mt-3" role="alert">
                                                        Data Berhasil Disimpan
                                                    </div>
                                                    <meta http-equiv="refresh" content="1; url=iklan.php" />
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
                                // Mengambil nama file dari database
                                $query = $conn->prepare("SELECT foto FROM iklan WHERE id = ?");
                                $query->bind_param("i", $id);
                                $query->execute();
                                $result = $query->get_result();
                                $row = $result->fetch_assoc();
                                $filename = $row['foto'];

                                // Menghapus file gambar dari direktori
                                if (file_exists("../data/img-iklan/" . $filename)) {
                                    unlink("../data/img-iklan/" . $filename);
                                }

                                // Menghapus data dari database
                                $hapus = mysqli_query($conn, "DELETE FROM iklan WHERE id='$id'");
                                if ($hapus) {
                                    echo '<div class="alert alert-primary mt-3" role="alert">Data dan gambar berhasil dihapus</div>';
                                    echo '<meta http-equiv="refresh" content="1; url=iklan.php" />';
                                } else {
                                    echo '<div class="alert alert-warning mt-3" role="alert">' . mysqli_error($conn) . '</div>';
                                    echo '<meta http-equiv="refresh" content="1; url=iklan.php" />';
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            deleteButton.onclick = function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append("delete", true);
                        fetch("?p=<?= $id; ?>", {
                            method: "POST",
                            body: formData
                        }).then(() => {
                            window.location.href = "iklan.php";
                        });
                    }
                });
            }
        </script>
        <script>
            document.getElementById('nama').addEventListener('input', function(e) {
                var value = e.target.value;
                if (/[^a-zA-Z0-9 ]/.test(value) || value.length > 50) {
                    alert('Hanya karakter alfanumerik yang diperbolehkan dan panjang tidak boleh lebih dari 50 karakter.');
                    e.target.value = value.replace(/[^a-zA-Z0-9 ]/g, '');
                }
            });
        </script>
</body>

</html>