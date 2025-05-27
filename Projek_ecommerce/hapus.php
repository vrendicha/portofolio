<?php
session_start();

if (isset($_POST['id'])) {
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $_POST['id']) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        }
    }
}

header("Location: keranjang_view.php");
exit();
