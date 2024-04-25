<?php
require "session.php";
require "../config/connection.php";

$id = $_GET['p'];

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'");
$data = mysqli_fetch_array($query);

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
    <div class="container">
        <h2>Detail Kategori</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" id="kategori" name="kategori" class="form-control"
                        value="<?php echo $data['nama']; ?>">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                </div>
            </form>
            <?php
            if (isset($_POST['edit'])) {
                $kategori = htmlspecialchars($_POST['kategori']);
                if ($data['nama'] == $kategori) {
                    ?>
                    <meta http-equiv="refresh" content="0; url=kategori.php" />
                    <?php
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
                            <meta http-equiv="refresh" content="2; url=kategori.php" />

                            <?php
                        }
                    }
                }
            }
            ?>
        </div>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>