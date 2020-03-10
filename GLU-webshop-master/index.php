<?php
require_once("config/connect.php");

session_start(); 
$_SESSION['views'] = 1; // store session data
echo "Pageviews = ". $_SESSION['views']; //retrieve data
?>
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
               <form>
                  <div class="form-group">
                     <label>E-mail adres</label>
                     <input type="text" class="form-control" name="field_email" placeholder="Email">
                  </div>
                  <div class="form-group">
                     <label>Wachtwoord</label>
                     <input type="password" class="form-control" name="field_password" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-black">Login</button>
                  <a href="<?= BASEHREF;?>view/register.php" class="btn btn-secondary">Registreer</a>
               </form>
            </div>
        </div>
    </div>
   
</body>
</html>