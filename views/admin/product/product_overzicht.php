<?php
require_once '../../../controllers/session.php';
require_once '../../../controllers/connect.php';

$qry = $conn->query("SELECT * FROM product");

$str = "<table>";

// Table header
$str .= "<tr>";
$str .= "<th>Name</th>";
$str .= "<th>Description</th>";
$str .= "<th>Category</th>";
$str .= "<th>Price</th>";
$str .= "<th>Color</th>";
$str .= "<th>Weight</th>";
$str .= "<th>Active</th>";
$str .= "<th>Update</th>";
$str .= "<th>Delete</th>";
$str .= "</tr>";


while ($row = $qry->fetch_assoc()) {
    $str .= "<tr>";
    $str .= "<td>" . $row['name'] . "</td>";
    $str .= "<td>" . $row['description'] . "</td>";
    $str .= "<td>" . $row['category_id'] . "</td>";
    $str .= "<td>" . $row['price'] . "</td>";
    $str .= "<td>" . $row['color'] . "</td>";
    $str .= "<td>" . $row['weight'] . "</td>";
    $str .= "<td>" . $row['active'] . "</td>";
    $str .= "<td><a class='blue' href='product_wijzigen.php?update=" . $row['id'] . "'>Update</a></td>";
    $str .= "<td><a class='red' href='product_verwijderen.php?delete=" . $row['id'] . "'>Delete</a></td>";
    $str .= "</tr>";
}

$str .= "</table>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>
    <link rel="stylesheet" href="../assets/css/overzicht.css">
</head>

<body>
    <h1>Overzicht Producten</h1>
    <?php echo $str ?>
    <div class="addbutton"><a href="product_toevoegen.php"><button>Add product</button></a></div>
</body>

</html>