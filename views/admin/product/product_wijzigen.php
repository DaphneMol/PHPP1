<?php
require_once '../../../controllers/session.php';
require_once '../../../controllers/connect.php';

if (isset($_GET['update'])) {
    include '../config/connect.php';

    if (isset($_POST['submit'])) {
        $qry = $conn->prepare('UPDATE product SET name = ?, description = ?, category_id = ?, price = ?, color = ?, weight = ?, active = ?, WHERE id = ?');
        $qry->bind_param('ssidsii', $_POST['name'], $_POST['description'], $_POST['category_id'], $_POST['price'], $_POST['color'], $_POST['weight'], $_POST['active'], $_GET['update']);


        if ($qry->execute()) {
            echo ("<script>alert('Product gewijzigd')</script>");
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error: " . $qry . "<br>" . $conn->error;
        }
    }

    $sql = $conn->query('SELECT * FROM product WHERE id = ' . $_GET['update']);

    $product = $sql->fetch_assoc();
} else {
    echo "No id set";
}

// pers_change.php
// Hier worden korte strings aan elkaar geplakt met punt-is (.=)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijzigen</title>
    <link rel="stylesheet" href="../assets/css/overzicht.css">
</head>

<body>
    <form action="" method="post">

        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>Color</th>
                <th>Weight</th>
                <th>Active</th>
            </tr>
            <tr>
                <td><?php echo $product['name'] ?>
                <td><?php echo $product['description'] ?>
                <td><?php echo $product['category_id'] ?>
                <td><?php echo $product['price'] ?>
                <td><?php echo $product['color'] ?>
                <td><?php echo $product['weight'] ?>
                <td><?php echo $product['active'] ?>
            </tr>
            <tr>
                <td><input type="text" name="name" value="<?php echo $product['name'] ?>"></td>
                <td><input type="text" name="description" value="<?php echo $product['description'] ?>"></td>
                <td><input type="text" name="category_id" value="<?php echo $product['category_id'] ?>"></td>
                <td><input type="text" name="price" value="<?php echo $product['price'] ?>"></td>
                <td><input type="text" name="color" value="<?php echo $product['color'] ?>"></td>
                <td><input type="text" name="weight" value="<?php echo $product['weight'] ?>"></td>
                <td><input type="text" name="active" value="<?php echo $product['active'] ?>"></td>
            </tr>
        </table>
        <div class="buttons"> <input type="submit" value="submit" name="submit"></div>
    </form>
    <div class="button2"><a href="product_overzicht.php"><button>Terug</button></a></div>


</body>

</html>