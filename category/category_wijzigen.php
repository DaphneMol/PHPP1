<?php


if (isset($_GET['update'])) {
    include '../config/connect.php';
    $id = $_GET['update'];

    if (isset($_POST['submit'])) {

        $qry = 'UPDATE category SET id = "' . $_POST['id'] . '", name = "' . $_POST['name'] . '", description = "' . $_POST['description'] . '", active = "' . $_POST['active'] . '" WHERE id = ' . $id;

        if ($conn->query($qry) === TRUE) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error: " . $qry . "<br>" . $conn->error;
        }
    }

    $sql = $conn->query('SELECT * FROM category WHERE id = ' . $id);

    $category = $sql->fetch_assoc();
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
                <th>id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Active</th>
            </tr>
            <tr>
                <td><?php echo $category['id'] ?>
                <td><?php echo $category['name'] ?>
                <td><?php echo $category['description'] ?>
                <td><?php echo $category['active'] ?>
            </tr>
            <tr>
                <td><input type="text" name="id" value="<?php echo $category['id'] ?>"></td>
                <td><input type="text" name="name" value="<?php echo $category['name'] ?>"></td>
                <td><input type="text" name="description" value="<?php echo $category['description'] ?>"></td>
                <td><input type="text" name="active" value="<?php echo $category['active'] ?>"></td>
            </tr>
        </table>
        <div class="buttons"> <input type="submit" value="submit" name="submit"></div>
    </form>
    <div class="button2"><a href="category_overzicht.php"><button>Terug</button></a></div>


</body>

</html>