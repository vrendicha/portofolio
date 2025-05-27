<?php
// koneksi.php
$conn = new mysqli("localhost", "root", "", "ecommerce");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
