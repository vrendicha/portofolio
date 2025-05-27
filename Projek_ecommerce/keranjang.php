<?php
session_start();

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
$quantity = $_POST['quantity'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $id) {
        $item['quantity'] += $quantity;
        $found = true;
        break;
    }
}
unset($item);

if (!$found) {
    $_SESSION['cart'][] = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'quantity' => $quantity
    ];
}

header("Location: keranjang_view.php");
exit();
