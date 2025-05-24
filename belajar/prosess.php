<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan amankan data dari form
    $Nama = htmlspecialchars($_POST['nama_produk']);
    $harga = htmlspecialchars($_POST['harga_produk']);
    $Deskripsi = htmlspecialchars($_POST['deskripsi_produk']);

    // Validasi data
    if (empty($Nama) || empty($harga) || empty($Deskripsi)) {
        die("Semua field harus diisi!");
    }

    if (!is_numeric($harga) || $harga < 0) {
        die("Harga harus berupa angka positif!");
    }

    if (strlen($Deskripsi) < 10) {
        die("Deskripsi harus lebih dari 10 karakter!");
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Detail Produk</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Detail Produk</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama Produk:</strong> <?= $Nama ?></p>
                <p><strong>Harga Produk:</strong> Rp <?= number_format($harga, 0, ',', '.') ?></p>
                <p><strong>Deskripsi Produk:</strong> <?= $Deskripsi ?></p>
            </div>
        </div>
    </div>
    </body>
    </html>

    <?php
} else {
    echo "Form belum dikirim!";
}
?>
