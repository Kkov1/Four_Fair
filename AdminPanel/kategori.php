<?php
require "session.php";
require "../config/connection.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$queryjumlahkategori = mysqli_num_rows($queryKategori);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<?php require "navbar.php"; ?>

<body>
    <div class="container mt-4">
        <ol class="breadcrumb">
            <i class="bi bi-house-door-fill me-2 "></i>
            <li class="breadcrumb-item"><a href="../AdminPanel/" class="text-decoration">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kategori</li>
        </ol>

        <div class="my-5">
            <button type="button" class="btn btn-dark text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Kategori
            </button>

        </div>
        <div class="mt-3">
            <h2 class="text-center fw-bold">List Kategori</h2>

            <div class="table mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?Php
                        $number = 1;
                        if ($queryjumlahkategori == 0) {
                            ?>
                            <tr>
                                <td>Kategori tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            while ($data = mysqli_fetch_array($queryKategori)) {
                                ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <!-- Button trigger modal -->

                                </tr>
                                <?php
                                $number++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div>
                            <label for="kategori">Kateogri</label>
                            <input type="text" id="kategori" name="kategori" placeholder="Input Nama Kategori"
                                class="form-control">
                        </div>
                        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['simpan'])) {
        $kategori = htmlspecialchars($_POST['kategori']);


    }

    ?>


    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>