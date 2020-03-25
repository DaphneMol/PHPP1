<?php


if (isset($_GET['update'])) {
    include '../config/connect.php';
    $id = $_GET['update'];

    if (isset($_POST['submit'])) {

        $qry = 'UPDATE product SET name = "' . $_POST['name'] . '", description = "' . $_POST['description'] . '", category_id = "' . $_POST['category_id'] . '", price = "' . $_POST['price'] . '", color = "' . $_POST['color'] . '", weight = "' . $_POST['weight'] . '", active = "' . $_POST['active'] . '" WHERE id = ' . $id;

        if ($conn->query($qry) === TRUE) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error: " . $qry . "<br>" . $conn->error;
        }
    }

    $sql = $conn->query('SELECT * FROM product WHERE id = ' . $id);

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