<?php
session_start();

// Daftar produk
$produk = [
    ['id' => 1, 'name' => 'Bunga Mawar', 'price' => 35000, 'image' => 'asset/mawar.png', 'description' => 'Mawar adalah simbol cinta dan keindahan yang klasik dalam buket pengantin. Mawar tersedia dalam berbagai warna seperti merah dan putih. yang masing-masing memiliki makna berbeda. Misalnya, mawar merah melambangkan cinta yang kuat.'],
    ['id' => 2, 'name' => 'Bunga Lily', 'price' => 50000, 'image' => 'asset/lily.png', 'description' => 'Lily adalah bunga yang elegan dan harum. Lily putih adalah simbol kepolosan dan kesucian, sementara lily Stargazer dengan warna-warna cerah melambangkan keberhasilan dan prestise. Lily bisa dipilih sebagai jenis bunga untuk hand bouquet pengantin.'],
    ['id' => 3, 'name' => 'Bunga Peony', 'price' => 55000, 'image' => 'asset/peony.png', 'description' => 'Peony adalah jenis bunga hand bouquet pengantin yang indah dan besar, sering digunakan untuk memberikan tampilan mewah dan romantis. Peony hadir dalam berbagai warna dan melambangkan kebahagiaan dan pernikahan yang bahagia.'],
    ['id' => 4, 'name' => 'Bunga Anggrek', 'price' => 65000, 'image' => 'asset/anggrek.png', 'description' => 'Anggrek adalah bunga eksotis yang melambangkan kecantikan dan keanggunan. Anggrek sering digunakan dalam pernikahan bertema tropis. Anggrek juga sering dianggap sebagai simbol keberuntungan dan kekuatan.'],
    ['id' => 5, 'name' => 'Bunga Daisy', 'price' => 40000, 'image' => 'asset/daisy.png', 'description' => 'Bunga Daisy sederhana dan segar, sering digunakan dalam pernikahan berkonsep alam. Daisy melambangkan kesederhanaan dan kebahagiaan dan juga sering dianggap sebagai simbol kesucian dan keindahan alami.']
];

// Tambah produk ke keranjang
if (isset($_POST['tambahkan_keranjang'])) {
    $idproduk = $_POST['product_id'];
    $product = null;

    // Cari produk berdasarkan ID
    foreach ($produk as $p) {
        if ($p['id'] == $idproduk) {
            $product = $p;
            break;
        }
    }

    if ($product) {
        // Tambahkan produk ke keranjang
        $_SESSION['keranjang'][] = $product;
        echo "<script>alert('Produk telah ditambahkan ke dalam cart');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Toko Bunga</title>
    <link rel="stylesheet" type="text/css" href="asset/style.css">
</head>
<body class="body-produk">
<?php 
$headerClass = "heading"; 
include 'header/header.php'; 
?>
<div id="slider">
   <input type="radio" name="slider" id="slide1" checked>
   <input type="radio" name="slider" id="slide2">
   <input type="radio" name="slider" id="slide3">
   <div id="slides">
      <div id="overflow">
         <div class="inner">
            <div class="slide slide_1">
                <div class="slide-content">
                    <img src="asset/poster2.jpeg" alt="">
               </div>
            </div>
            <div class="slide slide_2">
               <div class="slide-content">
               <img src="asset/poster3.jpeg" alt="">
               </div>
            </div>
            <div class="slide slide_3">
               <div class="slide-content">
               <img src="asset/poster4.jpeg" alt="">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="controls">
      <label for="slide1"></label>
      <label for="slide2"></label>
      <label for="slide3"></label>
   </div>
   <div id="bullets">
      <label for="slide1"></label>
      <label for="slide2"></label>
      <label for="slide3"></label>
   </div>
</div>

<div class="container">
    <h2 class="kataawal">Produk Kami</h2>
</div>
<div class="satuincard">
        <?php foreach ($produk as $product): ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                </div>
                <div class="card-footer">
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="tambahkan_keranjang" class="btn btn-primary"><img src="asset/shopping-cart.png" alt="" width="25px"></button>
                    </form>
                    <div class="price">Rp <?php echo $product['price']; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
</div>
</body>
</html>
