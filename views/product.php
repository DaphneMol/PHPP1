<?php
require_once '../controllers/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>

<body>
    <div id="container">
        <header><img src="../assets/img/homepage/sneaker.jpg" alt="sneaker"></header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
            </ul>
        </nav>
        <main>
            <div class="card">
                <img src="../assets/img/shoes/j1.png" alt="shoes" style="width:100%">
                <h1>Jordan 1 Mid</h1>
                <p class="price">&euro;119.99</p>
                <p>Mooie groene schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/am1.png" alt="Denim Jeans" style="width:100%">
                <h1>Nike Am 97 Celebration Of The Swoosh Cos</h1>
                <p class="price">&euro;99.99</p>
                <p>Mooie witte schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/v1.png" alt="Denim Jeans" style="width:100%">
                <h1>Vans Authentic</h1>
                <p class="price">&euro;79.99</p>
                <p>Mooie grijze schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/b1.png" alt="Denim Jeans" style="width:100%">
                <h1>Buffalo Crevis</h1>
                <p class="price">&euro;99.99</p>
                <p>Mooie roze schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/n1.png" alt="Denim Jeans" style="width:100%">
                <h1>Nike Air Max 2090</h1>
                <p class="price">&euro;149,99</p>
                <p>Mooie witte schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/air1.png" alt="Denim Jeans" style="width:100%">
                <h1>Nike Air Max 270</h1>
                <p class="price">&euro;149,99</p>
                <p>Mooie zwarte schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/oz1.png" alt="Denim Jeans" style="width:100%">
                <h1>adidas Ozweego Suede</h1>
                <p class="price">&euro;64,99</p>
                <p>Mooie grijze schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/cair1.png" alt="Denim Jeans" style="width:100%">
                <h1>Nike Air Force 1</h1>
                <p class="price">&euro;84,99</p>
                <p>Mooie roze schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/bn1.png" alt="Denim Jeans" style="width:100%">
                <h1>Nike Tuned 1</h1>
                <p class="price">&euro;59,99</p>
                <p>Mooie grijze schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
            <div class="card">
                <img src="../assets/img/shoes/bair1.png" alt="Denim Jeans" style="width:100%">
                <h1>Nike Air Force 1 Highness</h1>
                <p class="price">&euro;54,99</p>
                <p>Mooie paarse schoenen</p>
                <p><button>Add to Cart</button></p>
            </div>
        </main>
        <footer>
            <small>&copy; Copyright 2020, SHOESHOE</small>
        </footer>
    </div>



    <a href="views/product/product_overzicht.php"><button>Overzicht Producten</button></a>
    <a href="views/category/category_overzicht.php"><button>Overzicht Category</button></a>
    <a href="controllers/logout.php"><button>logout</button></a>
</body>

</html>