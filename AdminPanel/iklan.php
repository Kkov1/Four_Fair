<?php
require "session.php";
require "../config/connection.php";

$stmt = $conn->prepare("SELECT id, nama, deskripsi, foto FROM iklan");
$stmt->execute();
$result = $stmt->get_result();
$jumlahiklan = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iklan</title>
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
    <div class="container pt-5" style="margin-left: 378px; width:65%;">
        <h2 class="mt-3 text-black">List Iklan</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="me-2 "></i>
                <li class="breadcrumb-item"><a href="../AdminPanel/" class="text-decoration" style="color: #3B3B3B;">Home</a></li>
                <li class="breadcrumb-item" aria-current="page" style="color: #000000">Iklan</li>
            </ol>
        </nav>

        <div class="container">
            <div class="card border-0" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card-title">
                                <h5 class="card-title">Data Iklan</h5>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-end">
                                <a href="tambah-iklan.php" class="btn btn-primary">
                                    Tambah Iklan
                                </a>
                            </div>
                        </div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($jumlahiklan == 0) {
                                ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Iklan tidak tersedia</td>
                                    </tr>
                                    <?php
                                } else {
                                    $jumlah = 1;
                                    while ($data = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $jumlah; ?></td>
                                            <td><?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($data['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><img src="../data/img-iklan/<?php echo htmlspecialchars($data['foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto Iklan" style="width: 100px; height: auto;"></td>
                                            <td>
                                                <a href="iklan-edit.php?p=<?php echo $data['id']; ?>" class="btn btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                        $jumlah++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../resource/vendor/simple-datatables/simple-datatables.js"></script>
    <script>
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