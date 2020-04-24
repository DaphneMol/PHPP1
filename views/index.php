<?php
require_once '../controllers/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOESHOE</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div id="container">
        <header>
            <img src="../assets/img/homepage/sneaker.jpg" alt="sneaker">
        </header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <?php if (isset($_SESSION['admin'])) { ?>
                    <li><a href="admin/product/product_overzicht.php">Admin Product</a></li>
                    <li><a href="admin/category/category_overzicht.php">Admin Category</a></li>
                    <li><a href="admin/admin/admin_overzicht.php">Admin Admins</a></li>
                    <li><a href="admin/customer/customer_overzicht.php">Admin Customer</a></li>
                    <li><a href="admin/user/user_overzicht.php">Admin User</a></li>
                <?php } ?>
                <?php if (!isset($_SESSION['username'])) { ?>
                    <li style="float: right"><a href="login.php">Inloggen</a></li>
                    <li style="float:right"><a href="registratie.php">Registreren</a></li>
                    <a href="../views/shopping_cart.php"><i class="fa fa-shopping-cart" style="font-size:36px;color:white;float:right;margin-top:3px"></i></a>

                <?php } else { ?>


                    <li style="float: right"><a href="../controllers/logout.php">Uitloggen</a></li>
                <?php } ?>

            </ul>
        </nav>
        <main>

            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="../assets/img/slider/store1.jpg" style="width:90%">
                </div>

                <div class="mySlides fade">
                    <img src="../assets/img/slider/store2.jpg" style="width:90%">
                </div>

                <div class="mySlides fade">
                    <img src="../assets/img/slider/store3.jpg" style="width:90%">
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>


            </div>
            <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </main>
        <footer>
            <small>&copy; Copyright 2020, SHOESHOE</small>
        </footer>
    </div>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
</body>

</html>