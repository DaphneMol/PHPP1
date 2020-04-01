<?php

if (isset($_SESSION['username'])) {
    echo "<script>alert('Je bent ingelogd')</script>";
    header("Refresh:0; url=index.php");
}
