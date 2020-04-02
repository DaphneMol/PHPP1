<?php
require_once '../controllers/session.php';
require_once '../controllers/connect.php';
require_once '../controllers/checklogin.php';


if (!empty($_POST)) {

    //controleer nu of deze gebruiker mag inloggen
    $username = $_POST['field_email'];
    $password = $_POST['field_password'];

    $qry = $conn->query("SELECT * FROM user WHERE `e-mailadres` LIKE '" . $username . "'");

    while ($user = $qry->fetch_assoc()) {
        $hashedPassword = $user['password'];
    }

    if (empty($hashedPassword)) {
        echo "<script>alert('Verkeerde login gegevens');</script>";
    } else {

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            header("Refresh:0");
        } else {
            echo "<script>alert('Verkeerd wachtwoord')</script>";
        }
    }

    $qry->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>CMS Webshop</title>
</head>

<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2>SHOESHOE<br> Login Page</h2>
            <p>Login of maak een account</p>
        </div>
    </div>

    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" name="field_email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Wachtwoord</label>
                        <input type="password" class="form-control" name="field_password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-black">Login</button>
                    <a href="registratie.php" class="btn btn-secondary">Registreer</a>
                    <a href="admin/adminlogin.php" class="btn btn-secondary">Admin</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>