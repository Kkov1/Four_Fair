<?php

require "session.php";
require "../config/connection.php";

// PHP KATEGORI
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$queryjumlahkategori = mysqli_num_rows($queryKategori);
?>

<!-- PHP KATEGORI EDIT -->
<?php
$id = isset($_GET['p']) ? $_GET['p'] : null;

if ($id !== null) {
    $stmt = $conn->prepare("SELECT * FROM kategori WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (isset($_POST['edit'])) {
        $kategori = htmlspecialchars($_POST['kategori']);
        if ($data['nama'] == $kategori) {
            header("Location: kategori.php");
            exit();
        } else {
            $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama ='$kategori'");
            $jumlahdata = mysqli_num_rows($query);

            if ($jumlahdata > 0) {
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
}
?>

<?php
if ($id !== null && isset($_POST['delete'])) {
    $query_check = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
    $data_count = mysqli_num_rows($query_check);

    if ($data_count > 0) {
?>
        <div class="alert alert-warning mt-3" role="alert">
            Kategori tidak bisa dihapus karena sudah digunakan pada produk
        </div>
    <?php
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
    <title>Kategori</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../resource/css/frontend/sidebar.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../resource/vendor/simple-datatables/style.css" rel="stylesheet">
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
    <div class="container pt-5" style="margin-left: 378px; width:65%;">
        <h2 class="mt-3 text-black">List Kategori</h2>
        <nav aria-label="breadcrumb">
            <ol class=" breadcrumb">
                <i class="me-2"></i>
                <li class="breadcrumb-item"><a href="../AdminPanel/" class="text-decoration" style="color: #3B3B3B;">Home</a></li>
                <li class=" breadcrumb-item active" aria-current="page" style="color: #000000">Kategori</li>
            </ol>
        </nav>
        <div class="container">
            <div class="card border-0" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">Data Kategori</h5>
                        </div>
                        <div class="col">
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                    Tambah Kategori
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
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
                                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                        <td>
                                            <a href="kategori.php?p=<?php echo $data['id']; ?>" class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
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
                    <!-- End Table with stripped rows -->
                </div>
            </div>

        </div>
    </div>

    <!-- Modal  Kategori-->
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLabel">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" id="kategori" name="kategori" placeholder="Input Nama Kategori" class="form-control">
                        </div>
                        <?php
                        if (isset($_POST['simpan'])) {
                            $kategori = htmlspecialchars($_POST['kategori']);

                            $namasama = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama = '$kategori'");
                            $jumlahkategoribaru = mysqli_num_rows($namasama);

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
                                    header("Location: kategori.php");
                                    exit();
                                }
                            }
                        }
                        ?>
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <?php if (isset($id)) : ?>
        <?php

        $stmt = $conn->prepare("SELECT * FROM kategori WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

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

        ?>
        <div class="modal show" id="modalDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalDetailLabel">Detail Kategori</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" id="kategori" name="kategori" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>">
                            </div>
                            <div class="mt-3 d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                                <button class="btn btn-warning" type="submit" name="delete">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

    <script src="../resource/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        <?php if (isset($id)) : ?>
            new bootstrap.Modal(document.getElementById("modalDetail"), {}).toggle();
        <?php endif ?>

        const select = (el, all = false) => {
            el = el.trim()
            if (all) {
                return [...document.querySelectorAll(el)]
            } else {
                return document.querySelector(el)
            }
        }

        const datatables = select('.datatable', true)
        datatables.forEach(datatable => {
            new simpleDatatables.DataTable(datatable);
        })
    </script>
</body>

</html>