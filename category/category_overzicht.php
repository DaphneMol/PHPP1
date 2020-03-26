<?php
include '../config/connect.php';


$qry = $conn->query("SELECT * FROM category");

$str = "<table>";

// Table header
$str .= "<tr>";
$str .= "<th>id</th>";
$str .= "<th>Name</th>";
$str .= "<th>Description</th>";
$str .= "<th>Active</th>";
$str .= "</tr>";


while ($row = $qry->fetch_assoc()) {
    $str .= "<tr>";
    $str .= "<td>" . $row['id'] . "</td>";
    $str .= "<td>" . $row['name'] . "</td>";
    $str .= "<td>" . $row['description'] . "</td>";
    $str .= "<td>" . $row['active'] . "</td>";
    $str .= "<td><a class='blue' href='category_wijzigen.php?update=" . $row['id'] . "'>Update</a></td>";
    $str .= "<td><a class='red' href='category_verwijderen.php?delete=" . $row['id'] . "'>Delete</a></td>";
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
    <h1>Overzicht Category</h1>
    <?php echo $str ?>
    <div class="addbutton"><a href="category_toevoegen.php"><button>Add Category</button></a></div>
</body>

</html>