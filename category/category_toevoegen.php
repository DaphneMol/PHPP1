<?php



include '../config/connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $active = $_POST['active'];

    $qry = "INSERT INTO category (name, description, active) VALUES ('" . $name . "', '" . $description . "', '" . $active . "')";

    if ($conn->query($qry) === TRUE) {
        header("Location: category_overzicht.php");
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
    <title>Add category</title>
    <link href='../assets/css/bootstrap.css' rel='stylesheet'>

</head>



<body>
    <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
            <div class='col-lg-6 col-lg-offset-3'>
                <h3>Add category</h3>
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
                        <label for='active'>Active</label>
                        <input name='active' id='active' type='text' class='form-control' placeholder='active' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
                    </div>
                    <div class='form-group'>
                        <button name='submit' id='submit' value="submit" class='btn btn-primary btn-block'>Add category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>