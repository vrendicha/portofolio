<?php
session_start();
include 'koneksi.php';

// Ambil daftar kategori unik dari database
$categoryQuery = "SELECT DISTINCT category FROM products";
$categoryResult = $conn->query($categoryQuery);

// Cek dan buat folder images jika belum ada
$folder = "images/";
if (!file_exists($folder)) {
    mkdir($folder, 0755, true);
    echo "Folder 'images' berhasil dibuat!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Selamat Datang di Toko Saya</h2>

    <!-- Form Pencarian dan Filter -->
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." 
                       value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    <?php while ($row = $categoryResult->fetch_assoc()) { ?>
                        <option value="<?php echo $row['category']; ?>" 
                                <?php echo (isset($_GET['category']) && $_GET['category'] == $row['category']) ? 'selected' : ''; ?>>
                            <?php echo $row['category']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tampilkan Produk -->
    <div class="row">
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';

        $sql = "SELECT * FROM products WHERE 1=1";
        if (!empty($search)) {
            $sql .= " AND name LIKE '%$search%'";
        }
        if (!empty($category)) {
            $sql .= " AND category = '$category'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Cek apakah image berupa URL atau file lokal
                $imagePath = $row["image"];
                if (!filter_var($imagePath, FILTER_VALIDATE_URL)) {
                    $imagePath = "images/" . $imagePath;
                }

                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card h-100">';
                echo '<img src="' . $imagePath . '" class="card-img-top" alt="' . htmlspecialchars($row["name"]) . '">';
                echo '<div class="card-body">';
                echo '<div class="d-flex flex-wrap align-items-center gap-2">';
                echo '<h5 class="card-title">' . htmlspecialchars($row["name"]) . '</h5>';
                echo '<p class="card-text">Stok: ' . $row["stock"] . '</p>';
                echo '<p class="card-text">Harga: Rp' . number_format($row["price"], 0, ',', '.') . '</p>';
                echo '<p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';
                echo '<p class="card-text"><strong>Kategori:</strong> ' . htmlspecialchars($row["category"]) . '</p>';
                echo '<div class="d-grid gap-2">';

                echo '<a href="#" class="btn btn-primary">Beli Sekarang</a>';

                echo '<form method="POST" action="keranjang.php">';
                echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                echo '<input type="hidden" name="name" value="'.$row["name"].'">';
                echo '<input type="hidden" name="price" value="'.$row["price"].'">';
                echo '<input type="hidden" name="image" value="'.$row["image"].'">';
                echo '<input type="number" name="quantity" value="1" class="form-control">';
                echo '<button type="submit" class="btn btn-success mt-2">Tambah ke Keranjang</button>';
                echo '</form>';

                echo '</div>';

                echo '</div></div></div>';
            }
        } else {
            echo "<p class='text-center'>Produk tidak ditemukan</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
