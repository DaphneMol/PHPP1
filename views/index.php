<?php
require_once '../controllers/session.php';
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
        <header>
            <img src="../assets/img/homepage/sneaker.jpg" alt="sneaker">
        </header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <?php if (isset($_SESSION['admin'])) { ?>
                    <li><a href="admin/product/product_overzicht.php">Admin Product</a></li>
                    <li><a href="admin/category/category_overzicht.php">Admin Category</a></li>
                <?php } ?>
                <?php if (!isset($_SESSION['username'])) { ?>
                    <li style="float: right"><a href="login.php">Inloggen</a></li>
                    <li style="float:right"><a href="registratie.php">Registreren</a></li>
                <?php } else { ?>
                    <li style="float: right"><a href="../controllers/logout.php">Uitloggen</a></li>
                <?php } ?>

            </ul>
        </nav>
        <main>
            <p>Test</p>
        </main>
    </div>

</body>

</html>