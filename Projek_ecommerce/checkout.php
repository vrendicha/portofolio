<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['customer_name'];
    $total = 0;

    foreach ($_SESSION['cart'] as $item) {
        $total += $item['quantity'] * $item['price'];
    }

    // Simpan ke tabel orders
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, total) VALUES (?, ?)");
    $stmt->bind_param("si", $nama, $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Simpan ke order_items
    $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

    foreach ($_SESSION['cart'] as $item) {
        $stmt_item->bind_param("iiii", $order_id, $item['id'], $item['quantity'], $item['price']);
        $stmt_item->execute();
    }

    $stmt_item->close();
    $stmt->close();

    // Kosongkan keranjang
    unset($_SESSION['cart']);

    echo "<script>alert('Checkout berhasil!'); window.location='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Checkout</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Pelanggan</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Konfirmasi & Simpan</button>
        <a href="keranjang_view.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
