<?php
require_once '../../../controllers/checkAdmin.php';
require_once '../../../controllers/connect.php';
require_once '../../../controllers/session.php';

$qry = $conn->query("SELECT product.*, category.name AS category FROM product INNER JOIN category WHERE product.category_id = category.id");
$products = [];
while ($row = $qry->fetch_assoc()) {
    array_push($products, $row);
}


$categories = [];
$qry = $conn->query("SELECT * FROM category");
while ($row = $qry->fetch_assoc()) {
    array_push($categories, $row);
}

function uploadImage($image)
{
    if (!empty($_FILES[$image])) {
        $fileType = strtolower(pathinfo($_FILES[$image]['name'], PATHINFO_EXTENSION));
        $path = "../../../assets/img/shoes/";
        $path = $path . rand(1, 99999) . '.' . $fileType;


        if (
            $fileType == "jpg" || $fileType == "png" || $fileType == "jpeg"
            || $fileType == "gif"
        ) {
            if (move_uploaded_file($_FILES[$image]['tmp_name'], $path)) {
                $resultFileName = trim(substr($path, strrpos($path, '/') + 1));

                return $resultFileName;
            }
        }
    }
}

if (isset($_GET['update'])) {
    if (isset($_POST['submit'])) {

        $images = [];

        if (!empty($_FILES['image1'])) {
            array_push($images, uploadImage('image1'));
            // array_push($images, uploadImage('image1'));
        }

        if (!$_FILES["image2"]["error"] == 4) {
            array_push($images, uploadImage('image2'));
        }

        if (!empty($_FILES['image3'])) {
            array_push($images, uploadImage('image3'));
        }



        $qry = $conn->prepare('UPDATE product SET name = ?, description = ?, category_id = ?, price = ?, color = ?, weight = ?, active = ?, image1 = ?, image2 = ?, image3 = ? WHERE id = ?');
        $qry->bind_param('ssidsiisssi', $_POST['name'], $_POST['description'], $_POST['category_id'], $_POST['price'], $_POST['color'], $_POST['weight'], $_POST['active'], $images[0], $images[1], $images[2], $_GET['update']);


        if ($qry->execute()) {
            echo ("<script>alert('Product gewijzigd')</script>");
            header("Refresh:0; url=product_overzicht.php");
        } else {
            echo "Error: " . $qry->error;
        }
    }
}

if (isset($_GET['delete'])) {

    $sql = 'DELETE FROM product WHERE id = ' . $_GET['delete'];
    $conn->query($sql);

    if ($conn->affected_rows === 1) {
        echo ("<script>alert('Product has been deleted')</script>");
        header("Refresh:0; url=product_overzicht.php");
    } else {
        echo ("<script>alert('Product doesn't exist or has already been deleted')</script>");
    }
}

if (isset($_GET['add'])) {
    if (isset($_POST['submit'])) {

        $images = [];

        if (isset($_FILES['image1'])) {
            array_push($images, uploadImage('image1'));
        }

        if (isset($_FILES['image2'])) {
            array_push($images, uploadImage('image2'));
        }

        if (isset($_FILES['image3'])) {
            array_push($images, uploadImage('image3'));
        }


        $qry = $conn->prepare("INSERT INTO product (name, description, category_id, price, color, weight, active, image1, image2, image3) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $qry->bind_param('ssidsiisss', $_POST['name'], $_POST['description'], $_POST['category_id'], $_POST['price'], $_POST['color'], $_POST['weight'], $_POST['active'], $images[0], $images[1], $images[2]);
        if ($qry->execute()) {
            echo ("<script>alert('Product toegevoegd')</script>");
            header("Refresh:0; url=product_overzicht.php");
        } else {
            echo "Error: " . $qry->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>
    <link rel="stylesheet" href="../../../assets/css/overzicht.css">
</head>

<body>
    <h1>Overzicht Producten</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Color</th>
            <th>Weight</th>
            <th>Active</th>
            <th>Image1</th>
            <th>Image2</th>
            <th>Image3</th>
        </tr>
        <?php foreach ($products as $product) {

            if (isset($_GET['update']) && $product['id'] == $_GET['update']) { ?>
                <tr>
                    <form enctype="multipart/form-data" method="post" action="">
                        <td><input type="text" name="name" id="name" value="<?= $product['name'] ?>"></td>
                        <td><input type="text" name="description" id="description" value="<?= $product['description'] ?>"></td>
                        <td><select name="category_id" id="category">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php  } ?>
                            </select></td>
                        <td><input type="text" name="price" id="price" value="<?= $product['price'] ?>"></td>
                        <td><input type="text" name="color" id="color" value="<?= $product['color'] ?>"></td>
                        <td><input type="text" name="weight" id="weight" value="<?= $product['weight'] ?>"></td>
                        <td><input type="text" name="active" id="active" value="<?= $product['active'] ?>"></td>
                        <td><input type="file" name="image1"></input><?= $product['image1'] ?></td>
                        <td><input type="file" name="image2"></input><?= $product['image2'] ?></td>
                        <td><input type="file" name="image3"></input><?= $product['image3'] ?></td>
                        <td><input type="submit" value="submit" name="submit"></td>
                        <td><a class='blue' href='?delete=<?= $product['id'] ?>'>Delete</a></td>
                    </form>
                </tr>
            <?php } else { ?>

                <tr>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['category'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['color'] ?></td>
                    <td><?= $product['weight'] ?></td>
                    <td><?= $product['active'] ?></td>
                    <td><?= $product['image1'] ?></td>
                    <td><?= $product['image2'] ?></td>
                    <td><?= $product['image3'] ?></td>
                    <td><a class='blue' href='?update=<?= $product['id'] ?>'>Update</a></td>
                    <td><a class='blue' href='?delete=<?= $product['id'] ?>'>Delete</a></td>
                </tr>
            <?php }
        }
        if (isset($_GET['add'])) { ?>
            <tr>
                <form enctype="multipart/form-data" method="post" action="">
                    <td><input type="text" name="name" id="name" value=""></td>
                    <td><input type="text" name="description" id="description" value=""></td>
                    <td><select name="category_id" id="category">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php  } ?>
                        </select></td>
                    <td><input type="text" name="price" id="price" value=""></td>
                    <td><input type="text" name="color" id="color" value=""></td>
                    <td><input type="text" name="weight" id="weight" value=""></td>
                    <td><input type="text" name="active" id="active" value=""></td>
                    <td><input type="file" name="image1"></input></td>
                    <td><input type="file" name="image2"></input></td>
                    <td><input type="file" name="image3"></input></td>
                    <td><input type="submit" value="submit" name="submit"></td>
                    <td><a class='blue' href='product_overzicht.php'>Cancel</a></td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <div class="addbutton"><a href="?add=1"><button>Add Product</button></a></div>
    <div class="back"><a href="../../index.php"><button>Home</button></a></div>

</body>

</html>