<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Keranjang Belanja</h2>
    <?php if (!empty($_SESSION['cart'])) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $subtotal = $item['quantity'] * $item['price'];
                    $total += $subtotal;
                    echo "<tr>
                        <td>{$item['name']}</td>
                        <td>{$item['quantity']}</td>
                        <td>Rp".number_format($item['price'])."</td>
                        <td>Rp".number_format($subtotal)."</td>
                        <td>
                            <form method='POST' action='hapus_keranjang.php'>
                                <input type='hidden' name='id' value='{$item['id']}'>
                                <button class='btn btn-danger btn-sm'>Hapus</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
                <tr>
                    <th colspan="3">Total</th>
                    <th colspan="2">Rp<?php echo number_format($total); ?></th>
                </tr>
            </tbody>
        </table>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    <?php } else {
        echo "<p>Keranjang masih kosong.</p>";
    } ?>
    <a href="index.php" class="btn btn-secondary mt-3">Kembali Belanja</a>
</div>
</body>
</html>
