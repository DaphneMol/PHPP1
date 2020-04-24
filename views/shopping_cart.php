<?php
require_once '../controllers/connect.php';
require_once '../controllers/session.php';
$winkelmandProducts = [];

if (isset($_GET['delete'])) {
    $removeArr = array($_GET['delete']);
    $_SESSION['winkelmand'] = array_diff($_SESSION['winkelmand'], $removeArr);
    header("Refresh:0; url=shopping_cart.php");
}

if (isset($_SESSION['winkelmand']) && !empty($_SESSION['winkelmand'])) {
    $qty = array_count_values($_SESSION['winkelmand']);
    $qry = $conn->query("SELECT * FROM product WHERE id IN (" . implode(",", $_SESSION['winkelmand']) . ");");


    while ($row = $qry->fetch_assoc()) {
        array_push($winkelmandProducts, $row);
    }
} else {
    $msg = "Je hebt nog geen producten";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../assets/css/shopping_cart.css">
</head>

<body>

    <div id="container">
        <header>
            <h2>Shopping cart</h2>
        </header>
        <main>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Delete</th>
                </tr>
                <?php if (!isset($winkelmandProducts[0]['name'])) { ?>
                    <tr>
                        <td colspan="6">Je hebt geen producten</td>
                    </tr>
                    <?php } else {
                    foreach ($winkelmandProducts as $product) { ?>

                        <tr>
                            <td><img src="../assets/img/shoes/<?= $product['image1'] ?>" alt="<?= $product['name'] ?>" style="max-width: 100px"></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['description'] ?></td>
                            <td><?= $product['price'] ?></td>
                            <td><?= $qty[$product['id']] ?></td>
                            <td><button onclick="window.location.replace(`shopping_cart.php?delete=<?= $product['id'] ?> `); ">Delete</button></td>

                        </tr>

                    <?php }
                    $price = 0;
                    foreach ($winkelmandProducts as $product) {
                        $price = $price + $product['price'] * $qty[$product['id']];
                    }
                    ?>
                    <tr>
                        <td><b>Totaal: </b></td>
                        <td></td>
                        <td></td>
                        <td><?= $price ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </table>
        </main>
        <a class="but_shop" href="../views/product.php">Keep shopping</a>
        <a class="order_shop" href="../views/registratie_form.php">Bestellen</a>

    </div>

</body>

</html>