<script src="../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../resource/js/script.js"></script>
<script>
    function updateSubtotal() {
        var harga = <?php echo $data['harga']; ?>;
        var jumlah = document.getElementById('jumlahInput').value;
        var subtotal = harga * jumlah;
        document.getElementById('subtotal').textContent = subtotal.toLocaleString();
    }

    function incrementQuantity() {
        var input = document.getElementById('jumlahInput');
        var currentValue = parseInt(input.value);
        var max = parseInt(input.max);
        if (currentValue < max) {
            input.value = currentValue + 1;
            updateSubtotal(); // Memperbarui subtotal setelah mengubah jumlah
        }
    }

    function decrementQuantity() {
        var input = document.getElementById('jumlahInput');
        var currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            updateSubtotal(); // Memperbarui subtotal setelah mengubah jumlah
        }
    }
</script>
<script>
    function sendMessageToWhatsapp() {
        var nama = "<?php echo htmlspecialchars($user['nama']); ?>"; // Asumsi $user['nama'] tersedia dari session atau database
        var jumlah = document.getElementById('jumlahInput').value;
        var harga = <?php echo $data['harga']; ?>;
        var totalHarga = harga * jumlah;
        var namaProduk = "<?php echo htmlspecialchars($data['nama']); ?>";

        var urlToWhatsapp = `https://wa.me/6285711141021?text=Halo, nama saya ${nama}, saya ingin membeli ${jumlah} produk ${namaProduk} dengan harga Rp ${totalHarga.toLocaleString()}`;
        window.open(urlToWhatsapp, "_blank");
    }
</script>

</body>

</html>