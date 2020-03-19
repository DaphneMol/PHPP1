<?php
session_start();
require_once 'src/checklogin.php';
include 'config/connect.php';
//include("registratie.php");

if (!empty($_POST)) {

    //var_dump($_POST);
    //die();

    //db insert
    $ingevuldun = $_POST['field_email'];
    $ingevuldpw = password_hash($_POST['field_password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO admin (username, `password`) VALUES ('$ingevuldun', '$ingevuldpw')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //naar login

    header("Location: login.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>CMS registratie</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <form method="post" action="registratie.php">
                    <div class="form-group">
                        <label for="fname">Naam</label>
                        <input type="text" name="field_firstname" id="fname" class="form-control" placeholder="Voornaam" required />
                        <input type="text" name="field_infixname" class="form-control" placeholder="Tussenvoegsel" />
                        <input type="text" name="field_lastname" class="form-control" placeholder="Achternaam" required />
                    </div>
                    <div class="form-group">
                        <label for="email">E-mailadres</label>
                        <input type="email" name="field_email" class="form-control" id="email" placeholder="E-mailadres" required />
                    </div>
                    <div class="form-group">
                        <label for="passwd">Wachtwoord</label>
                        <input type="password" name="field_password" class="form-control" id="passwd" placeholder="Wachtwoord" required />
                    </div>
                    <input type="submit" name="submit" class="btn btn-info" value="Registreren" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>