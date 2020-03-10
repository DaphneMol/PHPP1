<?php
require("config/connect.php");
// include("registratie.php");

$login = "";

if (!empty($_POST)) {

    echo ("controleer.....");
    //controleer nu of deze gebruiker mag inloggen

    $qry = $conn->query("SELECT admin FROM admin WHERE username LIKE '" . $_POST["field_email"] . "' AND password LIKE  '" . $_POST["field_password"] . "' ;");
    if ($qry === false) {
        echo mysqli_error($con) . " - ";
        exit(__LINE__);
    } else {
        $login = false;
        while ($product = $qry->fetch_assoc()) {
            $login = true;
        }
        if ($login) {
            //echo ("login mag");
        } else {
            //echo ("login mag NIET");
        }
    }
    //exit();
    $qry->close();
}











?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>CMS Webshop</title>
    </head>

    <body>
        <div class="sidenav">
            <div class="login-main-text">
                <h2>Eigen Webshop<br> Login Page</h2>
                <p>Dit is een eigen CMS voor de webshop</p>
            </div>
        </div>

        <div class="main">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                    <?php
                    if ($login === false) {
                        echo ("login mag niet");
                    }

                    ?>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label>E-mail adres</label>
                            <input type="text" class="form-control" name="field_email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Wachtwoord</label>
                            <input type="password" class="form-control" name="field_password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-black">Login</button>
                        <a href="registratie.php" class="btn btn-secondary">Registreer</a>
                    </form>
                </div>
            </div>
        </div>

    </body>

    </html>
</body>

</html>