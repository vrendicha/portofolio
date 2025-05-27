<?php
session_start();
include 'koneksi.php';

// Tambahkan ke keranjang
if (isset($_GET['add_to_cart'])) {
    $id = $_GET['add_to_cart'];

    $query = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($query);
    $product = $result->fetch_assoc();

    $_SESSION['cart'][$id] = [
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id]['quantity'] + 1 : 1
    ];
}

// Hapus item dari keranjang
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Keranjang Belanja</h2>

        <?php if (!empty($_SESSION['cart'])) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $id => $item) { ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>Rp<?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>
                                <a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-center">Keranjang belanja kosong.</p>
        <?php } ?>
    </div>
</body>
</html>