<?php
require_once '../../controllers/session.php';
require_once '../../controllers/connect.php';

if (!empty($_POST)) {
    $username = $_POST['field_email'];
    $password = $_POST['field_password'];

    $qry = $conn->query("SELECT * FROM admin WHERE username LIKE '" . $username . "'");

    while ($user = $qry->fetch_assoc()) {
        $hashedPassword = $user['password'];
    }

    if (empty($hashedPassword)) {
        echo "<script>alert('Verkeerde login gegevens')</script>";
    } else {

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = 1;
            header("Refresh:0; url=../index.php");
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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Admin | Login</title>
</head>

<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2>SHOESHOE<br>Admin Login Page</h2>
        </div>
    </div>

    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form action="adminlogin.php" method="POST">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" name="field_email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Wachtwoord</label>
                        <input type="password" class="form-control" name="field_password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-black">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>