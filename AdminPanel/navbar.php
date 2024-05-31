<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="sidebar">
    <div class="menu-content">
        <ul class="menu-items">
            <a href="index.php" class="logo">
                <img src="../resource/img/logofourdeals smk4.png" alt="" width="200" height="71">
            </a>
            <li class="item">
                <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
            </li>
            <li class="item">
                <a href="kategori.php" class="<?php echo ($current_page == 'kategori.php') ? 'active' : ''; ?>"><i class="bi bi-grid-1x2-fill"></i> Kategori</a>
            </li>
            <li class="item">
                <a href="produk.php" class="<?php echo ($current_page == 'produk.php') ? 'active' : ''; ?>"><i class="bi bi-box-seam"></i> Produk</a>
            </li>
            <li class="item">
                <a href="logout.php" class="<?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>" style="color: #D31818;"><i class="bi bi-arrow-bar-left"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>