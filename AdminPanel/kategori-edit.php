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
            $stmt = $conn->prepare("UPDATE kategori SET nama= ? WHERE id= ?");
            $stmt->bind_param("si", $kategori, $id);
            $stmt->execute();

            if ($stmt) {
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
    <link rel="stylesheet" href="../resource/css/frontend/sidebar.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

    body {
        background-color: #F3F4F6;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Open Sans", sans-serif;
        font-weight: 600;
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
        <h2>Detail Kategori</h2>
        <div class="col-12 col-md-6 mb-5">
            <form action="" id="formTarget" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" id="kategori" name="kategori" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>">
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                    <button class="btn btn-warning" type="submit" name="delete" id="deleteButton">
                        Delete
                    </button>
                </div>
            </form>
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
                        window.location.href = "kategori.php";
                    });
                }
            });
        }
    </script>
</body>

</html>