<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resource/css/main.css">
    <title>Four Deals</title>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: Poppins;
            font-weight: 300;
        }

        .btn.btn-login {
            background-color: transparent;
            color: #FF9E00;
            border: 1px solid #FF9E00;
            border-radius: 10px;
            font-family: Poppins;
            font-weight: 700;
        }

        .btn.btn-login:hover {
            background-color: transparent;
            color: #FF9E00;
            border: 1px solid #FF9E00;
        }

        .btn.btn-daftar {
            background-color: #FF9E00;
            color: #FFFFFF;
            border: 1px solid #FF9E00;
            border-radius: 10px;
            font-family: Poppins;
            font-weight: 700;
        }

        .btn.btn-daftar:hover {
            background-color: #FF9E00;
            color: #FFFFFF;
            border: 1px solid #FF9E00;
        }

        @media (min-width: 768px) {
            .input-group-lg .form-control {
                width: 46.625rem;
                /* lebar untuk layar besar */
            }
        }

        @media (max-width: 767.98px) {
            .input-group-lg .form-control {
                width: 10rem;
                /* lebar untuk layar kecil */
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand px-4" href="index.php">
                <img src="./resource/img/logo_fourdeals.png" alt="Bootstrap" width="40" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item me-3 ">
                        <form class="d-flex align-items-center" method="get" action="produk.php">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Cari Barang" aria-label="pencarian" name="keyword" aria-describedby="basic-addon2" style="height: 45px;">
                            </div>
                        </form>

                    </li>
                    <li class="nav-item me-3 ms-3">
                        <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping" style="font-size: 1.5rem;"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3">
                        <a class="btn btn-login" href="./login.php" role="button">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-daftar" href="#" role="button">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="./node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>


</html>