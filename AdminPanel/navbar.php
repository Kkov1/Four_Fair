<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a href="../AdminPanel/index.php">
            <img src="../resource/img/logo_fourdeals.png" alt="" style="width: 3rem;" class="mt-auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../AdminPanel/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../AdminPanel/kategori.php">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../AdminPanel/produk.php">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../AdminPanel/logout.php">Logout</a>
                </li>
            </ul>
            <span class="navbar-text text-danger">
                <?php echo $_SESSION['username']; ?>
            </span>
        </div>
    </div>
</nav>