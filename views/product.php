<?php
require_once '../controllers/session.php';
require_once '../controllers/connect.php';

if (isset($_GET['productId']) && isset($_SESSION['winkelmand'])) {
    // Als er al een winkelmand is voeg het product toe

    array_push($_SESSION['winkelmand'], $_GET['productId']);
    header("Refresh:0; url=product.php");
} elseif (isset($_GET['productId'])) {
    // Als er nog geen winkelmand is maak die aan en voeg het product 

    $_SESSION['winkelmand'] = [];
    array_push($_SESSION['winkelmand'], $_GET['productId']);
    header("Refresh:0; url=product.php");
}


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div id="container">
        <header><img src="../assets/img/homepage/sneaker.jpg" alt="sneaker"></header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <a href="../views/shopping_cart.php"><i class="fa fa-shopping-cart" style="font-size:36px;color:white;float:right;margin-top:3px;margin-right:14px;"></i></a>

            </ul>
        </nav>
        <main>
            <?php foreach ($products as $product) { ?>
                <div class="card">
                    <img src="../assets/img/shoes/<?= $product['image1'] ?>" alt="<?= $product['name'] ?>" style="width:100%">
                    <h1><?= $product['name'] ?></h1>
                    <p class="price">&euro;<?= $product['price'] ?></p>
                    <p><?= $product['description'] ?></p>
                    <form action="" method="get" id="addToCart<?= $product['id'] ?>">
                        <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                    </form>
                    <p><button type="submit" form="addToCart<?= $product['id'] ?>">Add to Cart</button></p>
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