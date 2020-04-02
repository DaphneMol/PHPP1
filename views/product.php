<?php
require_once '../controllers/session.php';
require_once '../controllers/connect.php';

$qry = $conn->query("SELECT * FROM product");

$products = [];

while ($row = $qry->fetch_assoc()) {
    array_push($products, $row);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>

<body>
    <div id="container">
        <header><img src="../assets/img/homepage/sneaker.jpg" alt="sneaker"></header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
            </ul>
        </nav>
        <main>
            <?php foreach ($products as $product) { ?>
                <div class="card">
                    <img src="../assets/img/shoes/<?= $product['image1'] ?>" alt="<?= $product['name'] ?>" style="width:100%">
                    <h1><?= $product['name'] ?></h1>
                    <p class="price">&euro;<?= $product['price'] ?></p>
                    <p><?= $product['description'] ?></p>
                    <p><button>Add to Cart</button></p>
                </div>
            <?php } ?>
        </main>
        <footer>
            <small>&copy; Copyright 2020, SHOESHOE</small>
        </footer>
    </div>



    <a href="views/product/product_overzicht.php"><button>Overzicht Producten</button></a>
    <a href="views/category/category_overzicht.php"><button>Overzicht Category</button></a>
    <a href="controllers/logout.php"><button>logout</button></a>
</body>

</html>