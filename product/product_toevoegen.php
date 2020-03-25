<?php



include '../config/connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $weight = $_POST['weight'];
    $active = $_POST['active'];

    $qry = "INSERT INTO product (name, description, category_id, price, color, weight, active) VALUES ('" . $name . "', '" . $description . "', '" . $category_id . "', '" . $price . "', '" . $color . "', '" . $weight . "', '" . $active . "')";

    if ($conn->query($qry) === TRUE) {
        header("Location: product_overzicht.php");
    } else {
        echo "Error: " . $qry . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link href='../assets/css/bootstrap.css' rel='stylesheet'>

</head>



<body>
    <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
            <div class='col-lg-6 col-lg-offset-3'>
                <h3>Add product</h3>
                <hr />
                <form name='add' id='add' action='' method='post'>
                    <div class='form-group'>
                        <label for='name'>Name</label>
                        <input name='name' id='name' type='text' class='form-control' placeholder='name' required />
                    </div>
                    <div class='form-group'>
                        <label for='description'>Description</label>
                        <input name='description' id='description' type='text' class='form-control' placeholder='description' required />
                    </div>
                    <div class='form-group'>
                        <label for='category_id'>Category</label>
                        <input name='category_id' id='category_id' type='text' class='form-control' placeholder='category' required />
                    </div>
                    <div class='form-group'>
                        <label for='price'>Price</label>
                        <input name='price' id='price' type='text' class='form-control' placeholder='price' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
                    </div>
                    <div class='form-group'>
                        <label for='color'>Color</label>
                        <input name='color' id='color' type='text' class='form-control' placeholder='color' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
                    </div>
                    <div class='form-group'>
                        <label for='weight'>Weight</label>
                        <input name='weight' id='weight' type='text' class='form-control' placeholder='weight' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
                    </div>
                    <div class='form-group'>
                        <label for='active'>Active</label>
                        <input name='active' id='active' type='text' class='form-control' placeholder='active' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
                    </div>
                    <div class='form-group'>
                        <button name='submit' id='submit' value="submit" class='btn btn-primary btn-block'>Add the product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>