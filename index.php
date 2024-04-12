<?php
session_start();

$products = [
    ['id' => 1, 'name' => 'Bunga Mawar', 'price' => 35000, 'image' => 'mawar.png', 'description' => 'Mawar adalah simbol cinta dan keindahan yang klasik dalam buket pengantin. Mawar tersedia dalam berbagai warna seperti merah dan putih. yang masing-masing memiliki makna berbeda. Misalnya, mawar merah melambangkan cinta yang kuat.'],
    ['id' => 2, 'name' => 'Bunga Lily', 'price' => 50000, 'image' => 'lily.png', 'description' => 'Lily adalah bunga yang elegan dan harum. Lily putih adalah simbol kepolosan dan kesucian, sementara lily Stargazer dengan warna-warna cerah melambangkan keberhasilan dan prestise. Lily bisa dipilih sebagai jenis bunga untuk hand bouquet pengantin.'],
    ['id' => 3, 'name' => 'Bunga Peony', 'price' => 55000, 'image' => 'peony.png', 'description' => 'Peony adalah jenis bunga hand bouquet pengantin yang indah dan besar, sering digunakan untuk memberikan tampilan mewah dan romantis. Peony hadir dalam berbagai warna dan melambangkan kebahagiaan dan pernikahan yang bahagia.'],
    ['id' => 4, 'name' => 'Bunga Anggrek', 'price' => 65000, 'image' => 'anggrek.png', 'description' => 'Anggrek adalah bunga eksotis yang melambangkan kecantikan dan keanggunan. Anggrek sering digunakan dalam pernikahan bertema tropis. Anggrek juga sering dianggap sebagai simbol keberuntungan dan kekuatan.'],
    ['id' => 5, 'name' => 'Bunga Daisy', 'price' => 40000, 'image' => 'daisy.png', 'description' => 'Bunga Daisy sederhana dan segar, sering digunakan dalam pernikahan berkonsep alam. Daisy melambangkan kesederhanaan dan kebahagiaan dan juga sering dianggap sebagai simbol kesucian dan keindahan alami.']
];

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $product = array_values(array_filter($products, function ($p) use ($productId) {
        return $p['id'] == $productId;
    }))[0];
    
    if (!empty($product)) {
        $cartItem = ['id' => $product['id'], 'name' => $product['name'], 'price' => $product['price']];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        array_push($_SESSION['cart'], $cartItem);
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
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body-produk">
<header class="heading">
    <div class="main">
        <div class="logo"><img src="logo.png" alt=""></div>
        <ul>
            <li><a href="index2.html" class="icon-button"><img src="logo.png" alt="" width="40px">Home</a></li>
            <li><a href="#" class="icon-button"><img src="box_679821.png" alt="" width="20px">Produk</a></li>
            <li><a href="about.html" class="icon-button"><img src="icons8-about-48.png" alt="" width="20px">About</a></li>
            <li><a href="keranjang.php" class="icon-button"><img src="shopping-cart.png" alt="" width="20px"> Cart</a></li>
        </ul>
    </div>
</header>
<div id="slider">
   <input type="radio" name="slider" id="slide1" checked>
   <input type="radio" name="slider" id="slide2">
   <input type="radio" name="slider" id="slide3">
   <div id="slides">
      <div id="overflow">
         <div class="inner">
            <div class="slide slide_1">
               <div class="slide-content">
                  <h2>Slide 1</h2>
                  <p>Content for Slide 1</p>
               </div>
            </div>
            <div class="slide slide_2">
               <div class="slide-content">
                  <h2>Slide 2</h2>
                  <p>Content for Slide 2</p>
               </div>
            </div>
            <div class="slide slide_3">
               <div class="slide-content">
                  <h2>Slide 3</h2>
                  <p>Content for Slide 3</p>
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
        <?php foreach ($products as $product): ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                </div>
                <div class="card-footer">
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="add_to_cart" class="btn btn-primary"><img src="shopping-cart.png" alt="" width="25px"></button>
                    </form>
                    <div class="price">Rp <?php echo $product['price']; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
</div>
</body>
</html>