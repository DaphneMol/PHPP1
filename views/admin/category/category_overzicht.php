<?php
require_once '../../../controllers/checkAdmin.php';
require_once '../../../controllers/connect.php';
require_once '../../../controllers/session.php';

$qry = $conn->query("SELECT * FROM category");

$categories = [];

while ($row = $qry->fetch_assoc()) {
    array_push($categories, $row);
}

if (isset($_GET['update'])) {
    if (isset($_POST['submit'])) {


        $qry = $conn->prepare('UPDATE category SET name = ?, description = ?, active = ? WHERE id = ?');
        $qry->bind_param('ssii', $_POST['name'], $_POST['description'], $_POST['active'], $_GET['update']);


        if ($qry->execute()) {
            echo ("<script>alert('Category gewijzigd')</script>");
            header("Refresh:0; url=category_overzicht.php");
        } else {
            echo "Error: " . $qry->error;
        }
    }
}

if (isset($_GET['delete'])) {

    $sql = 'DELETE FROM category WHERE id = ' . $_GET['delete'];
    $conn->query($sql);

    if ($conn->affected_rows === 1) {
        echo ("<script>alert('Category has been deleted')</script>");
        header("Refresh:0; url=category_overzicht.php");
    } else {
        echo ("<script>alert('Category doesn't exist or has already been deleted')</script>");
    }
}

if (isset($_GET['add'])) {
    if (isset($_POST['submit'])) {

        $qry = $conn->prepare("INSERT INTO category (name, description, active) VALUES (?,?,?)");
        $qry->bind_param('ssi', $_POST['name'], $_POST['description'], $_POST['active']);
        if ($qry->execute()) {
            echo ("<script>alert('Category toegevoegd')</script>");
            header("Refresh:0; url=category_overzicht.php");
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
    <title>Category Overzicht</title>
    <link rel="stylesheet" href="../../../assets/css/overzicht.css">
</head>

<body>
    <h1>Overzicht Category</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Active</th>

        </tr>
        <?php foreach ($categories as $category) {

            if (isset($_GET['update']) && $category['id'] == $_GET['update']) { ?>
                <tr>
                    <form method="post" action="">
                        <td><input type="text" name="name" id="name" value="<?= $category['name'] ?>"></td>
                        <td><input type="text" name="description" id="description" value="<?= $category['description'] ?>"></td>
                        <td><input type="text" name="active" id="active" value="<?= $category['active'] ?>"></td>
                        <td><input type="submit" value="submit" name="submit"></td>
                        <td><a class='blue' href='?delete=<?= $category['id'] ?>'>Delete</a></td>
                    </form>
                </tr>
            <?php } else { ?>

                <tr>
                    <td><?= $category['name'] ?></td>
                    <td><?= $category['description'] ?></td>
                    <td><?= $category['active'] ?></td>
                    <td><a class='blue' href='?update=<?= $category['id'] ?>'>Update</a></td>
                    <td><a class='blue' href='?delete=<?= $category['id'] ?>'>Delete</a></td>
                </tr>
            <?php }
        }
        if (isset($_GET['add'])) { ?>
            <tr>
                <form method="post" action="">
                    <td><input type="text" name="name" id="name" value=""></td>
                    <td><input type="text" name="description" id="description" value=""></td>
                    <td><input type="text" name="active" id="active" value=""></td>
                    <td><input type="submit" value="submit" name="submit"></td>
                    <td><a class='blue' href='category_overzicht.php'>Cancel</a></td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <div class="addbutton"><a href="?add=1"><button>Add Category</button></a></div>
    <div class="back"><a href="../../index.php"><button>Home</button></a></div>

</body>

</html>