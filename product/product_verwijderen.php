<?php
// pers_change.php
// Hier worden korte strings aan elkaar geplakt met punt-is (.=)

if (isset($_GET['delete'])) {
    include '../config/connect.php';
    $id = $_GET['delete'];

    $sql = 'DELETE FROM product WHERE id = ' . $id;
    $conn->query($sql);

    if ($conn->affected_rows === 1) {
        echo "Product has been deleted";
    } else {
        echo "Product doesn't exist or has already been deleted";
    }

    echo "<br><a href='product_overzicht.php'><button>Terug</button></a>";
} else {
    echo "No id has been set";
}