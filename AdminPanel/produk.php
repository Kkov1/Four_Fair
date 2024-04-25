<?php
require "session.php";
require "../config/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
</head>
<?php require "navbar.php"; ?>

<body>
    <div class="container mt-4">
        <ol class="breadcrumb">
            <i class="bi bi-house-door-fill me-2 "></i>
            <li class="breadcrumb-item"><a href="../AdminPanel/" class="text-decoration">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>

    </div>


    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>