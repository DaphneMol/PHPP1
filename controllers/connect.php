<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "webshop");
define("BASEHREF", "http://localhost/Periode%203/PHP/PHPP1/");
define("WEBSITE_NAME", "SHOESHOE");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
