<?php
session_start();

$products = [
    ['id' => 1, 'name' => 'Bunga Mawar', 'price' => 35000, 'image' => 'mawar.png', 'description' => 'Mawar adalah simbol cinta dan keindahan yang klasik dalam buket pengantin. Mawar tersedia dalam berbagai warna seperti merah dan putih. yang masing-masing memiliki makna berbeda. Misalnya, mawar merah melambangkan cinta yang kuat.'],
    ['id' => 2, 'name' => 'Bunga Lily', 'price' => 50000, 'image' => 'lily.png', 'description' => 'Lily adalah bunga yang elegan dan harum. Lily putih adalah simbol kepolosan dan kesucian, sementara lily Stargazer dengan warna-warna cerah melambangkan keberhasilan dan prestise. Lily bisa dipilih sebagai jenis bunga untuk hand bouquet pengantin.'],
    ['id' => 3, 'name' => 'Bunga Peony', 'price' => 55000, 'image' => 'peony.png', 'description' => 'Peony adalah jenis bunga hand bouquet pengantin yang indah dan besar, sering digunakan untuk memberikan tampilan mewah dan romantis. Peony hadir dalam berbagai warna dan melambangkan kebahagiaan dan pernikahan yang bahagia.'],
    ['id' => 4, 'name' => 'Bunga Anggrek', 'price' => 65000, 'image' => 'anggrek.png', 'description' => 'Anggrek adalah bunga eksotis yang melambangkan kecantikan dan keanggunan. Anggrek sering digunakan dalam pernikahan bertema tropis. Anggrek juga sering dianggap sebagai simbol keberuntungan dan kekuatan.'],
    ['id' => 5, 'name' => 'Bunga Daisy', 'price' => 40000, 'image' => 'daisy.png', 'description' => 'Bunga Daisy sederhana dan segar, sering digunakan dalam pernikahan berkonsep alam. Daisy melambangkan kesederhanaan dan kebahagiaan dan juga sering dianggap sebagai simbol kesucian dan keindahan alami.']
];

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Reset jumlah barang dalam keranjang belanja
if (isset($_POST['reset_qty'])) {
    foreach ($cartItems as &$item) {
        $item['qty'] = 1; // Set ulang jumlah barang menjadi 1
    }
    $_SESSION['cart'] = $cartItems;
    header('Location: keranjang.php');
    exit(); // Exit the script
}


// Menambah jumlah barang dalam keranjang belanja
if (isset($_POST['add_qty'])) {
    $productId = $_POST['product_id'];
    foreach ($cartItems as &$item) {
        if ($item['id'] == $productId) {
            $item['qty'] = isset($item['qty']) ? $item['qty'] + 1 : 1;
            $_SESSION['cart'] = $cartItems;
            header('Location: keranjang.php');
            exit(); // Exit the loop and the script
        }
    }
}

// Menambah produk ke keranjang
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $existingItem = array_filter($cartItems, function ($item) use ($productId) {
        return $item['id'] == $productId;
    });

    if (empty($existingItem)) {
        $product = array_values(array_filter($products, function ($p) use ($productId) {
            return $p['id'] == $productId;
        }))[0];
        
        if (!empty($product)) {
            $cartItem = ['id' => $product['id'], 'name' => $product['name'], 'price' => $product['price'], 'image' => $product['image'], 'qty' => 1];
            $_SESSION['cart'][] = $cartItem;
            echo "<script>alert('Produk telah ditambahkan ke keranjang belanja');</script>";
        }
    }

    header('Location: keranjang.php');
    exit(); // Exit the script
}
// Hapus barang dari keranjang belanja
if (isset($_POST['remove_item'])) {
    $productId = $_POST['product_id'];
    $cartItems = array_filter($cartItems, function ($item) use ($productId) {
        return $item['id'] != $productId;
    });
    $_SESSION['cart'] = $cartItems;
    header('Location: keranjang.php');
    exit(); // Exit the script
}



$totalPrice = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script3.js"></script>
    <script>
    const products = <?php echo json_encode($products); ?>;
    </script>
</head>
<body class="body-keranjang">
<header class="heading">
    <div class="main">
        <div class="logo"><img src="logo.png" alt=""></div>
        <ul>
            <li><a href="index2.html" class="icon-button"><img src="logo.png" alt="" width="40px">Home</a></li>
            <li><a href="index.php" class="icon-button"><img src="box_679821.png" alt="" width="20px">Produk</a></li>
            <li><a href="about.html" class="icon-button"><img src="icons8-about-48.png" alt="" width="20px">About</a></li>
            <li><a href="#" class="icon-button"><img src="shopping-cart.png" alt="" width="20px"> Cart</a></li>
        </ul>
    </div>
</header>
<div class="container2">
    <h2>Keranjang Belanja</h2>
    <div class="cart">
    <?php foreach ($cartItems as $item): ?>
    <div class="item">
        <img src="<?php echo $products[$item['id'] - 1]['image']; ?>" alt="<?php echo $item['name']; ?>" width="100px">
        <h3><?php echo $item['name']; ?></h3>
        <p class="price">Rp <?php echo $item['price']; ?></p>
        <form method="POST">
            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
            <input type="number" id="qty_<?php echo $item['id']; ?>" name="qty" placeholder="Jumlah" min="0" onchange="updateTotal()" class="angka-keranjang" required>
            <button type="submit" name="remove_item" class="btn-tambah" onclick="updateTotal()">Hapus Barang</button>
        </form>
    </div>
        <?php $totalPrice += $item['price'] * (isset($item['qty']) ? $item['qty'] : 1); ?>
    <?php endforeach; ?>
    <form method="POST">
        <button type="submit" name="reset_cart" class="btn-reset">Reset Keranjang</button>
    </form>
    <div class="total">
        <strong>Total Harga:</strong> Rp <span id="totalPrice"><?php echo $totalPrice; ?></span>
    </div>
    <button type="button" id="btnLanjutPembayaran" class="btn-lanjut" onclick="validateAndRedirect()">Lanjutkan Pembayaran</button>
    <form id="checkoutForm" method="POST">
        <h3 class="informasi">Informasi Pembayaran</h3>
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br><br>
    
        <label for="alamat">Alamat:</label><br>
        <textarea id="alamat" name="alamat"></textarea><br><br>
    
        <label for="telepon">Telepon:</label><br>
        <input type="text" id="telepon" name="telepon"><br><br>
    
        <label for="Pembayaran">Pembayaran</label><br>
        <select id="Pembayaran" name="Pembayaran" onchange="showQrisImage()">
            <optgroup label="QRIS">
                <option value="BCA">BCA</option>
                <option value="BSI">BSI</option>
                <option value="BNI">BNI</option>
                <option value="BRI">BRI</option>
            </optgroup>
        </select><br><br>
        <img id="qrisImage" src="qris.jpeg" alt="" class="qris" style="display:none;">
        <label for="pengiriman">Pengiriman</label><br>
        <select id="pengiriman" name="pengiriman">
            <option value="Si Cepat">Si Cepat</option>
            <option value="JNE">JNE</option>
            <option value="JNT">JNT</option>
            <option value="Wahana">Wahana</option>
        </select><br><br>
        <label for="fileInput">Kirim Bukti Pembelian:</label>
        <input type="file" id="fileInput" name="fileInput" accept="image/jpeg">
        <button type="submit" id="btnBayar" name="checkout" class="btn-bayar">Bayar</button>
    </form>
</div>
</body>
</html>