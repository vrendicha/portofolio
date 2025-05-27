<?php
include 'koneksi.php';

$nama_produk = 'Wardah UV Shield SPF 35';
$kategori = 'Kosmetik';
$stok = 50;
$harga = 32000.00;
$deskripsi = 'Sunscreen Wardah SPF 35 untuk perlindungan kulit dari sinar UV.';
$gambar = 'suncreen spf 35.jpg';

$query = "INSERT INTO produk (nama_produk, kategori, stok, harga, deskripsi, gambar)
          VALUES ('$nama_produk', '$kategori', $stok, $harga, '$deskripsi', '$gambar')";

if (mysqli_query($conn, $query)) {
    echo "Produk Wardah SPF 35 berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan produk: " . mysqli_error($conn);
}

$conn->close();
?>
