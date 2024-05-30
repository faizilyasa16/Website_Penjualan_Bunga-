<?php
session_start();

$produk = [
    ['id' => 1, 'name' => 'Bunga Mawar', 'price' => 35000, 'image' => 'asset/mawar.png', 'description' => 'Mawar adalah simbol cinta dan keindahan yang klasik dalam buket pengantin. Mawar tersedia dalam berbagai warna seperti merah dan putih. yang masing-masing memiliki makna berbeda. Misalnya, mawar merah melambangkan cinta yang kuat.'],
    ['id' => 2, 'name' => 'Bunga Lily', 'price' => 50000, 'image' => 'asset/lily.png', 'description' => 'Lily adalah bunga yang elegan dan harum. Lily putih adalah simbol kepolosan dan kesucian, sementara lily Stargazer dengan warna-warna cerah melambangkan keberhasilan dan prestise. Lily bisa dipilih sebagai jenis bunga untuk hand bouquet pengantin.'],
    ['id' => 3, 'name' => 'Bunga Peony', 'price' => 55000, 'image' => 'asset/peony.png', 'description' => 'Peony adalah jenis bunga hand bouquet pengantin yang indah dan besar, sering digunakan untuk memberikan tampilan mewah dan romantis. Peony hadir dalam berbagai warna dan melambangkan kebahagiaan dan pernikahan yang bahagia.'],
    ['id' => 4, 'name' => 'Bunga Anggrek', 'price' => 65000, 'image' => 'asset/anggrek.png', 'description' => 'Anggrek adalah bunga eksotis yang melambangkan kecantikan dan keanggunan. Anggrek sering digunakan dalam pernikahan bertema tropis. Anggrek juga sering dianggap sebagai simbol keberuntungan dan kekuatan.'],
    ['id' => 5, 'name' => 'Bunga Daisy', 'price' => 40000, 'image' => 'asset/daisy.png', 'description' => 'Bunga Daisy sederhana dan segar, sering digunakan dalam pernikahan berkonsep alam. Daisy melambangkan kesederhanaan dan kebahagiaan dan juga sering dianggap sebagai simbol kesucian dan keindahan alami.']
];

if (isset($_SESSION['keranjang'])) {
    $barangkeranjang = $_SESSION['keranjang'];
}

// Menambah jumlah barang dalam keranjang belanja
if (isset($_POST['add_qty'])) {
    $idproduk = $_POST['product_id'];
    foreach ($barangkeranjang as &$barang) {
        if ($barang['id'] == $idproduk) {
            $_SESSION['keranjang'] = $barangkeranjang;
            header('Location: keranjang.php');
            exit();
        }
    }
}

// Hapus barang dari keranjang belanja
if (isset($_POST['remove_item'])) {
    $idproduk = $_POST['product_id'];
    $keranjang_baru = [];
    foreach ($barangkeranjang as $barang) {
        if ($barang['id'] != $idproduk) {
            $keranjang_baru[] = $barang;
        }
    }
    $_SESSION['keranjang'] = $keranjang_baru;
    header('Location: keranjang.php');
    exit();
}
$totalPrice = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" type="text/css" href="asset/style.css">
    <script>
    const products = <?php echo json_encode($produk); ?>;
    </script>
</head>
<body class="body-keranjang">
<header class="heading">
    <div class="main">
        <div class="logo"><img src="asset/logo.png" alt=""></div>
        <ul>
            <li><a href="index2.html" class="icon-button"><img src="asset/logo.png" alt="" width="40px">Home</a></li>
            <li><a href="index.php" class="icon-button"><img src="asset/box_679821.png" alt="" width="20px">Produk</a></li>
            <li><a href="about.html" class="icon-button"><img src="asset/icons8-about-48.png" alt="" width="20px">About</a></li>
            <li><a href="#" class="icon-button"><img src="asset/shopping-cart.png" alt="" width="20px"> Cart</a></li>
        </ul>
    </div>
</header>
<div class="container2">
    <h2>Keranjang Belanja</h2>
    <div class="cart">
    <?php foreach ($barangkeranjang as $barang): ?>
    <div class="item">
        <img src="<?php echo $produk[$barang['id'] - 1]['image']; ?>" alt="<?php echo $barang['name']; ?>" width="100px">
        <h3><?php echo $barang['name']; ?></h3>
        <p class="price">Rp <?php echo $barang['price']; ?></p>
        <form method="POST">
            <input type="hidden" name="product_id" value="<?php echo $barang['id']; ?>">
            <input type="number" id="qty_<?php echo $barang['id']; ?>" name="qty" placeholder="Jumlah" min="0" onchange="updateTotal()" class="angka-keranjang" required>
            <button type="submit" name="remove_item" class="btn-tambah" onclick="updateTotal()">Hapus Barang</button>
        </form>
    </div>
    <?php endforeach; ?>
    <div class="total">
        <strong>Total Harga:</strong> Rp <span id="totalPrice"><?php echo $totalPrice; ?></span>
    </div>
    <button type="button" id="btnLanjutPembayaran" class="btn-lanjut" onclick="validasiDanArahkan()">Lanjutkan Pembayaran</button>
    <form id="checkoutForm" method="POST">
        <h3 class="informasi">Informasi Pembayaran</h3>
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br><br>
    
        <label for="alamat">Alamat:</label><br>
        <textarea id="alamat" name="alamat"></textarea><br><br>
    
        <label for="telepon">Telepon:</label><br>
        <input type="text" id="telepon" name="telepon"><br><br>
    
        <label for="Pembayaran">Pembayaran</label><br>
        <select id="Pembayaran" name="Pembayaran" onchange="qqrisImage()">
            <optgroup label="QRIS">
                <option value="BCA">BCA</option>
                <option value="BSI">BSI</option>
                <option value="BNI">BNI</option>
                <option value="BRI">BRI</option>
            </optgroup>
        </select><br><br>
        <img id="qrisImage" src="asset/qris.jpeg" alt="" class="qris" style="display:none;">
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
    <script src="script/script3.js"></script>
</body>
</html>