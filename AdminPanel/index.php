<?php
require "session.php";
require "../config/connection.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Four Fair</title>
    <link rel="stylesheet" href="../resource/css/main.css">
    <link rel="stylesheet" href="../resource/css/frontend/sidebar.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../resource/css/frontend/sidebar.css">
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

        .text-decoration {
            text-decoration: none;
        }

        .summary-kategori {
            background-color: #fff;
            border-radius: 5.18px;
            height: 100px;
            width: 220px;
            position: relative;
        }

        .cardKategori {
            background-color: #F7D4D4;
            border-radius: 5.18px;
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .cardProduk {
            background-color: #CFEFCA;
            border-radius: 5.18px;
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .iconKategori {
            font-size: 24px;
            color: #E53636;
        }

        .iconProduk {
            font-size: 24px;
            color: #1AB900;
        }

        .total-kategori-text {
            color: #565656;
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            font-size: 16px;
        }

        .jumlah-kategori-text {
            color: #3F3F3F;
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            font-size: 18px;
        }

        .card-link {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            text-decoration: none;
            color: inherit;
        }

        .summary-produk {
            background-color: #e85e1a;
            border-radius: 10px;
            height: 214px;
            width: 208px;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .blue-hover:hover {
            background-color: #000;
        }

        .account {
            position: absolute;
            top: 5rem;
            right: 200px;
        }

        .btn-warning {
            background-color: #FF9E00;
            color: #1C2026;
            width: 50px;
            height: 50px;
        }

        .btn-warning:hover {
            background-color: #FFB947;
            border-color: #FFB947;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container pt-5" style="margin-left: 378px; width:65%;">
        <div class="mt-3 text-black">
            <a href="" type="button" class="btn btn-warning"><i class="bi bi-power fs-4"></i></a>
            <div class="account">
            </div>
            <h1>Hello <?php echo $_SESSION['username']; ?></h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="me-2 "></i>
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none" style="color: #3B3B3B;">Home</a></li>
                <li class="breadcrumb-item" aria-current="page" style="color: #000000">Dashboard</li>
            </ol>
        </nav>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <div class="col">
                    <a href="../AdminPanel/kategori.php" class="card-link"></a>
                    <div class="summary-kategori" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="p-3">
                            <h6 class="total-kategori-text">Total Kategori</h6>
                            <div class="col fs-3 jumlah-kategori-text">
                                <?php echo $jumlahKategori; ?>
                            </div>
                            <div class="cardKategori">
                                <i class="bi bi-grid-1x2-fill font-large-2 iconKategori"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="../AdminPanel/produk.php" class="card-link"></a>
                    <div class="summary-kategori" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="p-3">
                            <h6 class="total-kategori-text">Total Produk</h6>
                            <div class="col fs-3 jumlah-kategori-text">
                                <?php echo $jumlahProduk ?>
                            </div>
                            <div class="cardProduk">
                                <i class="bi bi-box-seam font-large-2 iconProduk"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="../AdminPanel/produk.php" class="card-link"></a>
                    <div class="summary-kategori" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="p-3">
                            <h6 class="total-kategori-text">Total Produk</h6>
                            <div class="col fs-3 jumlah-kategori-text">
                                <?php echo $jumlahProduk ?>
                            </div>
                            <div class="cardProduk">
                                <i class="bi bi-cart3 font-large-2 iconProduk"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="../AdminPanel/produk.php" class="card-link"></a>
                    <div class="summary-kategori" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="p-3">
                            <h6 class="total-kategori-text">Total Produk</h6>
                            <div class="col fs-3 jumlah-kategori-text">
                                <?php echo $jumlahProduk ?>
                            </div>
                            <div class="cardProduk">
                                <i class="bi bi-cart3 font-large-2 iconProduk"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="card border-0" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="filter">
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Reports <span>/Today</span></h5>

                            <!-- Line Chart -->
                            <div id="reportsChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#reportsChart"), {
                                        series: [{
                                            name: 'Sales',
                                            data: [31, 40, 28, 51, 42, 82, 56],
                                        }, {
                                            name: 'Revenue',
                                            data: [11, 32, 45, 32, 34, 52, 41]
                                        }, {
                                            name: 'Customers',
                                            data: [15, 11, 32, 18, 9, 24, 11]
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'area',
                                            toolbar: {
                                                show: false
                                            },
                                        },
                                        markers: {
                                            size: 4
                                        },
                                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                        fill: {
                                            type: "gradient",
                                            gradient: {
                                                shadeIntensity: 1,
                                                opacityFrom: 0.3,
                                                opacityTo: 0.4,
                                                stops: [0, 90, 100]
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'smooth',
                                            width: 2
                                        },
                                        xaxis: {
                                            type: 'datetime',
                                            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                        },
                                        tooltip: {
                                            x: {
                                                format: 'dd/MM/yy HH:mm'
                                            },
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Line Chart -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../resource/apexcharts/apexcharts.min.js"></script>
    <script src="../resource/chart.js/chart.umd.js"></script>
    <script src="../resource/echarts/echarts.min.js"></script>
</body>

</html>