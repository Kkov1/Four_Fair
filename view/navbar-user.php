<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>Four Deals</title>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary p-2">
        <div class="container-fluid">
            <a class="navbar-brand px-4" href="index.php">
                <img src="../resource/img/logo_fourdeals.png" alt="Bootstrap" width="40" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3">
                        <form class="d-flex align-items-center" method="get" action="produk.php">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Cari Barang" aria-label="pencarian"
                                    name="keyword" aria-describedby="basic-addon2" style="width: 100%; height: 45px;">
                            </div>
                        </form>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"
                                style="font-size: 1.5rem;"></i></a>
                    </li>
                    <li class="nav-item me-3 d-none d-lg-block">
                        <h3 class="fw-lighter">|</h3>
                    </li>
                    <li class="nav-item me-3">
                        <a class="btn btn-login" href="#" role="button">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-daftar" href="#" role="button">Daftar</a>
                    </li>
                </ul>
                <div class="d-lg-none text-center mt-3">
                    <h3 class="fw-lighter">|</h3>
                </div>
            </div>
        </div>
    </nav>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
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
            font-family: Plus Jakarta Sans;
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
            font-family: Plus Jakarta Sans;
            font-weight: 700;
        }

        .btn.btn-daftar:hover {
            background-color: #FF9E00;
            color: #FFFFFF;
            border: 1px solid #FF9E00;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>