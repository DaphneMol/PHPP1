<?php
require_once '../../../controllers/session.php';
require_once '../../../controllers/connect.php';

if (isset($_GET['delete'])) {
    include '../config/connect.php';
    $id = $_GET['delete'];

    $sql = 'DELETE FROM category WHERE id = ' . $id;
    $conn->query($sql);

    if ($conn->affected_rows === 1) {
        echo "Category has been deleted";
    } else {
        echo "Category doesn't exist or has already been deleted";
    }

    echo "<br><a href='category_overzicht.php'><button>Terug</button></a>";
} else {
    echo "No id has been set";
}
