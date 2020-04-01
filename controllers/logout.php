<?php
require_once 'session.php';
session_destroy();
echo "<script>alert('U bent uitgelogd');</script>";
header("Location: ../views/index.php");
