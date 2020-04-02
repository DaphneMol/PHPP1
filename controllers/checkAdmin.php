<?php
if (isset($_SESSION['admin'])) {
    echo "<script>alert('Je geen administrator')</script>";
    header("Refresh:0; url=../index.php");
}
